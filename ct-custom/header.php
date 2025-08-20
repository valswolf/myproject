<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CT_Custom
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ct-custom' ); ?></a>

	<header id="masthead" class="site-header">
		

		<div class="top-bar">
    <div class="container">
        <span class="call-text">CALL US NOW!
		<b class="phone" ><?php echo esc_html(get_option('theme_phone')); ?></b></span>
        <div class="auth-links">
            <a href="<?php echo esc_url(site_url('/login')); ?>">LOGIN</a>
            <a href="<?php echo esc_url(site_url('/signup')); ?>" class="signup">SIGNUP</a>
        </div>
    </div>
</div>

<header class="main-header">
	<div class="container header-inner">
		<div class="logo">
			<?php if ($logo = get_option('theme_logo')): ?>
				<img src="<?php echo esc_url($logo); ?>" alt="Logo">
			<?php else: ?>
				<h1>Your Logo</h1>
			<?php endif; ?>
			
		</div>

		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">☰ Menu</button>

		<nav class="main-menu" id="primary-menu">
			<?php wp_nav_menu(array('theme_location' => 'main_menu')); ?>
		</nav>
	</div>

</header><!-- #site-navigation -->

	<div id="content" class="site-content">
