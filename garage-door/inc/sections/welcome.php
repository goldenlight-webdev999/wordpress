<?php
/**
 * About section
 *
 * This is the template for the content of about section
 *
 * @package Theme Palace
 * @subpackage Pet
 * @since Garage Door 1.0.0
 */
if ( ! function_exists( 'pet_business_add_welcome_section' ) ) :
    /**
    * Add about section
    *
    *@since Garage Door 1.0.0
    */
    function pet_business_add_welcome_section() {
    	$options = pet_business_get_theme_options();
        // Check if about is enabled on frontpage
        $about_enable = apply_filters( 'pet_business_section_status', true, 'welcome_section_enable' );

        if ( ! $about_enable) {
            return false;
        }
        // Get about section details
        $section_details = array();
        $section_details = apply_filters( 'pet_business_filter_welcome_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render about section now.
        pet_business_render_about_section( $section_details );
    }
endif;

if ( ! function_exists( 'pet_business_get_about_section_details' ) ) :
    /**
    * about section details.
    *
    * @since Garage Door 1.0.0
    * @param array $input about section details.
    */
    function pet_business_get_about_section_details( $input ) {
        $options = pet_business_get_theme_options();
        
        $content = array();
        $page_id = ! empty( $options['about_content_page'] ) ? $options['about_content_page'] : '';
        $args = array(
            'post_type'         => 'page',
            'page_id'           => $page_id,
            'posts_per_page'    => 1,
            );                    
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) : 
                while ( $query->have_posts() ) : $query->the_post();
                    $page_post['title']     = get_the_title();
                    $page_post['url']       = get_the_permalink();
                    $page_post['excerpt']   = pet_business_trim_content( 50 );
                    $page_post['image_url'] = get_the_post_thumbnail_url();
                    $page_post['content']   = get_the_content();

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
// about section content details.
add_filter( 'pet_business_filter_welcome_section_details', 'pet_business_get_about_section_details' );


if ( ! function_exists( 'pet_business_render_about_section' ) ) :
  /**
   * Start about section
   *
   * @return string about content
   * @since Garage Door 1.0.0
   *
   */
   function pet_business_render_about_section( $content_details = array() ) {
        $options = pet_business_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } 

        foreach ( $content_details as $content ) : 
            ?>
            <div id="welcome" class="">
                <?php if ( $options['welcome_section_enable'] ) : ?>
                    <div class="welcome-description col-2">
                        <div class="content_details">
                            <?php echo $content['content']; ?>
                        </div>
                        <div class="btns">
                            <?php if ( ! empty( $options['read_more_btn_title'] ) ) : ?>
                            <div class="read-more">
                                <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn btn-primary"><?php echo esc_html( $options['read_more_btn_title'] ); ?></a>
                            </div><!-- .read-more -->
                            <?php endif; ?>

                            <?php if ( ! empty( $options['contact_us_btn_title'] ) ) : ?>
                                <div class="contact-us">
                                    <a href="<?php if ( ! empty( $options['contact_us_btn_link'] ) ) echo $options['contact_us_btn_link']; ?>" class="btn btn-primary"><?php echo esc_html( $options['contact_us_btn_title'] ); ?></a>
                                </div><!-- .read-more -->
                            <?php endif; ?>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="welcome-image col-2" style="">
                        <img src="<?php echo $content['image_url']; ?>">
                    </div>
                    <div class="clr"></div>                    
                <?php endif; ?>
            </div><!-- #about-me -->
        <?php endforeach;
    }
endif;