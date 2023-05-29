<?php

namespace CoquardcyrArticleScheduler\Tests\Unit\inc\Engine\Admin\Subscriber;

use Mockery;
use CoquardcyrArticleScheduler\Engine\Admin\Subscriber;
use CoquardcyrArticleScheduler\Database\Queries\ArticleSchedules;


use CoquardcyrArticleScheduler\Tests\Unit\TestCase;
use Brain\Monkey\Functions;
/**
 * @covers \CoquardcyrArticleScheduler\Engine\Admin\Subscriber::add_meta_box
 */
class Test_addMetaBox extends TestCase {

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

    public function testShouldDoAsExpected()
    {
		Functions\when('__')->returnArg();
		Functions\expect('add_meta_box')->with('prefixschedule','Schedule the post', [$this->subscriber, 'meta_box_content'], ['post', 'page'], 'side', 'default');
        $this->subscriber->add_meta_box();
    }
}
