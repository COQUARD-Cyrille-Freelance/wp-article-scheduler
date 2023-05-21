<?php

namespace CoquardcyrWpArticleScheduler\Tests\Integration\inc\Engine\Admin\Subscriber;

use CoquardcyrWpArticleScheduler\Tests\Integration\TestCase;

/**
 * @covers \CoquardcyrWpArticleScheduler\Engine\Admin\Subscriber::get_subscribed_events
 */
class Test_getSubscribedEvents extends TestCase {

    /**
     * @dataProvider configTestData
     */
    public function testShouldReturnAsExpected( $config, $expected )
    {

    }
}
