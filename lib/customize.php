<?php
/**
 * Genesis Sample.
 *
 * This file adds the Customizer additions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

/**
 * Get default link color for Customizer.
 *
 * Abstracted here since at least two functions use it.
 *
 * @since 2.2.3
 *
 * @return string Hex color code for link color.
 */
function genesis_sample_customizer_get_default_link_color() {
	return '#0066cc'; /* S1 */
}

/**
 * Get default accent color for Customizer.
 *
 * Abstracted here since at least two functions use it.
 *
 * @since 2.2.3
 *
 * @return string Hex color code for accent color.
 */
function genesis_sample_customizer_get_default_accent_color() {
	return '#0066cc'; /* S1 */
}

add_action( 'customize_register', 'genesis_sample_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 2.2.3
 * 
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function genesis_sample_customizer_register() {

	global $wp_customize;

	$wp_customize->add_setting(
		'genesis_sample_link_color',
		array(
			'default'           => genesis_sample_customizer_get_default_link_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'genesis_sample_link_color',
			array(
				'description' => __( 'Change the default color for linked titles, menu links, post info links and more.', 's2' ), /* S1 */
			    'label'       => __( 'Link Color', 's2' ), /* S1 */
			    'section'     => 'colors',
			    'settings'    => 'genesis_sample_link_color',
			)
		)
	);

	$wp_customize->add_setting(
		'genesis_sample_accent_color',
		array(
			'default'           => genesis_sample_customizer_get_default_accent_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'genesis_sample_accent_color',
			array(
				'description' => __( 'Change the default color for button hovers.', 's2' ), /* S1 */
			    'label'       => __( 'Accent Color', 's2' ), /* S1 */
			    'section'     => 'colors',
			    'settings'    => 'genesis_sample_accent_color',
			)
		)
	);

}
