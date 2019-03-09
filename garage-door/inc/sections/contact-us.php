<?php
/**
 * Call to action section
 *
 * This is the template for the content of cta section
 *
 * @package Theme Palace
 * @subpackage Pet
 * @since Garage Door 1.0.0
 */
if ( ! function_exists( 'pet_business_add_cta_section' ) ) :
    /**
    * Add cta section
    *
    *@since Garage Door 1.0.0
    */
    function pet_business_add_cta_section() {
    	$options = pet_business_get_theme_options();
        // Check if cta is enabled on frontpage
         $cta_enable = apply_filters( 'pet_business_section_status', true, 'cta_section_enable' );

        if ( true !== $cta_enable ) {
            return false;
        }
        // Get cta section details
        $section_details = array();
        $section_details = apply_filters( 'pet_business_filter_cta_section_details', $section_details );
        if ( empty( $section_details ) ) {
            return;
        }

        // Render cta section now.
        pet_business_render_cta_section( $section_details );
    }
endif;

if ( ! function_exists( 'pet_business_get_cta_section_details' ) ) :
    /**
    * cta section details.
    *
    * @since Garage Door 1.0.0
    * @param array $input cta section details.
    */
    function pet_business_get_cta_section_details( $input ) {
        $options = pet_business_get_theme_options();
            
            $content = array();
                    $page_id = ! empty( $options['cta_content_page'] ) ? $options['cta_content_page'] : '';

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
                        $page_post['url']       = get_the_permalink();
                        $page_post['excerpt']   = pet_business_trim_content( 25 );
                        $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : '';

                        // Push to the main array.
                        array_push( $content, $page_post );
                    endwhile;
                endif;
                wp_reset_postdata();
        
            if ( ! empty( $content ) ) {
                $input[] = $content;
            }
        return $input;
    }
endif;
// cta section content details.
add_filter( 'pet_business_filter_cta_section_details', 'pet_business_get_cta_section_details' );


if ( ! function_exists( 'pet_business_render_cta_section' ) ) :
  /**
   * Start cta section
   *
   * @return string cta content
   * @since Garage Door 1.0.0
   *
   */
   function pet_business_render_cta_section( $content_details = array() ) {
        $options = pet_business_get_theme_options();        
        $cta_image = ! empty( $options['cta_image'] ) ? $options['cta_image'] : '';
        $cta_phone_title = ! empty( $options['cta_phone_title'] ) ? $options['cta_phone_title'] : '';
        $cta_phone_number = ! empty( $options['cta_phone_number'] ) ? $options['cta_phone_number'] : '';
        $cta_btn_title = ! empty( $options['cta_btn_title'] ) ? $options['cta_btn_title'] : '';
        $cta_btn_link = ! empty( $options['cta_btn_link'] ) ? $options['cta_btn_link'] : '';
        if ( empty( $content_details ) ) {
            return;
        } 
        ?>

        <div id="call-to-action" class="relative page-section">
            <div class="wrapper">
                <div class="section-content">
                    <div class="col motor-img">
                        <img src="<?php echo $cta_image;?>">
                    </div>
                    <div class="col phone">
                        <div class="content"><a href="tel:<?php echo $cta_phone_number?>"><span><?php echo $cta_phone_title;?></span></a></div>
                    </div>
                    <div class="col contact-btn">
                        <div class="content"><a href="<?php echo $cta_btn_link;?>"><span><?php echo $cta_btn_title;?></span></a></div>
                    </div>
                    <div class="clr"></div>
                </div><!-- .section-content-->
            </div><!-- .wrapper -->
        </div><!-- #call-to-action -->
    <?php
    }
endif;