<?php
/**
 * S2 Functions.
 *
 * This file adds functions to the SensorsONE S2 Theme.
 *
 * @package S2
 * @author  SensorsONE
 * @license GPL-2.0+
 * @link    https://www.sensorsone.com/
 */

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 's2', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 's2' ) );

//* Add Image upload and Color select to WordPress Theme Customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

//* Include Customizer CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'S2' );
define( 'CHILD_THEME_URL', 'https://www.sensorsone.com/' );
define( 'CHILD_THEME_VERSION', '1.0' );

//* Enqueue Scripts and Styles
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style( 'dashicons' );

	wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	$output = array(
		'mainMenu' => __( 'Menu', 's2' ),
		'subMenu'  => __( 'Menu', 's2' ),
	);
	wp_localize_script( 'genesis-sample-responsive-menu', 'genesisSampleL10n', $output );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Rename primary and secondary navigation menus
add_theme_support( 'genesis-menus' , array( 'primary' => __( 'After Header Menu', 's2' ), 'secondary' => __( 'Footer Menu', 's2' ) ) );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

//* Modify size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {

	return 90;

}

//* Modify size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}


/******** SENSORSONE FUNCTIONS FOR S2 CHILD THEME ********/

// Add Request Form to bottom of post
function request_form() {
	if (is_single() && has_tag('discontinued-products')) { ?>
		<br/><h2 class="page-section-break" id="help-form">Request Product Help</h2>
		<?php gravity_form(105, false, false, false, '', true); ?>
		<br/><br/>
	<?php }
	elseif (is_single() && (in_category('product-guides') || has_tag('product-types'))) { ?>
		<br/><h2 class="page-section-break" id="help-form">Request Product Help</h2>
		<?php gravity_form(101, false, false, false, '', true); ?>
		<br/><br/>
	<?php }
	elseif (is_single() && in_category('application-guides')) { ?>
		<br/><h2 class="page-section-break" id="help-form">Request Application Help</h2>
		<?php gravity_form(102, false, false, false, '', true); ?>
		<br/><br/>
	<?php }
	elseif (is_single() && has_tag('sku-product-specs')) { ?>
		<br/><h2 class="page-section-break" id="quote-form">Request Product Price</h2>
		<?php gravity_form(1, false, false, false, '', true); ?>
		<br/><br/>
	<?php }
	elseif (is_single() && has_tag('product-overviews')) { ?>
		<br/><h2 class="page-section-break" id="quote-form">Request Product Price</h2>
		<?php gravity_form(6, false, false, false, '', true); ?>
		<br/><br/>
	<?php }	
	elseif (is_single() && has_tag('product-configurators')) { ?>
		<br/><h2 class="page-section-break" id="quote-form">Request Product Price</h2>
		<?php echo '<p>Please select the options you require for the <strong>' . get_the_title() . '</strong> in your application and request a quote.</p>';
		if (has_tag('capo')) {
			gravity_form(16, false, false, false, '', true);
		}
		elseif (has_tag('leo-record')) {
			gravity_form(11, false, false, false, '', true);
		}
		elseif (has_tag('imp')) {
			gravity_form(12, false, false, false, '', true);
		}
		elseif (has_tag('dmp331')) {
			gravity_form(14, false, false, false, '', true);
		}
		elseif (has_tag('dmp333')) {
			gravity_form(15, false, false, false, '', true);
		}
		elseif (has_tag('dmp343')) {
			gravity_form(17, false, false, false, '', true);
		}
		elseif (has_tag('dps200')) {
			gravity_form(18, false, false, false, '', true);
		}
		elseif (has_tag('dmp334')) {
			gravity_form(19, false, false, false, '', true);
		}
		elseif (has_tag('dmp304')) {
			gravity_form(20, false, false, false, '', true);
		}
		elseif (has_tag('pgs40')) {
			gravity_form(21, false, false, false, '', true);
		}
		elseif (has_tag('pgs700')) {
			gravity_form(22, false, false, false, '', true);
		}
		elseif (has_tag('pgs1000')) {
			gravity_form(23, false, false, false, '', true);
		}
		elseif (has_tag('dmp331p')) {
			gravity_form(24, false, false, false, '', true);
		}
		elseif (has_tag('dmk331p')) {
			gravity_form(25, false, false, false, '', true);
		}
		elseif (has_tag('implr')) {
			gravity_form(26, false, false, false, '', true);
		}
		elseif (has_tag('imcl')) {
			gravity_form(27, false, false, false, '', true);
		}
		elseif (has_tag('series-33x')) {
			gravity_form(28, false, false, false, '', true);
		}
		elseif (has_tag('series-41x')) {
			gravity_form(29, false, false, false, '', true);
		}
		elseif (has_tag('imsl')) {
			gravity_form(30, false, false, false, '', true);
		}
		elseif (has_tag('swl')) {
			gravity_form(31, false, false, false, '', true);
		}
		elseif (has_tag('iwsl')) {
			gravity_form(32, false, false, false, '', true);
		}
		elseif (has_tag('imctl')) {
			gravity_form(33, false, false, false, '', true);
		}
		elseif (has_tag('imstl')) {
			gravity_form(34, false, false, false, '', true);
		}
		elseif (has_tag('s12c')) {
			gravity_form(35, false, false, false, '', true);
		}
		elseif (has_tag('s12s')) {
			gravity_form(36, false, false, false, '', true);
		}
		elseif (has_tag('dm01')) {
			gravity_form(37, false, false, false, '', true);
		}
		elseif (has_tag('lex1')) {
			gravity_form(38, false, false, false, '', true);
		}
		elseif (has_tag('leo1')) {
			gravity_form(39, false, false, false, '', true);
		}
		elseif (has_tag('leo2')) {
			gravity_form(40, false, false, false, '', true);
		}
		elseif (has_tag(array('eco1', 'eco2'))) {
			gravity_form(41, false, false, false, '', true);
		}
		elseif (has_tag('pd33x')) {
			gravity_form(42, false, false, false, '', true);
		}
		elseif (has_tag('pd39x')) {
			gravity_form(43, false, false, false, '', true);
		}
		elseif (has_tag('dg2000p')) {
			gravity_form(44, false, false, false, '', true);
		}
		elseif (has_tag('lmk458')) {
			gravity_form(45, false, false, false, '', true);
		}
		elseif (has_tag('lmk382')) {
			gravity_form(46, false, false, false, '', true);
		}
		elseif (has_tag('lmk307')) {
			gravity_form(47, false, false, false, '', true);
		}
		elseif (has_tag('lmp307')) {
			gravity_form(48, false, false, false, '', true);
		}
		elseif (has_tag('lmk306')) {
			gravity_form(49, false, false, false, '', true);
		}
		elseif (has_tag('lmp305')) {
			gravity_form(50, false, false, false, '', true);
		}
		elseif (has_tag('lmk807')) {
			gravity_form(51, false, false, false, '', true);
		}
		elseif (has_tag('lmk809')) {
			gravity_form(52, false, false, false, '', true);
		}
		elseif (has_tag('asm')) {
			gravity_form(53, false, false, false, '', true);
		}
		elseif (has_tag('xmd')) {
			gravity_form(54, false, false, false, '', true);
		}
		elseif (has_tag('xmpi')) {
			gravity_form(55, false, false, false, '', true);
		}
		elseif (has_tag('dmd331')) {
			gravity_form(56, false, false, false, '', true);
		}
		elseif (has_tag('dmd341')) {
			gravity_form(57, false, false, false, '', true);
		}
		elseif (has_tag('asl')) {
			gravity_form(58, false, false, false, '', true);
		}
		elseif (has_tag('as')) {
			gravity_form(59, false, false, false, '', true);
		}
		elseif (has_tag('asmt')) {
			gravity_form(60, false, false, false, '', true);
		}
		elseif (has_tag('dmp457')) {
			gravity_form(61, false, false, false, '', true);
		}
		elseif (has_tag('dmk457')) {
			gravity_form(62, false, false, false, '', true);
		}
		elseif (has_tag('baroli-02')) {
			gravity_form(63, false, false, false, '', true);
		}
		elseif (has_tag('baroli-05')) {
			gravity_form(64, false, false, false, '', true);
		}
		elseif (has_tag('baroli-02p')) {
			gravity_form(65, false, false, false, '', true);
		}
		elseif (has_tag('baroli-05p')) {
			gravity_form(66, false, false, false, '', true);
		}
		elseif (has_tag('dm10')) {
			gravity_form(67, false, false, false, '', true);
		}
		elseif (has_tag('leo3')) {
			gravity_form(68, false, false, false, '', true);
		}
		elseif (has_tag('series-35x')) {
			gravity_form(69, false, false, false, '', true);
		}
		elseif (has_tag('series-23ed')) {
			gravity_form(70, false, false, false, '', true);
		}
		elseif (has_tag('series-25ed')) {
			gravity_form(71, false, false, false, '', true);
		}
		elseif (has_tag('p200is')) {
			gravity_form(72, false, false, false, '', true);
		}
		elseif (has_tag('dmp331i')) {
			gravity_form(73, false, false, false, '', true);
		}
		elseif (has_tag('dmp333i')) {
			gravity_form(74, false, false, false, '', true);
		}
		elseif (has_tag('lmk331')) {
			gravity_form(75, false, false, false, '', true);
		}
		elseif (has_tag('lmk351')) {
			gravity_form(76, false, false, false, '', true);
		}
		elseif (has_tag('dps')) {
			gravity_form(77, false, false, false, '', true);
		}
		elseif (has_tag('ds200')) {
			gravity_form(78, false, false, false, '', true);
		}
		elseif (has_tag('ds210')) {
			gravity_form(79, false, false, false, '', true);
		}
		elseif (has_tag('ds200p')) {
			gravity_form(80, false, false, false, '', true);
		}
		elseif (has_tag('ds201p')) {
			gravity_form(81, false, false, false, '', true);
		}
		elseif (has_tag('imtg')) {
			gravity_form(82, false, false, false, '', true);
		}
		elseif (has_tag('pa430')) {
			gravity_form(83, false, false, false, '', true);
		}
		elseif (has_tag('kl1')) {
			gravity_form(84, false, false, false, '', true);
		}
		elseif (has_tag('srp94')) {
			gravity_form(85, false, false, false, '', true);
		}
		elseif (has_tag('cmc99')) {
			gravity_form(86, false, false, false, '', true);
		}
		elseif (has_tag('mtm3000')) {
			gravity_form(87, false, false, false, '', true);
		}
		elseif (has_tag('adt681')) {
			gravity_form(88, false, false, false, '', true);
		}
		elseif (has_tag('adt672')) {
			gravity_form(89, false, false, false, '', true);
		}
		elseif (has_tag('gefran-industrial') && has_tag(array('pressure-transducers-mv', 'pressure-transducers-v', 'pressure-transmitters', 'pressure-sensors', 'digital-pressure-sensors'))) {
			gravity_form(96, false, false, false, '', true);
		}
		elseif (has_tag('gefran-melt') && has_tag(array('pressure-transducers-mv', 'pressure-transducers-v', 'pressure-transmitters', 'pressure-sensors', 'digital-pressure-sensors'))) {
			gravity_form(120, false, false, false, '', true);
		} ?>
		<br/><br/>
	<?php }
}

