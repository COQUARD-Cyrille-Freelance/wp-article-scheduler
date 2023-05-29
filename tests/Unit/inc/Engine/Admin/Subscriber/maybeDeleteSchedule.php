<?php

namespace CoquardcyrArticleScheduler\Tests\Unit\inc\Engine\Admin\Subscriber;

use Mockery;
use CoquardcyrArticleScheduler\Engine\Admin\Subscriber;
use CoquardcyrArticleScheduler\Database\Queries\ArticleSchedules;


use CoquardcyrArticleScheduler\Tests\Unit\TestCase;

/**
 * @covers \CoquardcyrArticleScheduler\Engine\Admin\Subscriber::maybe_delete_schedule
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
        $this->query = $this->createMock(ArticleSchedules::class);
        $this->prefix = 'prefix';

        $this->subscriber = new Subscriber($this->query, $this->prefix);
    }

    /**
     * @dataProvider configTestData
     */
    public function testShouldDoAsExpected( $config, $expected )
    {
		if($config['same_status']) {
			$this->query->expects(self::once())->method('delete_by_post_id')->with($expected['post_id']);
		} else {
			$this->query->expects(self::never())->method('delete_by_post_id');
		}
        $this->subscriber->maybe_delete_schedule( $config['post_id'], $config['new_post'], $config['old_post']);
    }
}
