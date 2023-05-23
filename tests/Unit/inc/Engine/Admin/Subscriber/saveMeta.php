<?php

namespace CoquardcyrWpArticleScheduler\Tests\Unit\inc\Engine\Admin\Subscriber;

use Mockery;
use CoquardcyrWpArticleScheduler\Engine\Admin\Subscriber;
use CoquardcyrWpArticleScheduler\Database\Queries\ArticleSchedules;


use CoquardcyrWpArticleScheduler\Tests\Unit\TestCase;
use Brain\Monkey\Functions;
/**
 * @covers \CoquardcyrWpArticleScheduler\Engine\Admin\Subscriber::save_meta
 */
class Test_saveMeta extends TestCase {

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

	protected function tear_down() {
		unset($_POST);
		parent::tear_down();
	}

	/**
     * @dataProvider configTestData
     */
    public function testShouldDoAsExpected( $config, $expected )
    {
	    Functions\when('sanitize_text_field')->returnArg();
	    $_POST = $config['post'];
		$this->configure_nonce($config, $expected);
		$this->configure_can($config, $expected);
		$this->configure_add($config, $expected);
		$this->subscriber->save_meta($config['post_id']);
    }

	protected function configure_nonce($config, $expected) {
		if( ! $config['has_value'] ) {
			return;
		}
		Functions\expect('wp_verify_nonce')->with($expected['post_value'], $expected['action'])->andReturn($config['nonce']);
	}

	protected function configure_can($config, $expected) {
		if( ! $config['has_value'] || ! $config['nonce'] ) {
			return;
		}
		Functions\expect('current_user_can')->with($expected['capacity'], $expected['post_id'])->andReturn($config['can']);
	}

	protected function configure_add($config, $expected) {
		if( ! $config['has_value'] || ! $config['nonce'] || ! $config['can']) {
			$this->query->expects(self::never())->method('create_row');
			$this->query->expects(self::never())->method('create_or_update');
			return;
		}
		$this->query->expects(self::once())->method('create_row')->with($expected['row_data'])->willReturn($config['row']);
		$this->query->expects(self::once())->method('create_or_update')->with($expected['row']);
	}
}
