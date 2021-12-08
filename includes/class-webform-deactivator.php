<?php

/**
 * Fired during plugin deactivation
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Webform
 * @subpackage Webform/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Webform
 * @subpackage Webform/includes
 * @author     Akashdeep Sharma <money.shrma@gmail.com>
 */
class Webform_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
//global $wpdb;
global $table_prefix, $wpdb;
$customerTable = $table_prefix . 'Leads';
    $wpdb->query( "DROP TABLE IF EXISTS '$customerTable'" );
    delete_option("my_plugin_db_version");
	}

}
?>