<?php

namespace CoquardcyrWpArticleScheduler\Tests\E2E\cypress\seeds;

use CoquardcyrWpArticleScheduler\Database\Queries\ArticleSchedules;
use CoquardcyrWpArticleScheduler\Engine\Queue\Queue;
use WP_Cypress\Fixtures\Post;
use function WP_Cypress\Utils\now;

class PostFixture extends Post
{

    protected $generated_ids = [];

	/**
	 * @var Queue
	 */
	protected $queue;

	/**
	 * @var ArticleSchedules
	 */
	protected $query;

	protected $status = '';

	protected $change_date = -1;

	public function __construct() {
		parent::__construct();
		$container = apply_filters('coquardcyr_wp_article_scheduler_container', null);
		$this->queue = $container->get(Queue::class);
		$this->queue = $container->get(ArticleSchedules::class);
	}

    /**
     * @inheritDoc
     */
    public function generate(): void
    {
	    $post_id = wp_insert_post( array_merge( $this->defaults(), $this->properties ) );

	    if ( is_wp_error( $post_id ) ) {
		    return;
	    }

	    $this->add_meta( $post_id );
	    $this->add_thumbnail( $post_id );
		$this->maybe_add_scheduler( $post_id );
		$this->generated_ids[] = $post_id;
    }

    public function clean() {
        foreach ($this->generated_ids as $id) {
			wp_delete_post($id);
			$this->query->delete_by_post_id($id);
        }
		$this->queue->clear();
    }

	public function schedule_future() {
		$this->change_date = current_time('timestamp') + 9999;
	}

	public function schedule_past() {
		$this->change_date = current_time('timestamp') - 9999;
	}

	public function is_scheduled_draft() {
		$this->status = 'draft';
		$this->properties['post_status'] = 'publish';
	}

	public function is_scheduled_published() {
		$this->status = 'published';
		$this->properties['post_status'] = 'draft';
	}

	public function is_scheduled_protected() {
		$this->status = 'protected';
		$this->properties['post_status'] = 'publish';
	}

	public function is_scheduled_private() {
		$this->status = 'private';
		$this->properties['post_status'] = 'publish';
	}

	protected function maybe_add_scheduler(int $post_id) {
		if(! $this->change_date || ! $this->status) {
			return;
		}

		$row = $this->query->create_row([
			'post_id' => $post_id,
			'status'  => $this->status,
			'change_date' => $this->change_date
		]);

		$this->query->create_or_update($row);
		$this->queue->add_scheduled_post($post_id, $this->status, $this->change_date);
	}
}