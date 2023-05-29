<?php

namespace CoquardcyrArticleScheduler\Tests\Unit\inc\Engine\Admin\Subscriber;

use CoquardcyrArticleScheduler\Dependencies\LaunchpadBudAssets\Assets;
use Mockery;
use CoquardcyrArticleScheduler\Engine\Admin\Subscriber;
use CoquardcyrArticleScheduler\Database\Queries\ArticleSchedules;


use CoquardcyrArticleScheduler\Tests\Unit\TestCase;
use Brain\Monkey\Functions;
use Brain\Monkey\Actions;
/**
 * @covers \CoquardcyrArticleScheduler\Engine\Admin\Subscriber::meta_box_content
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

	/**
	 * @var Assets
	 */
	protected $assets;

    public function set_up() {
        parent::set_up();
        $this->query = $this->createMock(ArticleSchedules::class);
        $this->prefix = 'prefix';
		$this->assets = Mockery::mock(Assets::class);

        $this->subscriber = new Subscriber($this->query, $this->prefix);
        $this->subscriber->set_assets($this->assets);
	}

    /**
     * @dataProvider configTestData
     */
    public function testShouldDoAsExpected( $config, $expected )
    {
		Functions\when('wp_date')->justReturn('date');
		Functions\when('__')->returnArg();
		if($config['should_render']) {
			Functions\expect('get_post_statuses')->andReturn($config['statuses']);
			Actions\expectDone('prefixrender_template')->with($expected['template'], $expected['parameters']);
			$this->assets->expects()->get_full_key($expected['key'])->andReturn($config['full_key']);
			Functions\expect('wp_localize_script')->with($expected['full_key'], $expected['full_key_data'], $expected['js_data']);
		} else {
			Functions\expect('get_post_statuses')->never();
			Actions\expectDone('prefixrender_template')->never();
		}
        $this->subscriber->meta_box_content($config['post']);
    }

}
