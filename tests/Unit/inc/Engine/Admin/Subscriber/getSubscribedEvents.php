<?php

namespace CoquardcyrWpArticleScheduler\Tests\Unit\inc\Engine\Admin\Subscriber;

use Mockery;
use CoquardcyrWpArticleScheduler\Engine\Admin\Subscriber;
use CoquardcyrWpArticleScheduler\Database\Queries\ArticleSchedules;


use CoquardcyrWpArticleScheduler\Tests\Unit\TestCase;

/**
 * @covers \CoquardcyrWpArticleScheduler\Engine\Admin\Subscriber::get_subscribed_events
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
        $this->query = Mockery::mock(ArticleSchedules::class);
        $this->prefix = '';

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
