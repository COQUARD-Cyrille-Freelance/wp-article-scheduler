<?php

namespace CoquardcyrWpArticleScheduler\Tests\E2E\cypress\seeds;

class PostScheduledPrivatePastSeeder extends \WP_Cypress\Seeder\Seeder {

	/**
	 * @var PostFixture
	 */
	protected $post_fixture;

	public function __construct() {
		parent::__construct();
		$this->post_fixture = new PostFixture();
	}

	public function run() {
		$this->post_fixture->schedule_past();
		$this->post_fixture->is_scheduled_private();
	}

	public function clean() {
		$this->post_fixture->clean();
	}
}