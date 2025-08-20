<?php
/**
 * CT Custom functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CT_Custom
 */

if ( ! function_exists( 'ct_custom_setup' ) ) :
	function ct_custom_setup() {
		load_theme_textdomain( 'ct-custom', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		// Menus
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'ct-custom' ),
			'main_menu' => esc_html__( 'Main Menu', 'ct-custom' ), // Added for Homepage template
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'custom-background', apply_filters( 'ct_custom_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'ct_custom_setup' );

function ct_custom_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ct_custom_content_width', 640 );
}
add_action( 'after_setup_theme', 'ct_custom_content_width', 0);

function ct_custom_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ct-custom' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ct-custom' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ct_custom_widgets_init' );

// Enqueue main theme styles/scripts
function ct_custom_scripts() {
	wp_enqueue_style( 'ct-custom-style', get_stylesheet_uri() );
	wp_enqueue_style( 'homepage-style', get_stylesheet_directory_uri() . '/style-homepage.css' ); // Added homepage styles

	wp_enqueue_script( 'ct-custom-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'ct-custom-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ct_custom_scripts' );


wp_enqueue_script('menu-toggle-js', get_stylesheet_directory_uri() . '/menu-toggle.js', array(), null, true);


/* -----------------------------
   Theme Settings (Logo, Phone, Address, Fax, Social Links)
------------------------------*/
function theme_settings_init() {
	add_settings_section('theme_settings_section', 'Theme Settings', null, 'theme-settings');

	add_settings_field('theme_logo', 'Logo', 'theme_logo_callback', 'theme-settings', 'theme_settings_section');
	add_settings_field('theme_phone', 'Phone Number', 'theme_phone_callback', 'theme-settings', 'theme_settings_section');
	add_settings_field('theme_address', 'Address', 'theme_address_callback', 'theme-settings', 'theme_settings_section');
	add_settings_field('theme_fax', 'Fax Number', 'theme_fax_callback', 'theme-settings', 'theme_settings_section');
	add_settings_field('theme_social_icons', 'Social Media Icons', 'theme_social_icons_callback', 'theme-settings', 'theme_settings_section');

	register_setting('theme_settings_group', 'theme_logo');
	register_setting('theme_settings_group', 'theme_phone');
	register_setting('theme_settings_group', 'theme_address');
	register_setting('theme_settings_group', 'theme_fax');
	register_setting('theme_settings_group', 'theme_social_icons');
}
add_action('admin_init', 'theme_settings_init');

function theme_settings_menu() {
	add_menu_page('Theme Settings', 'Theme Settings', 'manage_options', 'theme-settings', 'theme_settings_page', null, 99);
}
add_action('admin_menu', 'theme_settings_menu');

function theme_logo_callback() {
	$logo = get_option('theme_logo');
	echo '<input type="text" id="theme_logo" name="theme_logo" value="' . esc_url($logo) . '" />
	<input type="button" class="button upload-logo" value="Upload Logo" />';
}
function theme_phone_callback() {
	echo '<input type="text" name="theme_phone" value="' . esc_attr(get_option('theme_phone')) . '" />';
}
function theme_address_callback() {
	echo '<textarea name="theme_address" rows="3">' . esc_textarea(get_option('theme_address')) . '</textarea>';
}
function theme_fax_callback() {
	echo '<input type="text" name="theme_fax" value="' . esc_attr(get_option('theme_fax')) . '" />';
}
// Social Media Icons Field
function theme_social_icons_callback() {
    $socials = get_option('theme_social_icons', array(
        array('icon' => '', 'url' => ''),
        array('icon' => '', 'url' => ''),
        array('icon' => '', 'url' => ''),
    ));

    echo '<div id="social-icons-wrapper">';
    foreach ($socials as $index => $social) {
        echo '<div class="social-icon-item" style="margin-bottom:10px;">';
        echo '<input type="text" name="theme_social_icons['.$index.'][icon]" value="'.esc_url($social['icon']).'" placeholder="Icon URL" class="social-icon-url" />';
        echo '<input type="button" class="button upload-social-icon" value="Upload Icon" />';
        echo '<input type="url" name="theme_social_icons['.$index.'][url]" value="'.esc_url($social['url']).'" placeholder="Profile URL" style="margin-left:5px;width:250px;" />';
        echo '</div>';
    }
    echo '</div>';
    echo '<p>Add icon image (PNG/JPG/SVG) and link URL.</p>';
}

function theme_settings_page() {
	?>
	<div class="wrap">
		<h1>Theme Settings</h1>
		<form method="post" action="options.php">
			<?php
			settings_fields('theme_settings_group');
			do_settings_sections('theme-settings');
			submit_button();
			?>
		</form>
	</div>
	<?php
}

add_action('admin_enqueue_scripts', function($hook) {
	if ('toplevel_page_theme-settings' !== $hook) {
		return;
	}
	wp_enqueue_media();
	wp_enqueue_script('theme-settings-js', get_stylesheet_directory_uri() . '/theme-settings.js', array('jquery'), null, true);
});

/**
 * Load additional theme files
 */
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';

if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
