<?php

namespace CoquardcyrWpArticleScheduler\Database\Queries;

use CoquardcyrWpArticleScheduler\Dependencies\BerlinDB\Database\Query;
use CoquardcyrWpArticleScheduler\Database\Rows\ArticleSchedules as Row;
use CoquardcyrWpArticleScheduler\Database\Schemas\ArticleSchedules as Schema;

class ArticleSchedules extends Query {

    /**
     * Name of the database table to query.
     *
     * @var   string
     */
    protected $table_name = 'article_schedules';

    /**
     * String used to alias the database table in MySQL statement.
     *
     * Keep this short, but descriptive. I.E. "tr" for term relationships.
     *
     * This is used to avoid collisions with JOINs.
     *
     * @var   string
     */
    protected $table_alias = 'article_schedules';
    /**
     * Name of class used to setup the database schema.
     *
     * @var string
     */
    protected $table_schema = Schema::class;

    /** Item ******************************************************************/

    /**
     * Name for a single item.
     *
     * Use underscores between words. I.E. "term_relationship"
     *
     * This is used to automatically generate action hooks.
     *
     * @var   string
     */
    protected $item_name = 'article_schedules';

    /**
     * Plural version for a group of items.
     *
     * Use underscores between words. I.E. "term_relationships"
     *
     * This is used to automatically generate action hooks.
     *
     * @var string
     */
    protected $item_name_plural = 'article_scheduless';

    /**
     * Name of class used to turn IDs into first-class objects.
     *
     * This is used when looping through return values to guarantee their shape.
     *
     * @var mixed
     */
    protected $item_shape = Row::class;
}
