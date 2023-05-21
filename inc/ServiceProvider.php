<?php

namespace CoquardcyrWpArticleScheduler;

class ServiceProvider extends Dependencies\LaunchpadAutoresolver\ServiceProvider {

	/**
	 * Return IDs from admin subscribers.
	 *
	 * @return string[]
	 */
	public function get_admin_subscribers(): array {
		return [
			\CoquardcyrWpArticleScheduler\Engine\Admin\Subscriber::class,
		];
	}

	/**
	 * Return IDs from common subscribers.
	 *
	 * @return string[]
	 */
	public function get_common_subscribers(): array {
		return [
			\CoquardcyrWpArticleScheduler\Engine\Cron\Subscriber::class,
		];
	}
}
