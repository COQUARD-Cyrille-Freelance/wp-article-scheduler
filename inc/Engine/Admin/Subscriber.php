<?php
namespace CoquardcyrWpArticleScheduler\Engine\Admin;

use CoquardcyrWpArticleScheduler\Database\Queries\ArticleSchedules;
use CoquardcyrWpArticleScheduler\Dependencies\LaunchpadCore\EventManagement\SubscriberInterface;
use WP_Post;

class Subscriber implements SubscriberInterface {

	/**
	 * @var ArticleSchedules
	 */
	protected $query;

	/**
	 * @var string
	 */
	protected $prefix;

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
			'admin_init' => 'add_meta_box',
			'save_post' => 'save_meta',
			'post_updated' => ['maybe_delete_schedule', 10, 3],
		];
	}

	public function add_meta_box() {
		add_meta_box( 'Schedule', __( 'Schedule the post', 'coquardcyrwparticlescheduler' ), [ $this, 'meta_box_content' ], 'post', 'side', 'default' );
	}

	public function meta_box_content( WP_Post $post ) {

		$template = 'meta-box';

		$scheduled = $this->query->get_by_post_id( $post->ID );

		$keys = [];

		$keys['post_id'] = $post->post_id;
		$keys['current_status'] = $scheduled->status ? : '';
		$keys['date']           =  date('yyyy-mm-dd', $scheduled->change_date) ? : '';
		$keys['min_date'] = date('yyyy-mm-dd', now());
		$parameters = [
			'keys' => $keys,
		];

		if ( ! apply_filters( "{$this->prefix}has_template", $template, $parameters, false ) ) {
			$parameters['parameters'] = $this->generate_view_parameters( $parameters['keys'] );
		}

		do_action( "{$this->prefix}render_template", $template, $parameters );
	}

	protected function generate_view_parameters( array $parameters, WP_Post $post ): array {
		$statuses = get_post_statuses();

		if ( key_exists( $post->post_status, $statuses ) ) {
			unset( $statuses[ $post->post_status ] );
		}

		if ( 'publish' !== $post->post_status ) {
			foreach ( $statuses as $key => $label ) {
				if ( 'publish' !== $key ) {
					unset( $statuses[ $key ] );
				}
			}
		}

		return array_merge(
			$parameters,
			[
				'statuses' => $statuses,
				'prefix'   => $this->prefix,
			]
		);
	}

	public function save_meta( $post_id ) {

		if ( ! isset( $_POST["meta_{$this->prefix}fields_meta_box_nonce"] ) )
			return;

		if ( ! wp_verify_nonce( $_POST["meta_{$this->prefix}fields_meta_box_nonce"], "meta_{$this->prefix}_fields_save_meta_box_data" ) )
			return;

		if ( ! current_user_can( 'edit_post', $post_id ) )
			return;

		$status = sanitize_text_field( $_POST["{$this->prefix}status"] );
		$change_date = sanitize_text_field( $_POST["{$this->prefix}change_date"] );

		if(! $status || ! $change_date) {
			$this->query->delete_by_post_id($post_id);
		}

		$row = $this->query->create_row([
			'post_id' => $post_id,
			'status' => $status,
			'change_date' => $change_date
		]);

		$this->query->create_or_update($row);
	}

	public function maybe_delete_schedule($post_id, WP_Post $new_post, WP_Post $old_post) {
		if($new_post->post_status === $old_post->post_status) {
			return;
		}
		$this->query->delete_by_post_id($post_id);
	}
}
