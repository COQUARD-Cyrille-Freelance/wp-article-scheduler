<?php

namespace CoquardcyrWpArticleScheduler;

use CoquardcyrWpArticleScheduler\Dependencies\LaunchpadUninstaller\Uninstall\HasUninstallerServiceProviderInterface;
use CoquardcyrWpArticleScheduler\Dependencies\LaunchpadUninstaller\Uninstall\UninstallServiceProviderInterface;

class ServiceProvider extends Dependencies\LaunchpadAutoresolver\ServiceProvider implements HasUninstallerServiceProviderInterface {

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

	public function get_uninstallers(): array {
		return [
			\CoquardcyrWpArticleScheduler\Engine\Admin\Subscriber::class,
		];
	}
}
