<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    CarlosIIIJobs
 * @subpackage CarlosIIIJobs/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    CarlosIIIJobs
 * @subpackage CarlosIIIJobs/admin
 * @author     Your Name <email@example.com>
 */
class CarlosIIIJobs_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $CarlosIIIJobs    The ID of this plugin.
	 */
	private $CarlosIIIJobs;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $CarlosIIIJobs       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $CarlosIIIJobs, $version ) {

		$this->CarlosIIIJobs = $CarlosIIIJobs;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in CarlosIIIJobs_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CarlosIIIJobs_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->CarlosIIIJobs, plugin_dir_url( __FILE__ ) . 'css/CarlosIIIJobs-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in CarlosIIIJobs_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CarlosIIIJobs_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->CarlosIIIJobs, plugin_dir_url( __FILE__ ) . 'js/CarlosIIIJobs-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function CarlosIIIJob_suscribe() {
		$response = array(
		    'error' => false,
		);

		$emailSuscriptor = htmlspecialchars($_POST["email"]);
        if(!$this->getSuscriptor($emailSuscriptor)) {
            $this->addSuscriptor($emailSuscriptor);
			$response['message'] = __("Solicitud registrada correctamente");
		} else {
			$response['message'] = __("Usted ya solicitó subscribirse");
		}
		exit(json_encode($response));
	}

	public function getSuscriptor($emailSuscriptor) {
		global $wpdb;
 
			$table_name = $wpdb->prefix . "c3jSuscriptores";
				// convendría no duplicar este código
				// Una buena forma sería crear una constante en la clase CarlosIIIJobs con:
				// const C3JSUSCRIPTORES_TABLE = 'c3jSuscriptores';
				// y acceder a ella desde este código
				// $table_name = $wpdb->prefix . CarlosIIIJobs::C3JSUSCRIPTORES_TABLE;
			$query = "SELECT count(email) FROM $table_name WHERE email = %s";
			$existeSuscriptor = $wpdb->get_var( $wpdb->prepare($query, $emailSuscriptor)); 
			return $existeSuscriptor > 0;
	 }
 
	 public function addSuscriptor($emailSuscriptor) {
		global $wpdb;
 
			$table_name = $wpdb->prefix . "c3jSuscriptores";
			$wpdb->insert(
				$table_name,
				array(
						'email' => $emailSuscriptor,
						'time' => current_time('mysql', 2),
				),
				array('%s')
			);
	 }

}
