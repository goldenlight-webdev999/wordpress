<?php
/**
 * About Section options
 *
 * @package Theme Palace
 * @subpackage Pet
 * @since Garage Door 1.0.0
 */

// Add About section
$wp_customize->add_section( 'pet_business_about_section', array(
	'title'             => esc_html__( 'Welcome','pet-business' ),
	'description'       => esc_html__( 'Welcome Section options.', 'pet-business' ),
	'panel'             => 'pet_business_front_page_panel',
) );

// About content enable control and setting
$wp_customize->add_setting( 'pet_business_theme_options[welcome_section_enable]', array(
	'default'			=> 	$options['welcome_section_enable'],
	'sanitize_callback' => 'pet_business_sanitize_switch_control',
) );

$wp_customize->add_control( new Pet_Business_Switch_Control( $wp_customize, 'pet_business_theme_options[welcome_section_enable]', array(
	'label'             => esc_html__( 'Welcome Section Enable', 'pet-business' ),
	'section'           => 'pet_business_about_section',
	'on_off_label' 		=> pet_business_switch_options(),
) ) );

// about pages drop down chooser control and setting
$wp_customize->add_setting( 'pet_business_theme_options[about_content_page]', array(
	'sanitize_callback' => 'pet_business_sanitize_page',
) );

$wp_customize->add_control( new Pet_Business_Dropdown_Chooser( $wp_customize, 'pet_business_theme_options[about_content_page]', array(
	'label'             => esc_html__( 'Select Page', 'pet-business' ),
	'section'           => 'pet_business_about_section',
	'choices'			=> pet_business_page_choices(),
	'active_callback'	=> 'pet_business_is_welcome_section_enable',
) ) );


// about read more title setting and control
$wp_customize->add_setting( 'pet_business_theme_options[read_more_btn_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default' 			=> $options['read_more_btn_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'pet_business_theme_options[read_more_btn_title]', array(
	'label'           	=> esc_html__( 'Read More Button Label', 'pet-business' ),
	'section'        	=> 'pet_business_about_section',
	'active_callback' 	=> 'pet_business_is_welcome_section_enable',
	'type'				=> 'text',
) );

// contact us title setting and control
$wp_customize->add_setting( 'pet_business_theme_options[contact_us_btn_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default' 			=> $options['contact_us_btn_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'pet_business_theme_options[contact_us_btn_title]', array(
	'label'           	=> esc_html__( 'Contact Us Button Label', 'pet-business' ),
	'section'        	=> 'pet_business_about_section',
	'active_callback' 	=> 'pet_business_is_welcome_section_enable',
	'type'				=> 'text',
) );

$wp_customize->add_setting( 'pet_business_theme_options[contact_us_btn_link]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default' 			=> $options['contact_us_btn_link'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'pet_business_theme_options[contact_us_btn_link]', array(
	'label'           	=> esc_html__( 'Contact Us Link', 'pet-business' ),
	'section'        	=> 'pet_business_about_section',
	'active_callback' 	=> 'pet_business_is_welcome_section_enable',
	'type'				=> 'text',
) );


// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'pet_business_theme_options[read_more_btn_title]', array(
		'selector'            => '#read-more a.btn',
		'settings'            => 'pet_business_theme_options[read_more_btn_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'pet_business_read_more_btn_title_partial',
    ) );
    $wp_customize->selective_refresh->add_partial( 'pet_business_theme_options[contact_us_btn_title]', array(
		'selector'            => '#contact-us a.btn',
		'settings'            => 'pet_business_theme_options[contact_us_btn_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'pet_business_contact_us_btn_title_partial',
    ) );
}

