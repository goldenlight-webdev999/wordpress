<?php
/**
 * Contact Us Section options
 *
 * @package Theme Palace
 * @subpackage Pet
 * @since Garage Door 1.0.0
 */

// Add Contact Us section
$wp_customize->add_section( 'pet_business_cta_section', array(
	'title'             => esc_html__( 'Contact Us','pet-business' ),
	'description'       => esc_html__( 'Contact Us Section options.', 'pet-business' ),
	'panel'             => 'pet_business_front_page_panel',
) );

	// Contact Us content enable control and setting
	$wp_customize->add_setting( 'pet_business_theme_options[cta_section_enable]', array(
		'default'			=> 	$options['cta_section_enable' ],
		'sanitize_callback' => 'pet_business_sanitize_switch_control',
	) );

	$wp_customize->add_control( new Pet_Business_Switch_Control( $wp_customize, 'pet_business_theme_options[cta_section_enable]', array(
		'label'             => esc_html__( 'Contact Us Section Enable', 'pet-business' ),
		'section'           => 'pet_business_cta_section',
		'on_off_label' 		=> pet_business_switch_options(),
	) ) );

	
	// contact image control and setting
	$wp_customize->add_setting( 'pet_business_theme_options[cta_image]', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'pet_business_theme_options[cta_image]', array(
		'label'             => esc_html__( 'Image', 'pet-business' ),
		'section'           => 'pet_business_cta_section',
		'active_callback'   => 'pet_business_is_cta_section_enable',
	) ) );

	// cta phone title setting and control
	$wp_customize->add_setting( 'pet_business_theme_options[cta_phone_title]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'			=> 'Call now:',
	) );

	$wp_customize->add_control( 'pet_business_theme_options[cta_phone_title]', array(
		'label'           	=> esc_html__( 'Call Title', 'pet-business' ),
		'section'        	=> 'pet_business_cta_section',
		'active_callback' 	=> 'pet_business_is_cta_section_enable',
		'type'				=> 'text',
	) );
	

	// cta phone number setting and control
	$wp_customize->add_setting( 'pet_business_theme_options[cta_phone_number]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'			=> '',
	) );

	$wp_customize->add_control( 'pet_business_theme_options[cta_phone_number]', array(
		'label'           	=> esc_html__( 'Phone Number', 'pet-business' ),
		'section'        	=> 'pet_business_cta_section',
		'active_callback' 	=> 'pet_business_is_cta_section_enable',
		'type'				=> 'text',
	) );

	// cta btn title setting and control
	$wp_customize->add_setting( 'pet_business_theme_options[cta_btn_title]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'			=> $options['cta_btn_title'],
	) );

	$wp_customize->add_control( 'pet_business_theme_options[cta_btn_title]', array(
		'label'           	=> esc_html__( 'Button Label', 'pet-business' ),
		'section'        	=> 'pet_business_cta_section',
		'active_callback' 	=> 'pet_business_is_cta_section_enable',
		'type'				=> 'text',
	) );

	// cta btn title setting and control
	$wp_customize->add_setting( 'pet_business_theme_options[cta_btn_link]', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'			=> '',
	) );

	$wp_customize->add_control( 'pet_business_theme_options[cta_btn_link]', array(
		'label'           	=> esc_html__( 'Button Link', 'pet-business' ),
		'section'        	=> 'pet_business_cta_section',
		'active_callback' 	=> 'pet_business_is_cta_section_enable',
		'type'				=> 'text',
	) );