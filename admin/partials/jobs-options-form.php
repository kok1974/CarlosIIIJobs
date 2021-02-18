<div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="<?php menu_page_url( 'jobs-options' ) ?>" method="post">
            <?php
            // output security fields for the registered setting "CarlosIIIJob_options"
            settings_fields( 'CarlosIIIJob_options' );
            // output setting sections and their fields
            // (sections are registered for "CarlosIIIJob", each field is registered to a specific section)
            do_settings_sections( 'jobs-options' );
            // output save settings button
            submit_button( __( 'Save Settings', 'textdomain' ) );
            ?>
        </form>
</div>