add_action('genesis_entry_content', 'request_form');


// Customize the post info function using Genesis shortcode
function sp_post_info_filter($post_info) {
	if ( !is_page() ) {
		$post_info = '[post_edit]';
		return $post_info;
	}
}

add_filter( 'genesis_post_info', 'sp_post_info_filter' );


// Remove the entry meta in the entry footer (requires HTML5 theme support)
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );


// Change the footer text using Genesis shortcode
function sp_footer_creds_filter( $creds ) {
	$creds = ' [footer_copyright after=" SensorsONE Ltd, all rights reserved"]';
	return $creds;
}

add_filter('genesis_footer_creds_text', 'sp_footer_creds_filter');


//* Add jump to form link below post title
function below_post_title_jump_link() {
	if (is_single() && has_tag('discontinued-products')) { ?>		
		<p><strong>***THIS PRODUCT IS NO LONGER AVAILABLE***</strong></p>
		<div class="content-jump-link">
		<?php product_specifier_jumplink(); ?>
		</div>
	<?php }
	elseif (is_single() && (in_category('product-guides') || has_tag('product-types'))) { ?>
		<div class="content-jump-link">
		<?php product_specifier_jumplink(); ?>
		</div>
	<?php }
	elseif (is_single() && has_tag('sku-product-specs')) { ?>
		<div class="content-jump-link">
		<a href="#quote-form" class="blue-bg" onclick="ga('send', 'event', 'link', 'click', 'sku quote jumplink below title');">Request Price</a>
		</div>
	<?php }
	elseif (is_single() && has_tag('product-overviews')) { ?>
		<div class="content-jump-link">
		<a href="#quote-form" class="blue-bg" onclick="ga('send', 'event', 'link', 'click', 'overview quote jumplink below title');">Request Price</a>
		<a href="#related-documents" class="red-bg" onclick="ga('send', 'event', 'link', 'click', 'overview pdf jumplink below title');">PDF</a>
		</div>
	<?php }
	elseif (is_single() && has_tag('product-configurators')) { ?>
		<div class="content-jump-link">
		<a href="#quote-form" class="blue-bg" onclick="ga('send', 'event', 'link', 'click', 'configurator quote jumplink below title');">Select Options + Request Price</a>
		<a href="#related-documents" class="red-bg" onclick="ga('send', 'event', 'link', 'click', 'configurator pdf jumplink below title');">PDF</a>
		</div>
	<?php }
}

