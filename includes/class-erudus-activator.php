<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     Your Name <email@example.com>
 */
class Erudus_Activator {


    /**
     *  activate, create db table for cache
     */
    public static function activate() {

        // create table
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'erudus_cache';

        $sql = "CREATE TABLE $table_name (
	    erudus_id varchar(40) NOT NULL,
		last_updated datetime DEFAULT NULL,
		data LONGTEXT,
		PRIMARY KEY (erudus_id)
	) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

    }

}