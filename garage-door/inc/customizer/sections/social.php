<?php
/**
 * Social Section options
 *
 * @package Theme Palace
 * @subpackage Pet
 * @since Garage Door 1.0.0
 */

// Add Social section
$wp_customize->add_section( 'pet_business_contact_section', array(
	'title'             => esc_html__( 'Social','pet-business' ),
	'description'       => esc_html__( 'Social Section options.', 'pet-business' ),
	'panel'             => 'pet_business_front_page_panel',
) );

// Social content enable control and setting
$wp_customize->add_setting( 'pet_business_theme_options[contact_section_enable]', array(
	'default'			=> 	$options['contact_section_enable'],
	'sanitize_callback' => 'pet_business_sanitize_switch_control',
) );

$wp_customize->add_control( new Pet_Business_Switch_Control( $wp_customize, 'pet_business_theme_options[contact_section_enable]', array(
	'label'             => esc_html__( 'Social Section Enable', 'pet-business' ),
	'section'           => 'pet_business_contact_section',
	'on_off_label' 		=> pet_business_switch_options(),
) ) );


// Facebook shortcode setting and control.
$wp_customize->add_setting( 'pet_business_theme_options[facebook_shortcode]', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'pet_business_theme_options[facebook_shortcode]',
		array(
		'label'       		=> esc_html__( 'Facebook shortcode', 'pet-business' ),		
		'section'     		=> 'pet_business_contact_section',
		'active_callback'	=> 'pet_business_is_contact_section_enable',
		'type'				=> 'textarea',
) );
// Instagram shortcode setting and control.
$wp_customize->add_setting( 'pet_business_theme_options[instagram_shortcode]', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'pet_business_theme_options[instagram_shortcode]',
		array(
		'label'       		=> esc_html__( 'Instagram shortcode', 'pet-business' ),		
		'section'     		=> 'pet_business_contact_section',
		'active_callback'	=> 'pet_business_is_contact_section_enable',
		'type'				=> 'textarea',
) );
