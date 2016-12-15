<?php
/**
 * S2 404.
 *
 * This file modifies the 404.php file that comes with Genesis framework to remove sitemap.
 *
 * @package S2
 * @author  SensorsONE
 * @license GPL-2.0+
 * @link    http://www.sensorsone.com/
 */

//* Remove default loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', 'genesis_404' );
/**
 * This function outputs a 404 "Not Found" error message
 *
 * @since 1.6
 */
function genesis_404() {

	echo genesis_html5() ? '<article class="entry">' : '<div class="post hentry">';

		printf( '<h1 class="entry-title">%s</h1>', apply_filters( 'genesis_404_entry_title', __( 'Not found, error 404', 'genesis' ) ) );
		echo '<div class="entry-content">';

			if ( genesis_html5() ) :

				echo apply_filters( 'genesis_404_entry_content', '<p>' . sprintf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it by using the search form below.', 'genesis' ), trailingslashit( home_url() ) ) . '</p>' );

				get_search_form();

			else :
	?>

			<p><?php printf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it with the information below.', 'genesis' ), trailingslashit( home_url() ) ); ?></p>



	<?php
			endif;

			echo '</div>';

		echo genesis_html5() ? '</article>' : '</div>';

}

genesis();
