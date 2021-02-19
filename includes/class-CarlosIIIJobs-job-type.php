<?php

if(!class_exists('CarlosIIIJobs_job_type'))
{
    /**
     * Un PostType que almacenará ofertas de empleo con 3 campos meta adicionales
     */
    class CarlosIIIJobs_job_type
    {
        const POST_TYPE	= "job"; // Nombre que le daremos al tipo de post

        // Los metas adicionales que vamos a asociar a las ofertas de empleo
        private $_meta	= array(
            'empresa',
            'titulacion',
            'fct',
        );

        /**
         * El constructor
         */
        public function __construct()
        {
            // registrar las acciones
            add_action('init', array(&$this, 'init'));
        } // END public function __construct()

        /**
         * hook into WP's init action hook
         */
        public function init()
        {
            // Inicializa el Post Type
            $this->create_post_type();
            add_action('save_post', array(&$this, 'save_post'));
            add_action('publish_job', array(&$this, 'send_mail'));
        } // END public function init()

        /**
         * Crea el post type
         */
        public function create_post_type()
        {
            register_post_type(self::POST_TYPE,
                array(
                    'labels' => array(
                        'name' => __(sprintf('%ss', ucwords(str_replace("_", " ", self::POST_TYPE)))),
                        'singular_name' => __(ucwords(str_replace("_", " ", self::POST_TYPE)))
                    ),
                    'public' => true,
                    'has_archive' => true,
                    'description' => __("This is a sample post type meant only to illustrate a preferred structure of plugin development"),
                    'supports' => array(
                        'title', 'editor',
                    ),
                )
            );
        }

        /**
         * Guarda los meta asociados a una oferta de empleo
         */
        public function save_post($post_id)
        {
            // verify if this is an auto save routine.
            // If it is our form has not been submitted, so we dont want to do anything
            if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            {
                return;
            }

            if(isset($_POST['post_type']) && $_POST['post_type'] == self::POST_TYPE && current_user_can('edit_post', $post_id))
            {
                foreach($this->_meta as $field_name)
                {
                    // Update the post's meta field
                    update_post_meta($post_id, $field_name, $_POST[$field_name]);
                }
            }
            else
            {
                return;
            } // if($_POST['post_type'] == self::POST_TYPE && current_user_can('edit_post', $post_id))
        } // END public function save_post($post_id)

/**
         * Send mail to subscribers
         */
        public function send_mail($post_id)
        {
            if($emails = get_option('CarlosIIIJob_suscriptores')) {
                $post = get_post($post_id);
                $author = $post->post_author; /* Post author ID. */
//                $name = get_the_author_meta( 'display_name', $author );
                $email = get_the_author_meta( 'user_email', $author );
                $title = $post->post_title;
                $permalink = get_permalink( $post_id );
                $edit = get_edit_post_link( $post_id, '' );
                foreach ($emails as $email) {
                    $to[] = $email;
                }
                $subject = sprintf( 'Published: %s', $title );
                $message = sprintf ('Congratulations! Your article “%s” has been published.' . "\n\n", $title );
                $message .= sprintf( 'View: %s', $permalink );
                $headers[] = '';

                wp_mail( $to, $subject, $message, $headers );

            }
        } 

        /**
         * hook into WP's admin_init action hook
         */
        public function admin_init()
        {
            // Add metaboxes
            add_action('add_meta_boxes', array(&$this, 'add_meta_boxes'));
        } // END public function admin_init()

        /**
         * hook into WP's add_meta_boxes action hook
         */
        public function add_meta_boxes()
        {
            // Añade este metabox por cada post seleccionado
            add_meta_box(
                sprintf('wp_plugin_template_%s_section', self::POST_TYPE),
                sprintf('%s Information', ucwords(str_replace("_", " ", self::POST_TYPE))),
                array(&$this, 'add_inner_meta_boxes'),
                self::POST_TYPE
            );
        } // END public function add_meta_boxes()

        /**
         * called off of the add meta box
         */
        public function add_inner_meta_boxes($post)
        {
            // Renderiza el job metabox
            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/job-type-template-metabox.php';
        } // END public function add_inner_meta_boxes($post)

    } // END class CarlosIIIJobs_job_type
} // END if(!class_exists('CarlosIIIJobs_job_type'))