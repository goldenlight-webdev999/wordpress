<?php
/**
 * Coupon Section options
 *
 * @package Theme Palace
 * @subpackage Pet
 * @since Garage Door 1.0.0
 */

// Add Coupon section
$wp_customize->add_section( 'pet_business_team_section', array(
	'title'             => esc_html__( 'Coupons','pet-business' ),
	'description'       => esc_html__( 'Coupons Section options.', 'pet-business' ),
	'panel'             => 'pet_business_front_page_panel',
) );

// Coupon content enable control and setting
$wp_customize->add_setting( 'pet_business_theme_options[team_section_enable]', array(
	'default'			=> 	$options['team_section_enable'],
	'sanitize_callback' => 'pet_business_sanitize_switch_control',
) );

$wp_customize->add_control( new Pet_Business_Switch_Control( $wp_customize, 'pet_business_theme_options[team_section_enable]', array(
	'label'             => esc_html__( 'Coupon Section Enable', 'pet-business' ),
	'section'           => 'pet_business_team_section',
	'on_off_label' 		=> pet_business_switch_options(),
) ) );

// team title setting and control
$wp_customize->add_setting( 'pet_business_theme_options[team_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['team_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'pet_business_theme_options[team_title]', array(
	'label'           	=> esc_html__( 'Title', 'pet-business' ),
	'section'        	=> 'pet_business_team_section',
	'active_callback' 	=> 'pet_business_is_team_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'pet_business_theme_options[team_title]', array(
		'selector'            => '#our-team h2.section-title',
		'settings'            => 'pet_business_theme_options[team_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'pet_business_team_title_partial',
    ) );
}




	// team pages drop down chooser control and setting
	/*$wp_customize->add_setting( 'pet_business_theme_options[team_content_page_' . $i . ']', array(
		'sanitize_callback' => 'pet_business_sanitize_page',
	) );

	$wp_customize->add_control( new Pet_Business_Dropdown_Chooser( $wp_customize, 'pet_business_theme_options[team_content_page_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Page %d', 'pet-business' ), $i ),
		'section'           => 'pet_business_team_section',
		'choices'			=> pet_business_page_choices(),
		'active_callback'	=> 'pet_business_is_team_section_enable',
	) ) );*/

	

	// Separator setting
	/*$wp_customize->add_setting( 'pet_business_theme_options[team_separator_' . $i . ']', array(
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( new Pet_Business_Note_Control( $wp_customize, 'pet_business_theme_options[team_separator_' . $i . ']', array(
		'label'             => __( '<hr style="width: 100%; border: 1px #bcb1b1 solid;"/>', 'pet-business' ),
		'section'           => 'pet_business_team_section',
		'active_callback'	=> 'pet_business_is_team_section_enable',
		'type'				=> 'custom-html',
	) ) );*/
for ( $i = 1; $i <= 3; $i++ ) :
	// Coupon image
	$wp_customize->add_setting( 'pet_business_theme_options[coupon_image_url_' . $i . ']', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'pet_business_theme_options[coupon_image_url_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Coupon Image Url %d', 'pet-business' ), $i ),
		'section'           => 'pet_business_team_section',
		'type'				=> 'url',
		'active_callback'	=> 'pet_business_is_team_section_enable',
	) );

	// Coupon code
	$wp_customize->add_setting( 'pet_business_theme_options[coupon_code_' . $i . ']', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'pet_business_theme_options[coupon_code_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Coupon Code %d', 'pet-business' ), $i ),
		'section'           => 'pet_business_team_section',
		'type'				=> 'text',
		'active_callback'	=> 'pet_business_is_team_section_enable',
	) );

endfor;
	// send btn title setting and control
	$wp_customize->add_setting( 'pet_business_theme_options[coupon_btn_title]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'			=> 'Yes! Send me my coupon code',
	) );

	$wp_customize->add_control( 'pet_business_theme_options[coupon_btn_title]', array(
		'label'           	=> esc_html__( 'Button Label', 'pet-business' ),
		'section'        	=> 'pet_business_team_section',
		'active_callback' 	=> 'pet_business_is_team_section_enable',
		'type'				=> 'text',		
	) );

	// send btn title setting and control
	$wp_customize->add_setting( 'pet_business_theme_options[coupon_btn_link]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'			=> '',
	) );

	$wp_customize->add_control( 'pet_business_theme_options[coupon_btn_link]', array(
		'label'           	=> esc_html__( 'Button Link', 'pet-business' ),
		'section'        	=> 'pet_business_team_section',
		'active_callback' 	=> 'pet_business_is_team_section_enable',
		'type'				=> 'text',
	) );
