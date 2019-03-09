<?php
/**
 * Team section
 *
 * This is the template for the content of team section
 *
 * @package Theme Palace
 * @subpackage Pet
 * @since Garage Door 1.0.0
 */
if ( ! function_exists( 'pet_business_add_team_section' ) ) :
    /**
    * Add team section
    *
    *@since Garage Door 1.0.0
    */
    function pet_business_add_team_section() {
    	$options = pet_business_get_theme_options();
        // Check if team is enabled on frontpage
        $team_enable = apply_filters( 'pet_business_section_status', true, 'team_section_enable' );

        if ( true !== $team_enable ) {
            return false;
        }
        // Get team section details
        $section_details = array();
        $section_details = apply_filters( 'pet_business_filter_team_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render team section now.
        pet_business_render_team_section( $section_details );
    }
endif;

if ( ! function_exists( 'pet_business_get_team_section_details' ) ) :
    /**
    * team section details.
    *
    * @since Garage Door 1.0.0
    * @param array $input team section details.
    */
    function pet_business_get_team_section_details( $input ) {
        $options = pet_business_get_theme_options();
        
        $content = array();
                $page_ids = array();

                for ( $i = 1; $i <= 3; $i++ ) {
                    if ( ! empty( $options['team_content_page_' . $i] ) )
                        $page_ids[] = $options['team_content_page_' . $i];
                }
                
                $args = array(
                    'post_type'         => 'page',
                    'post__in'          => ( array ) $page_ids,
                    'posts_per_page'    => 3,
                    'orderby'           => 'post__in',
                    );                    

            // Run The Loop.
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) : 
                while ( $query->have_posts() ) : $query->the_post();
                    $page_post['title']     = get_the_title();
                    $page_post['img']   = get_the_post_thumbnail_url( null, 'large' );

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
// team section content details.
add_filter( 'pet_business_filter_team_section_details', 'pet_business_get_team_section_details' );


if ( ! function_exists( 'pet_business_render_team_section' ) ) :
  /**
   * Start team section
   *
   * @return string team content
   * @since Garage Door 1.0.0
   *
   */
   function pet_business_render_team_section( $content_details = array() ) {
        $options = pet_business_get_theme_options();
        if ( empty( $content_details ) ) {
            return;
        } 
        ?>
        <div id="our-team" class="relative page-section">
            <div class="wrapper">
                <div class="section-header">
                    <?php if ( ! empty( $options['team_title'] ) ) : ?>
                        <h2 class="section-title"><?php echo esc_html( $options['team_title'] ); ?></h2>
                    <?php endif; ?>
                </div><!-- .section-header -->
                <form action="<?php echo esc_html( $options['coupon_btn_link'] ); ?>" method="POST">
                    <div class="section-content col-3">
                        <div class="radio-button-wrapper">
                            <div class="image-radio">
                                <input name="coupon-code" value="<?php echo esc_html( $options['coupon_code_1'] ); ?>" style="display:none" type="radio"/><img src="<?php echo esc_html( $options['coupon_image_url_1'] ); ?>">
                            </div>
                            <div class="image-radio">
                                <input name="coupon-code" value="<?php echo esc_html( $options['coupon_code_2'] ); ?>" style="display:none" type="radio"/><img src="<?php echo esc_html( $options['coupon_image_url_2'] ); ?>">
                            </div>
                            <div class="image-radio">
                                <input name="coupon-code" value="<?php echo esc_html( $options['coupon_code_3'] ); ?>" style="display:none" type="radio"/><img src="<?php echo esc_html( $options['coupon_image_url_3'] ); ?>">
                            </div>
                            <div class="clr"></div>
                          </div>                        
                    </div><!-- .section-content -->
                    <div class="coupon-submit-btn">                    
                        <input type="submit" name="coupon-submit" value="<?php echo esc_html( $options['coupon_btn_title'] );?>">
                    </div>
                </form>                
            </div><!-- .wrapper -->            
            <script type="text/javascript">
                jQuery("#our-team .image-radio img").click(function(){
                    jQuery(this).prev().attr('checked',true);
                  });   
            </script>
        </div><!-- #featured-team -->
            
    <?php }
endif;