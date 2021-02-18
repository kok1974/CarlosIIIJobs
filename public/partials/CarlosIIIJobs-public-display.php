<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    CarlosIIIJobs
 * @subpackage CarlosIIIJobs/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
    function CarlosIIIJobsWidgetPublicForm($args, $instance) {
    $title = apply_filters( 'widget_title', $instance['title'] );

    // los argumentos before y after del widget son definidos por el tema
    echo $args['before_widget'];
    if ( ! empty( $title ) )
    echo $args['before_title'] . $title . $args['after_title'];

    // Aquí es donde ejecutaremos el código y mostramos la salida
    echo __( 'Suscríbete para recibir nuestras ofertas de trabajo', 'CarlosIIIJobsSuscribe_widget_domain' );
    echo $args['after_widget'];
    ?>
    <form action="http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" method="post">

        <p>
            <label for="solo-subscribe-email"><?php _e('E-Mail:', 'subscribe-to-comments'); ?>
                <input type="email" name="email" id="solo-subscribe-email" size="22" value="" /></label>
            <input type="submit" name="submit" value="<?php _e('Subscribe', 'subscribe-to-comments'); ?>" />
        </p>
    </form>
<?php
}
