<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  Garage Door 1.0.0
 * @access public
 */
final class Pet_Business_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since Garage Door 1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since Garage Door 1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since Garage Door 1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since Garage Door 1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . 'inc/customizer/upgrade-to-pro/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Pet_Business_Customize_Section_Pro' );

		// Register sections.
		/*$manager->add_section(
			new Pet_Business_Customize_Section_Pro(
				$manager,
				'pet-business',
				array(
					'title'    => esc_html__( 'Garage Door Pro','pet-business' ),
					'pro_text' => esc_html__( 'Go Pro','pet-business' ),
					'pro_url'  => esc_url( 'https://themepalace.com/downloads/pet-business-business-pro/' )
				)
			)
		);*/
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since Garage Door 1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'pet-business-go-pro-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/upgrade-to-pro/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'pet-business-go-pro-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/upgrade-to-pro/customize-controls.css' );
	}
}

// Doing this customizer thang!
Pet_Business_Customize::get_instance();