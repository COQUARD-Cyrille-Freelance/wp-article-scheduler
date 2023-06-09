<?php

namespace CoquardcyrArticleScheduler\Database;

use CoquardcyrArticleScheduler\Database\Queries\ArticleSchedules;
use CoquardcyrArticleScheduler\Dependencies\LaunchpadCore\Container\AbstractServiceProvider;
use CoquardcyrArticleScheduler\Dependencies\LaunchpadUninstaller\Uninstall\HasUninstallerServiceProviderInterface;
use CoquardcyrArticleScheduler\Dependencies\League\Container\Definition\Definition;

/**
 * Service provider.
 */
class ServiceProvider extends AbstractServiceProvider implements HasUninstallerServiceProviderInterface {


	/**
	 * Registers items with the container
	 *
	 * @return void
	 */
	public function define() {

		$this->register_service( ArticleSchedules::class );

		$this->register_service(
			Tables\ArticleSchedules::class,
			function () {
				$this->getContainer()->get( Tables\ArticleSchedules::class );
			}
			);

		$this->register_service(Uninstaller::class, function (Definition $definition) {
			$definition->addArgument($this->getContainer()->get(Tables\ArticleSchedules::class));
		});
	}

	public function get_uninstallers(): array {
		return [
			Uninstaller::class,
		];
	}
}
