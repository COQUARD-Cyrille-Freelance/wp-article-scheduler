<?php

namespace CoquardcyrArticleScheduler;

use CoquardcyrArticleScheduler\Dependencies\LaunchpadUninstaller\Uninstall\HasUninstallerServiceProviderInterface;

class ServiceProvider extends Dependencies\LaunchpadAutoresolver\ServiceProvider implements HasUninstallerServiceProviderInterface {

	/**
	 * Return IDs from admin subscribers.
	 *
	 * @return string[]
	 */
	public function get_admin_subscribers(): array {
		return [
			\CoquardcyrArticleScheduler\Engine\Admin\Subscriber::class,
		];
	}

	/**
	 * Return IDs from common subscribers.
	 *
	 * @return string[]
	 */
	public function get_common_subscribers(): array {
		return [
			\CoquardcyrArticleScheduler\Engine\Cron\Subscriber::class,
		];
	}

	public function get_uninstallers(): array {
		return [
			\CoquardcyrArticleScheduler\Engine\Admin\Subscriber::class,
		];
	}
}
