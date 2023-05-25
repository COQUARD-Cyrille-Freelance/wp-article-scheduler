<?php
namespace EndToEndHelper\CLI;
use EndToEndHelper\Dependencies\LaunchpadCore\EventManagement\SubscriberInterface;
use WP_CLI;
class Subscriber implements SubscriberInterface {

	/**
	 * @var \wpdb
	 */
	protected $wpdb;

	/**
	 * @param \wpdb $wpdb
	 */
	public function __construct( \wpdb $wpdb ) {
		$this->wpdb = $wpdb;
	}

	/**
     * Returns an array of events that this subscriber wants to listen to.
     *
     * The array key is the event name. The value can be:
     *
     *  * The method name
     *  * An array with the method name and priority
     *  * An array with the method name, priority and number of accepted arguments
     *
     * For instance:
     *
     *  * array('hook_name' => 'method_name')
     *  * array('hook_name' => array('method_name', $priority))
     *  * array('hook_name' => array('method_name', $priority, $accepted_args))
     *  * array('hook_name' => array(array('method_name_1', $priority_1, $accepted_args_1)), array('method_name_2', $priority_2, $accepted_args_2)))
     *
     * @return array
     */
    public function get_subscribed_events() {
        return [
			'init' => 'register_export_data_table_command'
        ];
    }

	public function register_export_data_table_command() {
		if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
			return;
		}

		WP_CLI::add_command( 'export-table', [$this, 'export_data_table_command'] );
	}

	public function export_data_table_command($args, $assoc_args) {
		$assoc_args = wp_parse_args(
			$assoc_args,
			array(
				'format'    => 'json',
			)
		);
		if(count( $args ) === 0) {
			WP_CLI::error( 'You should pass a table' );
		}

		$table = array_shift($args);

		$results = $this->wpdb->get_results("select * from {$this->wpdb->prefix}$table;");
		WP_CLI::line(wp_json_encode($results));
	}

	public function insert_row_table_command($args, $assoc_args) {
		$assoc_args = wp_parse_args(
			$assoc_args,
			array(
				'format'    => 'json',
			)
		);
		if(count( $args ) < 2) {
			WP_CLI::error( 'You should pass a table and data' );
		}

		$table = array_shift($args);
		$data = array_shift($args);
		$data = json_encode($data);

		if(! $data) {
			WP_CLI::error( 'You should pass a valid data JSON' );
		}

		$this->wpdb->insert($table, $data);

		$id = $this->wpdb->insert_id;

		WP_CLI::line(wp_json_encode($id));
	}

	public function clear_table_command($args, $assoc_args) {
		$assoc_args = wp_parse_args(
			$assoc_args,
			array(
				'format'    => 'json',
			)
		);
		if(count( $args ) === 0) {
			WP_CLI::error( 'You should pass a table' );
		}

		$table = array_shift($args);

		$this->wpdb->delete( $table, array() );
	}
}
