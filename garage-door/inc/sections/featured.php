<?php
/**
 * Blog section
 *
 * This is the template for the content of blog section
 *
 * @package Theme Palace
 * @subpackage Pet
 * @since Garage Door 1.0.0
 */
if ( ! function_exists( 'pet_business_add_blog_section' ) ) :
    /**
    * Add blog section
    *
    *@since Garage Door 1.0.0
    */
    function pet_business_add_blog_section() {
    	$options = pet_business_get_theme_options();
        // Check if blog is enabled on frontpage
        $blog_enable = apply_filters( 'pet_business_section_status', true, 'blog_section_enable' );

        if ( true !== $blog_enable ) {
            return false;
        }
        // Get blog section details
        $section_details = array();
        $section_details = apply_filters( 'pet_business_filter_blog_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render blog section now.
        pet_business_render_blog_section( $section_details );
    }
endif;

if ( ! function_exists( 'pet_business_get_blog_section_details' ) ) :
    /**
    * blog section details.
    *
    * @since Garage Door 1.0.0
    * @param array $input blog section details.
    */
    function pet_business_get_blog_section_details( $input ) {
        $options = pet_business_get_theme_options();
        
        $content = array();
        $page_ids = array();

        for ( $i = 1; $i <= 3; $i++ ) {
            if ( ! empty( $options['featured_page_' . $i] ) )
                $page_ids[] = $options['featured_page_' . $i];
        }
        
        $args = array(
            'post_type'         => 'page',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => 2,
            'orderby'           => 'post__in',
            );                    

            // Run The Loop.
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) : 
                while ( $query->have_posts() ) : $query->the_post();
                    $page_post['title']     = get_the_title();
                    $page_post['url']       = get_the_permalink();
                    $page_post['excerpt']   = get_the_content();
                    $page_post['image']   = get_the_post_thumbnail_url( null, 'large' );

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
// blog section content details.
add_filter( 'pet_business_filter_blog_section_details', 'pet_business_get_blog_section_details' );


if ( ! function_exists( 'pet_business_render_blog_section' ) ) :
  /**
   * Start blog section
   *
   * @return string blog content
   * @since Garage Door 1.0.0
   *
   */
   function pet_business_render_blog_section( $content_details = array() ) {
        $options = pet_business_get_theme_options();
        $blog_content_type  = $options['blog_content_type'];

        if ( empty( $content_details ) ) {
            return;
        } ?>

        <div id="latest-posts" class="relative page-section">
                <div class="">                        
                    <!-- supports col-1, col-2 and col-3 -->                    
                    <?php 
                        $i = 1;
                        foreach ( $content_details as $content ) : 
                            if ($i == 1) :?>
                                <div class="col-1 item">
                                    
                                    <div class="col-2">
                                        <div class="entry-container featured-content top"> 

                                            <div class="entry-content">
                                                <p><?php echo $content['excerpt'] ; ?></p>
                                            </div>                                       
                                            
                                        </div><!-- .entry-container -->
                                    </div>

                                    <div class="col-2 image">
                                        <?php if ( ! empty( $content['image'] ) ) : ?>
                                            <div class="featured-image">
                                                <img src="<?php echo esc_url( $content['image'] ); ?>">
                                            </div><!-- .featured-image -->
                                        <?php endif; ?>
                                    </div>
                                    <div class="clr"></div>
                                </div><!-- .section-content -->

                            <?php else:?>
                                <div class="col-1 item"> 
                                    <div class="col-2 image">
                                        <?php if ( ! empty( $content['image'] ) ) : ?>
                                            <div class="featured-image">
                                                <img src="<?php echo esc_url( $content['image'] ); ?>">
                                            </div><!-- .featured-image -->
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-2">
                                        <div class="entry-container featured-content bottom"> 
                                            <div class="entry-content">
                                                <p><?php echo $content['excerpt'] ; ?></p>
                                            </div>
                                        </div><!-- .entry-container -->
                                    </div>
                                    <div class="clr"></div>
                                </div><!-- .section-content -->
                                <div class="clr"></div>
                            <?php endif;?>
                        <?php
                        $i++ ;                        
                        endforeach; ?>
                    
                </div><!-- .wrapper -->
            </div><!-- #latest-posts -->

    <?php }
endif;