<?php

namespace CoquardcyrWpArticleScheduler\Database\Rows;

use CoquardcyrWpArticleScheduler\Dependencies\BerlinDB\Database\Row;

class ArticleSchedules extends Row {

    /**
     * ArticleSchedules constructor.
     *
     * @param object $item Current row details.
     */
    public function __construct( $item ) {
        parent::__construct( $item );
        $this->id            = (int) $this->id;
        $this->modified      = false === $this->modified ? 0 : strtotime( $this->modified );
        $this->last_accessed = false === $this->last_accessed ? 0 : strtotime( $this->last_accessed );
    }
}
