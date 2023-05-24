<?php

namespace CoquardcyrWpArticleScheduler\Tests\Unit\inc\Engine\Cron\Subscriber;

use Mockery;
use CoquardcyrWpArticleScheduler\Engine\Cron\Subscriber;
use CoquardcyrWpArticleScheduler\Database\Queries\ArticleSchedules;
use CoquardcyrWpArticleScheduler\Engine\Queue\Queue;


use CoquardcyrWpArticleScheduler\Tests\Unit\TestCase;
use Brain\Monkey\Functions;

/**
 * @covers \CoquardcyrWpArticleScheduler\Engine\Cron\Subscriber::process_scheduled
 */
class Test_processScheduled extends TestCase {

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
     * @var Subscriber
     */
    protected $subscriber;

    public function set_up() {
        parent::set_up();
        $this->prefix = 'prefix';
        $this->plugin_name = 'plugin_name';
        $this->query = $this->createMock(ArticleSchedules::class);
        $this->queue = Mockery::mock(Queue::class);

        $this->subscriber = new Subscriber($this->prefix, $this->plugin_name, $this->query, $this->queue);
    }

    /**
     * @dataProvider configTestData
     */
    public function testShouldDoAsExpected( $config, $expected )
    {
		$this->configure_delete_post($config, $expected);
		$this->configure_update_post($config, $expected);
        $this->subscriber->process_scheduled($config['post_id'], $config['status'], $config['change_date']);
    }

	protected function configure_delete_post($config, $expected) {
		if( $config['date_superior']) {
			Functions\expect('get_post')->never();
			return;
		}
		Functions\expect('get_post')->with($expected['post_id'])->andReturn($config['post']);
		$this->query->expects(self::once())->method('delete_by_post_id')->with($expected['post_id']);
	}

	protected function configure_update_post($config, $expected) {
		if( $config['date_superior'] || $config['invalid_post']) {
			Functions\expect('wp_update_post')->never();
			return;
		}
		Functions\expect('wp_update_post')->with(Mockery::on(function ($data) use ($expected) {
			return $data instanceof \WP_Post && $data->post_status == $expected['post']->post_status &&$data->ID == $expected['post']->ID;
		}));
	}
}
