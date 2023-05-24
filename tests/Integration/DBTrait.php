<?php

namespace CoquardcyrWpArticleScheduler\Tests\Integration;

use CoquardcyrWpArticleScheduler\Database\Tables\ArticleSchedules;
use CoquardcyrWpArticleScheduler\Dependencies\BerlinDB\Database\Query;
use CoquardcyrWpArticleScheduler\Dependencies\BerlinDB\Database\Row;
use CoquardcyrWpArticleScheduler\Dependencies\BerlinDB\Database\Table;
use ReflectionClass;

trait DBTrait {

	protected static $tables = [
		ArticleSchedules::class => \CoquardcyrWpArticleScheduler\Database\Queries\ArticleSchedules::class,
	];

	public function is_found(Row $data, array $hidden = []): bool {
		$query = self::find_right_query($data);

		$data = (array) $data;

		foreach ($hidden as $item) {
			if(key_exists($item, $data)) {
				unset($data[$item]);
			}
		}

		return count($query->query($data)) > 0;
	}
	public function add(Row $data) {
		$query = self::find_right_query($data);
		$query->add_item((array) $data);
	}

	public static function install() {
		$tables = self::getTables();
		foreach ($tables as $table) {
			$table->install();
		}
	}

	public static function uninstall() {
		$tables = self::getTables();
		foreach ($tables as $table) {
			$table->uninstall();
		}
	}

	/**
	 * @return Table[]
	 */
	protected static function getTables(): array {
		$container             = apply_filters( 'coquardcyr_wp_article_scheduler_container', null );
		$output = [];
		foreach (self::$tables as $table => $query) {
			$table = $container->get($table);
			if(! $table) {
				continue;
			}
			$output []= $table;
		}

		return $output;
	}

	protected function find_right_query(Row $row): ?Query {
		$container             = apply_filters( 'coquardcyr_wp_article_scheduler_container', null );
		foreach (self::$tables as $query) {
			$reflection = new ReflectionClass($query);
			$property = $reflection->getProperty('item_shape');
			$property->setAccessible(true);
			$row_query = $property->getValue($query);
			if($row instanceof $row_query) {
				return $container->get($query);
			}
		}
		return null;
	}
}