add_action('genesis_before_entry_content', 'below_post_title_jump_link');


function product_specifier_jumplink() {
	if (is_single() && has_tag('pressure-sensors')) { ?>
		<a href="<?php echo esc_url(home_url()); ?>/product-specifiers/pressure-sensor-specifier/" class="red-bg" onclick="ga('send', 'event', 'link', 'click', 'pressure sensor specifier jumplink below title');">Specify Your Pressure Sensor Requirements</a>
	<?php }
	elseif (is_single() && has_tag('pressure-transmitters')) { ?>
		<a href="<?php echo esc_url(home_url()); ?>/product-specifiers/pressure-sensor-specifier/" class="red-bg" onclick="ga('send', 'event', 'link', 'click', 'pressure sensor specifier jumplink below title');">Specify Your Pressure Transmitter Requirements</a>
	<?php }
	elseif (is_single() && has_tag('pressure-transducers-v')) { ?>
		<a href="<?php echo esc_url(home_url()); ?>/product-specifiers/pressure-sensor-specifier/" class="red-bg" onclick="ga('send', 'event', 'link', 'click', 'pressure sensor specifier jumplink below title');">Specify Your Voltage Pressure Transducer Requirements</a>
	<?php }
	elseif (is_single() && has_tag('pressure-transducers-mv')) { ?>
		<a href="<?php echo esc_url(home_url()); ?>/product-specifiers/pressure-sensor-specifier/" class="red-bg" onclick="ga('send', 'event', 'link', 'click', 'pressure sensor specifier jumplink below title');">Specify Your Millivolt Pressure Transducer Requirements</a>
	<?php }
	elseif (is_single() && has_tag('digital-pressure-sensors')) { ?>
		<a href="<?php echo esc_url(home_url()); ?>/product-specifiers/pressure-sensor-specifier/" class="red-bg" onclick="ga('send', 'event', 'link', 'click', 'pressure sensor specifier jumplink below title');">Specify Your Digital Pressure Sensor Requirements</a>
	<?php }
	elseif (is_single() && has_tag('pressure-gauges')) { ?>
		<a href="<?php echo esc_url(home_url()); ?>/product-specifiers/digital-pressure-gauge-specifier/" class="red-bg" onclick="ga('send', 'event', 'link', 'click', 'pressure gauge specifier jumplink below title');">Specify Your Digital Pressure Gauge Requirements</a>
	<?php }
	elseif (is_single() && has_tag('liquid-level-sensors')) { ?>
		<a href="<?php echo esc_url(home_url()); ?>/product-specifiers/liquid-level-sensor-specifier/" class="red-bg" onclick="ga('send', 'event', 'link', 'click', 'level sensor specifier jumplink below title');">Specify Your Liquid Level Sensor Requirements</a>
	<?php }
}


