<?php

namespace CoquardcyrArticleScheduler\Database\Tables;

use CoquardcyrArticleScheduler\Dependencies\BerlinDB\Database\Table;

class ArticleSchedules extends Table {

    /**
     * Hook into queries, admin screens, and more!
     *
     * @since 1.0.0
     */
    public function __construct() {
        parent::__construct();
        add_action( 'init', [ $this, 'maybe_upgrade' ] );
        add_action( 'admin_init',  [ $this, 'maybe_trigger_recreate_table' ], 9 );
    }

    /**
     * Table name
     *
     * @var string
     */
    protected $name = 'article_schedules';

    /**
     * Database version key (saved in _options or _sitemeta)
     *
     * @var string
     */
    protected $db_version_key = 'article_schedules_version';

    /**
     * Database version
     *
     * @var int
     */
    protected $version = 20230416;

    /**
     * Key => value array of versions => methods.
     *
     * @var array
     */
    protected $upgrades = [];

    /**
     * Setup the database schema
     *
     * @return void
     */
    protected function set_schema() {
        $this->schema = "
			id               bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			post_id          bigint(20) unsigned NOT NULL,
			status           varchar(255) default '',
			change_date         timestamp           NOT NULL default '0000-00-00 00:00:00',
			modified         timestamp           NOT NULL default '0000-00-00 00:00:00',
			last_accessed    timestamp           NOT NULL default '0000-00-00 00:00:00',
			PRIMARY KEY (id),
			KEY modified (modified),
			KEY last_accessed (last_accessed)";
    }

    /**
     * Trigger recreation of cache table if not exist.
     *
     * @return void
     */
    public function maybe_trigger_recreate_table() {
        if ( $this->exists() ) {
            return;
        }

        delete_option( $this->db_version_key );
    }
}
