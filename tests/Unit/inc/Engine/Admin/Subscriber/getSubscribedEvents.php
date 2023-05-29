<?php

namespace CoquardcyrArticleScheduler\Tests\Unit\inc\Engine\Admin\Subscriber;

use Mockery;
use CoquardcyrArticleScheduler\Engine\Admin\Subscriber;
use CoquardcyrArticleScheduler\Database\Queries\ArticleSchedules;


use CoquardcyrArticleScheduler\Tests\Unit\TestCase;

/**
 * @covers \CoquardcyrArticleScheduler\Engine\Admin\Subscriber::get_subscribed_events
 */
class Test_getSubscribedEvents extends TestCase {

    /**
     * @var ArticleSchedules
     */
    protected $query;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var Subscriber
     */
    protected $subscriber;

    public function set_up() {
        parent::set_up();
        $this->query = $this->createMock(ArticleSchedules::class);
        $this->prefix = 'prefix';

        $this->subscriber = new Subscriber($this->query, $this->prefix);
    }

    /**
     * @dataProvider configTestData
     */
    public function testShouldReturnAsExpected( $config, $expected )
    {
        $this->assertSame($expected, $this->subscriber->get_subscribed_events());
    }
}
