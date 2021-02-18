<?php

// Registrar y cargar el widget
function CarlosIIISuscribe_load_widget() {
    register_widget( 'CarlosIIIJobsWidgetSuscribe' );
}
add_action( 'widgets_init', 'CarlosIIISuscribe_load_widget' );

// Creando el widget
class CarlosIIIJobsWidgetSuscribe extends WP_Widget {

    function __construct() {
        parent::__construct(

// ID base del widget
            'CarlosIIIJobsWidgetSuscribe',

// Nombre del widget que aparecerá en la UI
            __('CarlosIIIJobs Suscribe Widget', 'CarlosIIIJobsSuscribe_widget_domain'),

// Descripción del widget
            array( 'description' => __( 'Suscribirse a las ofertas de empleo del C.I.F.P Carlos III', 'CarlosIIIJobsSuscribe_widget_domain' ), )
        );
    }

// Creando la vista del widget del Frontend

    public function widget( $args, $instance ) {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/CarlosIIIJobs-public-display.php';

        CarlosIIIJobsWidgetPublicForm($args, $instance);
    }


// Creando la vista del widget del Backend
    public function form( $instance ) {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/CarlosIIIJobs-admin-display.php';


        CarlosIIIJobsWidgetAdminForm($instance, $this);
    }

// Actualizando el widget reemplazando la instancia antigua por la nueva
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class CarlosIIIJobsWidgetSuscribe ends here