<?php

namespace CoquardcyrWpArticleScheduler\Tests\Unit\inc\Engine\Admin\Subscriber;

use Mockery;
use CoquardcyrWpArticleScheduler\Engine\Admin\Subscriber;
use CoquardcyrWpArticleScheduler\Database\Queries\ArticleSchedules;


use CoquardcyrWpArticleScheduler\Tests\Unit\TestCase;
use Brain\Monkey\Functions;
use Brain\Monkey\Actions;
/**
 * @covers \CoquardcyrWpArticleScheduler\Engine\Admin\Subscriber::meta_box_content
 */
class Test_metaBoxContent extends TestCase {

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
		if($config['should_render']) {
			Functions\expect('get_post_statuses')->andReturn($config['statuses']);
			Actions\expectDone('prefixrender_template')->with($expected['template'], $expected['parameters']);
		} else {
			Functions\expect('get_post_statuses')->never();
			Actions\expectDone('prefixrender_template')->never();
		}
        $this->subscriber->meta_box_content($config['post']);
    }

}
