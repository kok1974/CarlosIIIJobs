<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    CarlosIIIJobs
 * @subpackage CarlosIIIJobs/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    CarlosIIIJobs
 * @subpackage CarlosIIIJobs/includes
 * @author     Your Name <email@example.com>
 */
class CarlosIIIJobs_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		self::CarlosIIIJobInstallSuscriptores();
		// Podríamos crear una función para modificar la tabla e incluir la nueva
		// columna 'titulación'. Pero activando y desactivan el plugging lo hace.
	}

	private static function CarlosIIIJobInstallSuscriptores() {
		global $wpdb;
	
		$table_name = $wpdb->prefix . "c3jSuscriptores";
		$charset_collate = $wpdb->get_charset_collate();
	
		// varchar(4) en titulacion por si queremos meter ASIR
		$sql = "CREATE TABLE $table_name (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  email varchar(100) DEFAULT '' NOT NULL,
		  titulacion varchar(4) DEFAULT '' NOT NULL,
		  PRIMARY KEY  (id)
		) $charset_collate;";
	
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

}
