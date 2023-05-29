<?php

namespace CoquardcyrArticleScheduler\Database\Schemas;

use CoquardcyrArticleScheduler\Dependencies\BerlinDB\Database\Schema;

class ArticleSchedules extends Schema {

    /**
     * Array of database column objects
     *
     * @var array
     */
    public $columns = [

        // ID column.
        [
            'name'     => 'id',
            'type'     => 'bigint',
            'length'   => '20',
            'unsigned' => true,
            'extra'    => 'auto_increment',
            'primary'  => true,
            'sortable' => true,
        ],

	    // STATUS column.
	    [
		    'name'       => 'status',
		    'type'       => 'varchar',
		    'length'     => '255',
		    'default'    => '',
		    'cache_key'  => true,
		    'searchable' => true,
		    'sortable'   => true,
	    ],

	    // POST_ID column.
	    [
		    'name'       => 'post_id',
		    'type'       => 'int',
		    'length'     => '10',
		    'default'    => 0,
		    'cache_key'  => false,
		    'searchable' => true,
		    'sortable'   => true,
	    ],

	    // CHANGE_DATE column.
	    [
		    'name'       => 'change_date',
		    'type'       => 'timestamp',
		    'default'    => '0000-00-00 00:00:00',
		    'created'    => true,
		    'date_query' => true,
		    'sortable'   => true,
	    ],

        // MODIFIED column.
        [
            'name'       => 'modified',
            'type'       => 'timestamp',
            'default'    => '0000-00-00 00:00:00',
            'created'    => true,
            'date_query' => true,
            'sortable'   => true,
        ],

        // LAST_ACCESSED column.
        [
            'name'       => 'last_accessed',
            'type'       => 'timestamp',
            'default'    => '0000-00-00 00:00:00',
            'created'    => true,
            'date_query' => true,
            'sortable'   => true,
        ],

    ];
}
