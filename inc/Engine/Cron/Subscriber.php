<?php
namespace CoquardcyrArticleScheduler\Engine\Cron;

use CoquardcyrArticleScheduler\Database\Queries\ArticleSchedules;
use CoquardcyrArticleScheduler\Dependencies\LaunchpadCore\EventManagement\SubscriberInterface;
use CoquardcyrArticleScheduler\Dependencies\LaunchpadUninstaller\Uninstall\UninstallerInterface;
use CoquardcyrArticleScheduler\Engine\Queue\Queue;

class Subscriber implements SubscriberInterface, UninstallerInterface {

	/**
	 * @var string
	 */
	protected $prefix;

	/**
	 * @var string
	 */
	protected $plugin_name;

	/**
	 * @var ArticleSchedules
	 */
	protected $query;

	/**
	 * @var Queue
	 */
	protected $queue;

	/**
	 * @param string $prefix
	 * @param string $plugin_name
	 * @param ArticleSchedules $query
	 * @param Queue $queue
	 */
	public function __construct( string $prefix, string $plugin_name, ArticleSchedules $query, Queue $queue ) {
		$this->prefix      = $prefix;
		$this->plugin_name = $plugin_name;
		$this->query       = $query;
		$this->queue       = $queue;
	}

	/**
	 * Returns an array of events that this subscriber wants to listen to.
	 *
	 * The array key is the event name. The value can be:
	 *
	 *  * The method name
	 *  * An array with the method name and priority
	 *  * An array with the method name, priority and number of accepted arguments
	 *
	 * For instance:
	 *
	 *  * array('hook_name' => 'method_name')
	 *  * array('hook_name' => array('method_name', $priority))
	 *  * array('hook_name' => array('method_name', $priority, $accepted_args))
	 *  * array('hook_name' => array(array('method_name_1', $priority_1, $accepted_args_1)), array('method_name_2', $priority_2, $accepted_args_2)))
	 *
	 * @return array
	 */
	public function get_subscribed_events() {
		return [
			'cron_schedules'                         => 'add_interval',
			'init'                                   => 'schedule_cron',
			"{$this->prefix}process_scheduled_posts" => 'process_scheduled_posts',
			"{$this->prefix}process_scheduled" => ['process_scheduled', 10, 3],
		];
	}



	/**
	 * Add the interval for the cron.
	 *
	 * @param array $schedules Cron schedules.
	 * @return mixed
	 */
	public function add_interval( $schedules ) {

		/**
		 * Filters the cron interval.
		 *
		 * @since 3.11
		 *
		 * @param int $interval Interval in seconds.
		 */
		$interval = apply_filters( "{$this->prefix}process_scheduled_posts_cron_interval", 1 * MINUTE_IN_SECONDS );

		$schedules[ "{$this->prefix}process_scheduled_posts" ] = [
			'interval' => $interval,
			'display'  => esc_html__( "{$this->plugin_name} process scheduled posts", 'coquardcyrarticlescheduler' ),
		];

		return $schedules;
	}

	public function schedule_cron() {

		if ( wp_next_scheduled( "{$this->prefix}process_scheduled_posts" ) ) {
			return;
		}

		wp_schedule_event( time() + 10 * MINUTE_IN_SECONDS, "{$this->prefix}process_scheduled_posts", "{$this->prefix}process_scheduled_posts" );
	}

	public function process_scheduled_posts() {
		$rows = $this->query->query(
			[
				'posts_per_page' => -1,
				'order'          => 'ASC',
				'meta_query'     => [
					[
						'key'     => 'change_date',
						'value'   => time(),
						'compare' => '<=',
					],
				],
			]
			);

		if(! $rows) {
			return;
		}

		foreach ( $rows as $row ) {
			$this->queue->add_scheduled_post( $row->post_id, $row->status, $row->change_date );
		}
	}

	public function process_scheduled( $post_id, $status, $change_date ) {
		if($change_date > time()) {
			return;
		}

		$post = get_post($post_id);

		$this->query->delete_by_post_id($post_id);

		if(! $post || ! $status ) {
			return;
		}

		$post->post_status = $status;

		wp_update_post($post);
	}

	public function uninstall() {
		wp_clear_scheduled_hook("{$this->prefix}process_scheduled_posts");
		$this->queue->clear();
	}
}
