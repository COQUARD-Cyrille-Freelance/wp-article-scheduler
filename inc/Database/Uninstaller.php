<?php

namespace CoquardcyrWpArticleScheduler\Database;

use CoquardcyrWpArticleScheduler\Database\Tables\ArticleSchedules;
use CoquardcyrWpArticleScheduler\Dependencies\LaunchpadUninstaller\Uninstall\UninstallerInterface;
use CoquardcyrWpArticleScheduler\Engine\Queue\Queue;

class Uninstaller implements UninstallerInterface {

	/**
	 * @var ArticleSchedules
	 */
	protected $table;

	/**
	 * @var Queue
	 */
	protected $queue;

	/**
	 * @param ArticleSchedules $table
	 * @param Queue $queue
	 */
	public function __construct( ArticleSchedules $table, Queue $queue ) {
		$this->table = $table;
		$this->queue = $queue;
	}

	/**
	 * @inheritDoc
	 */
	public function uninstall() {
		$this->table->uninstall();
	}
}