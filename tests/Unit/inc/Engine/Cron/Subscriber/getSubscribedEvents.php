<?php

namespace CoquardcyrWpArticleScheduler\Tests\Unit\inc\Engine\Cron\Subscriber;

use Mockery;
use CoquardcyrWpArticleScheduler\Engine\Cron\Subscriber;
use CoquardcyrWpArticleScheduler\Database\Queries\ArticleSchedules;
use CoquardcyrWpArticleScheduler\Engine\Queue\Queue;


use CoquardcyrWpArticleScheduler\Tests\Unit\TestCase;

/**
 * @covers \CoquardcyrWpArticleScheduler\Engine\Cron\Subscriber::get_subscribed_events
 */
class Test_getSubscribedEvents extends TestCase {

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
        $this->assertSame($expected, $this->subscriber->get_subscribed_events());

    }
}
