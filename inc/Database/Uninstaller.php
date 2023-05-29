<?php

namespace CoquardcyrWpArticleScheduler\Database;

use CoquardcyrWpArticleScheduler\Database\Tables\ArticleSchedules;
use CoquardcyrWpArticleScheduler\Dependencies\LaunchpadUninstaller\Uninstall\UninstallerInterface;

class Uninstaller implements UninstallerInterface {

	/**
	 * @var ArticleSchedules
	 */
	protected $table;

	/**
	 * @param ArticleSchedules $table
	 */
	public function __construct( ArticleSchedules $table ) {
		$this->table = $table;
	}

	/**
	 * @inheritDoc
	 */
	public function uninstall() {
		$this->table->uninstall();
	}
}