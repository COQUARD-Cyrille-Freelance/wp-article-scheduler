<?php

namespace CoquardcyrWpArticleScheduler\Engine\Queue;

use CoquardcyrWpArticleScheduler\Dependencies\LaunchpadActionScheduler\Queue\AbstractASQueue;

class Queue extends AbstractASQueue
{

	/**
	 * Pending jobs cron hook.
	 *
	 * @var string
	 */
	protected $schedule_article = '';

	public function add_scheduled_post(int $post_id, string $status, int $date) {
		$this->add_async($this->schedule_article, [ $post_id, $status, $date ]);
	}

	public function clear() {
		$this->cancel_all($this->schedule_article);
	}
}