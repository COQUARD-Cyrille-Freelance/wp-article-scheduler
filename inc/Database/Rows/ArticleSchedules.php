<?php

namespace CoquardcyrWpArticleScheduler\Database\Rows;

use CoquardcyrWpArticleScheduler\Dependencies\BerlinDB\Database\Row;

class ArticleSchedules extends Row {

	/**
	 * @var int
	 */
	public $id;

	/**
	 * @var false|int
	 */
	public $modified;

	public $post_id;

	public $status;

	public $change_date;

	/**
	 * @var false|int
	 */
	public $last_accessed;

    /**
     * ArticleSchedules constructor.
     *
     * @param object $item Current row details.
     */
    public function __construct( $item ) {
        parent::__construct( $item );
        $this->id            = (int) $this->id;
		$this->post_id = (int) $this->post_id;
		$this->status = (string) $this->status;
        $this->change_date      = false === $this->change_date ? 0 : strtotime( $this->change_date );
        $this->modified      = false === $this->modified ? 0 : strtotime( $this->modified );
        $this->last_accessed = false === $this->last_accessed ? 0 : strtotime( $this->last_accessed );
    }
}
