<?php
// Remove all default WP template redirects/lookups
remove_action('template_redirect', 'redirect_canonical');

// Redirect all requests to index.php so the Vue app is loaded and 404s aren't thrown
function remove_redirects() {
	add_rewrite_rule('^/(.+)/?', 'index.php', 'top');
}
add_action('init', 'remove_redirects');

// Load scripts
function load_vue_scripts() {
	wp_enqueue_style('blankslate/app.css', get_template_directory_uri() . '/dist/styles/app.css', false, null);
	wp_enqueue_script('blankslate/manifest.js', get_template_directory_uri() . '/dist/scripts/manifest.js', null, null, true);
	wp_enqueue_script('blankslate/vendor.js', get_template_directory_uri() . '/dist/scripts/vendor.js', null, null, true);
	wp_enqueue_script('blankslate/app.js', get_template_directory_uri() . '/dist/scripts/app.js', null, null, true);
}
add_action('wp_enqueue_scripts', 'load_vue_scripts', 100);

function acf_rest_api_admin_notice__warning() {
	if (!is_plugin_active('acf-to-rest-api/class-acf-to-rest-api.php')) { ?>

	<div class="notice error is-dismissible">
		<p><?php esc_html_e( 'The theme', 'act-to-rest-api' ); ?> <?php esc_html_e( 'depends on ACF to REST API to work!', 'acf-to-rest-api' ); ?></p>
		<p><a href="<?php echo esc_url(wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=acf-to-rest-api' ))); ?>" class="button button-primary"<?php if ( $target ) : ?> target="_blank"<?php endif; ?>><?php esc_html_e( $action . 'Install ACF to REST API', 'acf-to-rest-api' ); ?></a></p>
	</div>
	<?php }
}
add_action( 'admin_notices', 'acf_rest_api_admin_notice__warning' );

function menu_rest_api_admin_notice__warning() {
	if (!is_plugin_active('wp-api-menus/wp-api-menus.php')) { ?>
	<div class="notice error is-dismissible">
		<p><?php esc_html_e( 'The theme', 'act-to-rest-api' ); ?> <?php esc_html_e( 'depends on WP API Menus to work!', 'wp-api-menus' ); ?></p>
		<p><a href="<?php echo esc_url(wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=wp-api-menus' ))); ?>" class="button button-primary"<?php if ( $target ) : ?> target="_blank"<?php endif; ?>><?php esc_html_e( $action . ' Install WP API Menus', 'wp-api-menus' ); ?></a></p>
	</div>
	<?php }
}
add_action( 'admin_notices', 'menu_rest_api_admin_notice__warning' );

add_theme_support( 'menus' );
register_nav_menus( array(
	'header_menu' => __( 'Header Menu' ),
	'footer_menu' => __( 'Footer Menu' )
));

// Custom Logo
function theme_prefix_setup() {

	add_theme_support( 'custom-logo', array(

		'flex-width' => true,
	) );

}
add_action( 'after_setup_theme', 'theme_prefix_setup' );

function theme_prefix_the_custom_logo() {

	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}

}

add_action( 'rest_api_init', function () {
	register_rest_route( 'theme/v1', '/logo/url', array(
		'methods' => 'GET',
		'callback' => 'get_logo_url',
	) );
	register_rest_route( 'theme/v1', '/logo/width', array(
		'methods' => 'GET',
		'callback' => 'get_logo_width',
	) );
	register_rest_route( 'theme/v1', '/logo/height', array(
		'methods' => 'GET',
		'callback' => 'get_logo_height',
	) );
	register_rest_route( 'static/v1', '/frontpage', array(
		'methods' => 'GET',
		'callback' => 'get_frontpage',
	) );
	register_rest_route( 'static/v1', '/posts_page', array(
		'methods' => 'GET',
		'callback' => 'get_posts_page',
	) );
} );

function get_logo( $data ) {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );

	if ( empty( $image ) ) {
		return new WP_Error( 'no_logo', 'No logo uploaded. Please upload a theme logo: Wp Admin > Appearance > Customize', array( 'status' => 404 ) );
	}

	return $image;
}

function get_logo_url( $data ) {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );

	if ( empty( $image ) ) {
		return new WP_Error( 'no_logo', 'No logo uploaded. Please upload a theme logo: Wp Admin > Appearance > Customize', array( 'status' => 404 ) );
	}
	$url = $image[0];
	return $url;
}

function get_logo_width( $data ) {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );

	if ( empty( $image ) ) {
		return new WP_Error( 'no_logo', 'No logo uploaded. Please upload a theme logo: Wp Admin > Appearance > Customize', array( 'status' => 404 ) );
	}
	$width = $image[1];
	return $width;
}

function get_logo_height( $data ) {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );

	if ( empty( $image ) ) {
		return new WP_Error( 'no_logo', 'No logo uploaded. Please upload a theme logo: Wp Admin > Appearance > Customize', array( 'status' => 404 ) );
	}
	$height = $image[2];
	return $height;
}

function get_frontpage($data) {
	$page = get_option( 'page_on_front' );
	if ( empty( $page ) ) {
		return new WP_Error( 'no_frontpage', 'No frontpage. Please select a static Homepage via: Wp Admin > Settings > Reading', array( 'status' => 404 ) );
	}
	return $page;
}

function get_posts_page($data) {
	$page = get_option( 'page_for_posts' );
	if ( empty( $page ) ) {
		return new WP_Error( 'no_posts_page', 'No posts page. Please select a static Posts page via: Wp Admin > Settings > Reading', array( 'status' => 404 ) );
	}
	return $page;
}
