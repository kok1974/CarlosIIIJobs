<?php

class CarlosIIIJobs_shortcode
{

    public function CarlosIIIJobs_shortcode_init()
    {
        function CarlosIIIJobs_shortcode($atts = [], $content = null)
        {
            if(!isset($atts['n_ofertas'])) $atts['n_ofertas'] = 5;

            $query = new WP_Query( array( 'post_type' => 'job' , 'posts_per_page' => $atts['n_ofertas']) );
            ob_start();
            if ( $query->have_posts() ) : ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div>
                        <h2><?php the_title(); ?></h2>
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
                <!-- show pagination here -->
            <?php else : ?>
                <!-- show 404 error here -->
            <?php endif; ?>
<?php
            $content = ob_get_contents ();
            ob_end_clean();
            return $content;
        }
        add_shortcode('CarlosIIIJobs', 'CarlosIIIJobs_shortcode');
    }

}
