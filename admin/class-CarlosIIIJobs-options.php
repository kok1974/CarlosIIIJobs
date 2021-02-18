<?php
class CarlosIIIJobs_Options {

    public function CarlosIIIJob_options_menu() {
	    $hookname = add_submenu_page(
	        'edit.php?post_type=' . CarlosIIIJobs_job_type::POST_TYPE,
	        __( 'Options del plugin CarlosIIIJobs', 'textdomain' ),
	        __( 'Jobs Options', 'textdomain' ),
	        'manage_options',
	        'jobs-options',
	        array( $this, 'jobs_options_callback' )
	    );

	    add_action( 'load-' . $hookname, array($this, 'CarlosIIIJob_save_options') );
	}

    function jobs_options_callback() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/jobs-options-form.php';
	}

    public function CarlosIIIJobRegistraOpciones() {
		$opciones = array(
			array(
				'name' => 'dominio',
				'title' => 'Dominio admitido',
				'args' => array(
					'type' => 'string',
					'default' => NULL,
				),
			),
			array(
				'name' => 'nOfertas',
				'title' => 'N&uacute;mero de ofertas en Shortcode',
				'args' => array(
					'type' => 'integer',
					'default' => NULL,
				),
			),
		);
		foreach ($opciones as $opcion) {
		    register_setting( 'CarlosIIIJob_options', $opcion['name'], $opcion['args'] );
		}

		add_settings_section( 'CarlosIIIJob_options_section', 'Opciones', array($this, 'jobs_options_section_callback'), 'jobs-options');

		foreach ($opciones as $opcion) {
		    add_settings_field( $opcion['name'], $opcion['title'], array($this, 'jobs_options_' . $opcion['name'] . '_callback'), 'jobs-options', 'CarlosIIIJob_options_section');
		}

	}

    public function jobs_options_dominio_callback($args) {
    	echo '<input type="text" id="CarlosIIIJob_options_dominio" name="CarlosIIIJob_options_dominio" value="'. get_option('CarlosIIIJob_options_dominio') .'">';
    }

    public function jobs_options_nOfertas_callback($args) {
    	echo '<input type="number" id="CarlosIIIJob_options_nOfertas" name="CarlosIIIJob_options_nOfertas" value="'. get_option('CarlosIIIJob_options_nOfertas') .'">';
    }

    public function jobs_options_section_callback( $arg ) {
        echo '<hr>';       // title: Example settings section in reading
    }

    public function CarlosIIIJob_save_options() {
    	if ('POST' === $_SERVER['REQUEST_METHOD']) {
			update_option('CarlosIIIJob_options_dominio', htmlspecialchars($_POST["CarlosIIIJob_options_dominio"]));
			update_option('CarlosIIIJob_options_nOfertas', htmlspecialchars($_POST["CarlosIIIJob_options_nOfertas"]));
			wp_redirect( admin_url( 'edit.php?post_type=' . CarlosIIIJobs_job_type::POST_TYPE) );
		}
    }
}