<?php
if ( ! class_exists( 'WP_Post' ) ) {
    class WP_Post {

		public function __construct(array $data) {
			foreach ($data as $key => $value) {
				$this->{$key} = $value;
			}
		}

	    public $post_status;
    }
}
