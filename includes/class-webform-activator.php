<?php

/**
 * Fired during plugin activation
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Webform
 * @subpackage Webform/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Webform
 * @subpackage Webform/includes
 * @author     Akashdeep Sharma <money.shrma@gmail.com>
 */
class Webform_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {


// WP Globals
	global $table_prefix, $wpdb;

	// Customer Table
	$customerTable = $table_prefix . 'Leads';

	// Create Customer Table if not exist
	if( $wpdb->get_var( "show tables like '$customerTable'" ) != $customerTable ) {

		// Query - Create Table
		$sql = "CREATE TABLE `$customerTable` (";
		$sql .= " `Id` int(11) NOT NULL auto_increment, ";
		$sql .= " `Name` varchar(500) NOT NULL, ";
		$sql .= " `Email` varchar(500) NOT NULL, ";
		$sql .= " `Phone` varchar(500), ";
		$sql .= " `Service_Required` varchar(500) NOT NULL, ";
		$sql .= " `Date_Submission` varchar(500), ";
		$sql .= " PRIMARY KEY `customer_id` (`Id`) ";
		$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

		// Include Upgrade Script
		require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
	
		// Create Table
		dbDelta( $sql );
	}
	
	}

}
?>