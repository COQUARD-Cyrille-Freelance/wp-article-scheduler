<?php

namespace CoquardcyrWpArticleScheduler\Tests\Unit\inc\Engine\Cron\Subscriber;

use Mockery;
use CoquardcyrWpArticleScheduler\Engine\Cron\Subscriber;
use CoquardcyrWpArticleScheduler\Database\Queries\ArticleSchedules;
use CoquardcyrWpArticleScheduler\Engine\Queue\Queue;


use CoquardcyrWpArticleScheduler\Tests\Unit\TestCase;
use Brain\Monkey\Functions;

/**
 * @covers \CoquardcyrWpArticleScheduler\Engine\Cron\Subscriber::schedule_cron
 */
class Test_scheduleCron extends TestCase {

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
    public function testShouldDoAsExpected( $config )
    {
		Functions\expect('wp_next_scheduled')->with("prefixprocess_scheduled_posts")->andReturn($config['has_cron']);
		if(! $config['has_cron']) {
			Functions\expect('wp_schedule_event')->with(Mockery::on(function ($data) {
				return strtotime('now') <= $data && strtotime('now + 1 hour') >= $data;
			}), "{$this->prefix}process_scheduled_posts", "{$this->prefix}process_scheduled_posts");
		}
		$this->subscriber->schedule_cron();
		$this->assertTrue(true);
    }
}
