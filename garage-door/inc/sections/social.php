<?php
/**
 * Contact section
 *
 * This is the template for the content of contact section
 *
 * @package Theme Palace
 * @subpackage Pet
 * @since Garage Door 1.0.0
 */
if ( ! function_exists( 'pet_business_add_contact_section' ) ) :
    /**
    * Add contact section
    *
    *@since Garage Door 1.0.0
    */
    function pet_business_add_contact_section() {
    	$options = pet_business_get_theme_options();
        // Check if contact is enabled on frontpage
        $contact_enable = apply_filters( 'pet_business_section_status', true, 'contact_section_enable' );

        if ( true !== $contact_enable ) {
            return false;
        }
        // Get contact section details
        $section_details = array();
        $section_details = apply_filters( 'pet_business_filter_contact_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render contact section now.
        pet_business_render_contact_section( $section_details );
    }
endif;

if ( ! function_exists( 'pet_business_get_contact_section_details' ) ) :
    /**
    * contact section details.
    *
    * @since Garage Door 1.0.0
    * @param array $input contact section details.
    */
    function pet_business_get_contact_section_details( $input ) {
        $options = pet_business_get_theme_options();
        
        $content = array();
        $page_id = ! empty( $options['contact_content_page'] ) ? $options['contact_content_page'] : '';
        $args = array(
            'post_type'         => 'page',
            'page_id'           => $page_id,
            'posts_per_page'    => 1,
            );                    

            // Run The Loop.
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) : 
                while ( $query->have_posts() ) : $query->the_post();
                    $page_post['title']     = get_the_title();
                    $page_post['excerpt']   = pet_business_trim_content( 25 );
                    $page_post['image']   = get_the_post_thumbnail_url( get_the_ID(), 'large' );

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
// contact section content details.
add_filter( 'pet_business_filter_contact_section_details', 'pet_business_get_contact_section_details' );


if ( ! function_exists( 'pet_business_render_contact_section' ) ) :
  /**
   * Start contact section
   *
   * @return string contact content
   * @since Garage Door 1.0.0
   *
   */
   function pet_business_render_contact_section( $content_details = array() ) {
        $options = pet_business_get_theme_options();
        $facebook_shortcode = ! empty( $options['facebook_shortcode'] ) ? $options['facebook_shortcode'] : '';
        $instagram_shortcode = ! empty( $options['instagram_shortcode'] ) ? $options['instagram_shortcode'] : '';
              
        ?>
        <div id="social-bottom" class="relative page-section">
            <div class="wrapper">                
                <div class="col fleft facebook-wrpper">
                    <div class="ico hundred"></div>
                    <?php if ( $facebook_shortcode ) { ?>
                        <div class="facebook-inner">
                            <?php echo do_shortcode( $facebook_shortcode ); ?>  
                        </div><!-- .contact-form -->
                    <?php } ?>
                </div>
                <div class="col fright instagram-wrpper">
                    <div class="ico hundred"></div>
                    <?php if ( $instagram_shortcode ) { ?>
                        <div class="instagram-inner">
                            <?php echo do_shortcode( $instagram_shortcode ); ?>  
                        </div><!-- .contact-form -->
                    <?php } ?>
                </div>                
            </div><!-- .wrapper -->
        </div><!-- #contact-us -->
    <?php 
    }
endif;