<?php
/**
 * Featured Section options
 *
 * @package Theme Palace
 * @subpackage Pet
 * @since Garage Door 1.0.0
 */

// Add Featured section
$wp_customize->add_section( 'pet_business_blog_section', array(
	'title'             => esc_html__( 'Featured','pet-business' ),
	'description'       => esc_html__( 'Featured Section options.', 'pet-business' ),
	'panel'             => 'pet_business_front_page_panel',
) );

// Featured content enable control and setting
$wp_customize->add_setting( 'pet_business_theme_options[blog_section_enable]', array(
	'default'			=> 	$options['blog_section_enable'],
	'sanitize_callback' => 'pet_business_sanitize_switch_control',
) );

$wp_customize->add_control( new Pet_Business_Switch_Control( $wp_customize, 'pet_business_theme_options[blog_section_enable]', array(
	'label'             => esc_html__( 'Featured Section Enable', 'pet-business' ),
	'section'           => 'pet_business_blog_section',
	'on_off_label' 		=> pet_business_switch_options(),
) ) );

for ( $i = 1; $i <= 2; $i++ ) :
	// featured pages drop down chooser control and setting
	$wp_customize->add_setting( 'pet_business_theme_options[featured_page_' . $i . ']', array(
		'sanitize_callback' => 'pet_business_sanitize_page',
	) );

	$wp_customize->add_control( new Pet_Business_Dropdown_Chooser( $wp_customize, 'pet_business_theme_options[featured_page_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Featured Page %d', 'pet-business' ), $i ),
		'section'           => 'pet_business_blog_section',
		'choices'			=> pet_business_page_choices(),
		'active_callback'	=> 'pet_business_is_blog_section_enable',
	) ) );
endfor;