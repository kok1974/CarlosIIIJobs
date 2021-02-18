<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    CarlosIIIJobs
 * @subpackage CarlosIIIJobs/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
    // Widget Backend
    function CarlosIIIJobsWidgetAdminForm( $instance, $widget ) {
    if ( isset( $instance[ 'title' ] ) ) {
    $title = $instance[ 'title' ];
    }
    else {
    $title = __( 'Suscríbete', 'CarlosIIIJobsSuscribe_widget_domain' );
    }
    // Widget admin form
    ?>
    <p>
        <label for="<?php echo $widget->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $widget->get_field_id( 'title' ); ?>" name="<?php echo $widget->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
<?php
}
