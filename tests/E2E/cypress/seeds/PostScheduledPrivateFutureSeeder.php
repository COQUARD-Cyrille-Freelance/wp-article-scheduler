<?php

class PostScheduledPrivateFutureSeeder extends \WP_Cypress\Seeder\Seeder {

	/**
	 * @var PostFixture
	 */
	protected $post_fixture;

	public function __construct() {
		parent::__construct();
		$this->post_fixture = new PostFixture();
	}

	public function run() {
		$this->post_fixture->schedule_future();
		$this->post_fixture->is_scheduled_private();
		$this->post_fixture->create();
	}

	public function clean() {
		$this->post_fixture->clean();
	}
}