<?php
/**
 * Genesis Sample.
 *
 * This file adds the default theme settings to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

add_filter( 'genesis_theme_settings_defaults', 'genesis_sample_theme_defaults' );
/**
* Updates theme settings on reset.
*
* @since 2.2.3
*/
function genesis_sample_theme_defaults( $defaults ) {

	$defaults['blog_cat_num']              = 100; /* S1 */
	$defaults['content_archive']           = 'excerpts'; /* S1 */
	$defaults['content_archive_limit']     = 0;
	$defaults['content_archive_thumbnail'] = 1; /* S1 */
	$defaults['image_size']                = 'thumbnail'; /* S1 */
	$defaults['image_alignment']           = 'alignright'; /* S1 */
	$defaults['posts_nav']                 = 'numeric';
	$defaults['site_layout']               = 'content-sidebar';

	return $defaults;

}

add_action( 'after_switch_theme', 'genesis_sample_theme_setting_defaults' );
/**
* Updates theme settings on activation.
*
* @since 2.2.3
*/
function genesis_sample_theme_setting_defaults() {

	if ( function_exists( 'genesis_update_settings' ) ) {

		genesis_update_settings( array(
			'blog_cat_num'              => 100, /* S1 */
			'content_archive'           => 'excerpts', /* S1 */
			'content_archive_limit'     => 0,
			'content_archive_thumbnail' => 1, /* S1 */
			'image_size'                => 'thumbnail', /* S1 */
			'image_alignment'           => 'alignright', /* S1 */
			'posts_nav'                 => 'numeric',
			'site_layout'               => 'content-sidebar',
		) );
		
	} 

	update_option( 'posts_per_page', 100 ); /* S1 */

}
