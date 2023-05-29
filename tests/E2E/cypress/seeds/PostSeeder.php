<?php

namespace CoquardcyrArticleScheduler\Tests\E2E\cypress\seeds;

use WP_Cypress\Seeder\Seeder;

class PostSeeder extends Seeder {

	/**
	 * @var PostFixture
	 */
	protected $post_fixture;

	public function __construct() {
		parent::__construct();
		$this->post_fixture = new PostFixture();
	}


	public function run() {
		$this->post_fixture->create();
	}

	public function clean() {
		$this->post_fixture->clean();
	}
}