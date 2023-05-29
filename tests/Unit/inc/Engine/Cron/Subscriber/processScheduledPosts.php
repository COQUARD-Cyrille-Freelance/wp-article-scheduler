<?php

namespace CoquardcyrArticleScheduler\Tests\Unit\inc\Engine\Cron\Subscriber;

use Mockery;
use CoquardcyrArticleScheduler\Engine\Cron\Subscriber;
use CoquardcyrArticleScheduler\Database\Queries\ArticleSchedules;
use CoquardcyrArticleScheduler\Engine\Queue\Queue;


use CoquardcyrArticleScheduler\Tests\Unit\TestCase;

/**
 * @covers \CoquardcyrArticleScheduler\Engine\Cron\Subscriber::process_scheduled_posts
 */
class Test_processScheduledPosts extends TestCase {

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
		$this->query->expects(self::once())->method('query')->willReturn($config['rows']);
		foreach ($config['rows'] as $row) {
			$this->queue->expects()->add_scheduled_post( $row->post_id, $row->status, $row->change_date );
		}
        $this->subscriber->process_scheduled_posts();
    }
}
