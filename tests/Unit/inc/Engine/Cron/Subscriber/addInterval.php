<?php

namespace CoquardcyrArticleScheduler\Tests\Unit\inc\Engine\Cron\Subscriber;

use Mockery;
use CoquardcyrArticleScheduler\Engine\Cron\Subscriber;
use CoquardcyrArticleScheduler\Database\Queries\ArticleSchedules;
use CoquardcyrArticleScheduler\Engine\Queue\Queue;


use CoquardcyrArticleScheduler\Tests\Unit\TestCase;
use Brain\Monkey\Filters;
use Brain\Monkey\Functions;

/**
 * @covers \CoquardcyrArticleScheduler\Engine\Cron\Subscriber::add_interval
 */
class Test_addInterval extends TestCase {

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
    public function testShouldReturnAsExpected( $config, $expected )
    {
		Functions\when('esc_html__')->returnArg();
		Filters\expectApplied("prefixprocess_scheduled_posts_cron_interval")->with(MINUTE_IN_SECONDS)->andReturn($config['interval']);
        $this->assertSame($expected, $this->subscriber->add_interval($config['schedules']));
    }
}
