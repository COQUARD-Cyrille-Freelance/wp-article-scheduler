<?php

namespace CoquardcyrWpArticleScheduler\Tests\Unit\inc\Engine\Admin\Subscriber;

use Mockery;
use CoquardcyrWpArticleScheduler\Engine\Admin\Subscriber;
use CoquardcyrWpArticleScheduler\Database\Queries\ArticleSchedules;


use CoquardcyrWpArticleScheduler\Tests\Unit\TestCase;

/**
 * @covers \CoquardcyrWpArticleScheduler\Engine\Admin\Subscriber::maybe_delete_schedule
 */
class Test_maybeDeleteSchedule extends TestCase {

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
    public function testShouldDoAsExpected( $config )
    {
        $this->subscriber->maybe_delete_schedule($config['new_post'], $config['old_post']);

    }
}