function product_help_request_jumplink() {
	if (is_single() && has_tag(array('pressure-sensors', 'pressure-transmitters', 'pressure-transducers-v', 'pressure-transducers-mv', 'digital-pressure-sensors', 'pressure-gauges', 'liquid-level-sensors'))) { ?>
		<a href="#help-form" class="red-bg" onclick="ga('send', 'event', 'link', 'click', 'product help request jumplink below title');">Need help?</a>
	<?php }
	elseif (is_single() && has_tag('discontinued-products')) { ?>
		<a href="#help-form" class="red-bg" onclick="ga('send', 'event', 'link', 'click', 'alternative product help request jumplink below title');">Need help finding alternative product?</a>
	<?php }
	else { ?>
		<a href="#help-form" class="red-bg" onclick="ga('send', 'event', 'link', 'click', 'product help request jumplink below title');">Need help with this product type?</a>
	<?php }
}


// Add Related pages section between entry content & footer
function related_pages() {
	if (is_single()) { ?>
		<br/><h2 class="page-section-break" id="related-pages">Related Pages</h2>
		<?php echo do_shortcode( '[jetpack-related-posts]' );
	}
}

add_action('genesis_entry_content', 'related_pages');


// Remove the Related Posts from the bottom of posts
function jetpackme_remove_rp() {
    $jprp = Jetpack_RelatedPosts::init();
    $callback = array( $jprp, 'filter_add_target_to_dom' );
    remove_filter( 'the_content', $callback, 40 );
}

add_filter( 'wp', 'jetpackme_remove_rp', 20 );


// Remove category General from Related Posts
function jetpackme_filter_exclude_category( $filters ) {
    $filters[] = array( 'not' =>
      array( 'term' => array( 'category.slug' => 'general' ) )
    );
    return $filters;
}

add_filter( 'jetpack_relatedposts_filter_filters', 'jetpackme_filter_exclude_category' );


// Remove nofollow rel attribute from related post links
function modify_rel_nofollow() {
    return '';
}

add_filter( 'jetpack_relatedposts_filter_post_link_rel', 'modify_rel_nofollow');

// Remove genesis_canonical tags to allow control of wp rel_canonical function instead via s1 tools plugin
remove_action( 'wp_head', 'genesis_canonical', 5 );
