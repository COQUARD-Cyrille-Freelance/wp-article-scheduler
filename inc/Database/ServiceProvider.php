<?php

namespace CoquardcyrWpArticleScheduler\Database;

use CoquardcyrWpArticleScheduler\Database\Queries\ArticleSchedules;
use CoquardcyrWpArticleScheduler\Dependencies\LaunchpadCore\Container\AbstractServiceProvider;

/**
 * Service provider.
 */
class ServiceProvider extends AbstractServiceProvider {


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
	}
}
