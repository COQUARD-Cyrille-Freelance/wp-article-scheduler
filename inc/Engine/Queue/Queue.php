<?php

namespace CoquardcyrArticleScheduler\Engine\Queue;

use CoquardcyrArticleScheduler\Dependencies\LaunchpadActionScheduler\Queue\AbstractASQueue;

class Queue extends AbstractASQueue
{

	/**
	 * Pending jobs cron hook.
	 *
	 * @var string
	 */
	protected $schedule_article = '';

	public function __construct( string $action_scheduler_queue_group, string $prefix ) {
		parent::__construct( $action_scheduler_queue_group, $prefix );
		$this->schedule_article = "{$this->prefix}process_scheduled";
	}

	public function add_scheduled_post(int $post_id, string $status, int $date) {
		$this->add_async($this->schedule_article, [ $post_id, $status, $date ]);
	}

	public function clear() {
		$this->cancel_all($this->schedule_article);
	}
}