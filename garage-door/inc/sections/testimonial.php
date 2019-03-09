<?php
/**
 * Testimonial section
 *
 * This is the template for the content of testimonial section
 *
 * @package Theme Palace
 * @subpackage Pet
 * @since Garage Door 1.0.0
 */
if ( ! function_exists( 'pet_business_add_testimonial_section' ) ) :
    /**
    * Add testimonial section
    *
    *@since Garage Door 1.0.0
    */
    function pet_business_add_testimonial_section() {
        $options = pet_business_get_theme_options();
        // Check if testimonial is enabled on frontpage
        $testimonial_enable = apply_filters( 'pet_business_section_status', true, 'testimonial_section_enable' );

        if ( true !== $testimonial_enable ) {
            return false;
        }
        // Get testimonial section details
        $section_details = array();
        $section_details = apply_filters( 'pet_business_filter_testimonial_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render testimonial section now.
        pet_business_render_testimonial_section( $section_details );
    }
endif;

if ( ! function_exists( 'pet_business_get_testimonial_section_details' ) ) :
    /**
    * testimonial section details.
    *
    * @since Garage Door 1.0.0
    * @param array $input testimonial section details.
    */
    function pet_business_get_testimonial_section_details( $input ) {
        $options = pet_business_get_theme_options();
        
        $content = array();
        $page_ids = array();

        for ( $i = 1; $i <= 1; $i++ ) {
            if ( ! empty( $options['testimonial_content_page_' . $i] ) )
                $page_ids[] = $options['testimonial_content_page_' . $i];
        }

        $args = array(
            'post_type'         => 'page',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'        => 1,
            'orderby'           => 'post__in',
            );                    

            // Run The Loop.
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) : 
                while ( $query->have_posts() ) : $query->the_post();
                    //$page_post['title']     = get_the_title();
                    //$page_post['url']     = get_permalink();
                    $page_post['excerpt']   = get_the_content();
                    //$page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'large' ) : '';
                    // Push to the main array.
                    array_push( $content, $page_post );
                endwhile;
            endif;
            wp_reset_postdata();

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// testimonial section content details.
add_filter( 'pet_business_filter_testimonial_section_details', 'pet_business_get_testimonial_section_details' );


if ( ! function_exists( 'pet_business_render_testimonial_section' ) ) :
  /**
   * Start testimonial section
   *
   * @return string testimonial content
   * @since Garage Door 1.0.0
   *
   */
   function pet_business_render_testimonial_section( $content_details = array() ) {
        $options = pet_business_get_theme_options();
        $testimonial_bg =  ( ! empty( $options['testimonial_bg'] ) ) ? $options['testimonial_bg'] : '' ;

        if ( empty( $content_details ) ) {
            return;
        } 
        ?>

        <div id="client-testimonial" class="relative page-section" style="background-image: url('<?php echo esc_url( $testimonial_bg ); ?>')">
            <div class="overlay"></div>
            <div class="">
                <?php 
                $i = 1;
                foreach ( $content_details as $content ) : ?>
                <?php if ( ! empty( $content['excerpt'] ) ) : ?>
                    <div class="entry-content">
                        <?php echo do_shortcode($content['excerpt']); ?>
                    </div><!-- .entry-content -->
                <?php endif; ?>
                <?php 
                $i++;
                endforeach; ?>                
            </div><!-- .wrapper -->
        </div><!-- #testimonial -->
    <?php }
endif;