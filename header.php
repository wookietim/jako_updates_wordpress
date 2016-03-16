<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till the main content
 *
 * @package Mies
 * @since   Mies 1.0
 */

// detect what type of content are we displaying
$schema_org = '';
if ( is_singular( wpgrade::shortname() . '_portfolio' ) ) {
	$schema_org .= ' itemscope itemtype="http://schema.org/CreativeWork"';
} elseif ( is_single() ) {
	$schema_org .= ' itemscope itemtype="http://schema.org/Article"';
} else {
	$schema_org .= ' itemscope itemtype="http://schema.org/WebPage"';
}
?><!DOCTYPE html>
<!--[if lt IE 7]>
<html class="lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); echo $schema_org; ?>> <![endif]-->
<!--[if IE 7]>
<html class="lt-ie9 lt-ie8" <?php language_attributes(); echo $schema_org; ?>> <![endif]-->
<!--[if IE 8]>
<html class="lt-ie9" <?php language_attributes(); echo $schema_org; ?>> <![endif]-->
<!--[if IE 9]>
<html class="ie9" <?php language_attributes(); echo $schema_org; ?>> <![endif]-->
<!--[if gt IE 9]><!-->
<html <?php language_attributes(); echo $schema_org; ?>> <!--<![endif]-->
<head>
	<meta http-equiv="content-type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="True">
	<meta name="apple-touch-fullscreen" content="yes"/>
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php
	/**
	 * One does not simply remove this and walk away alive!
	 */
	wp_head(); ?>
</head>
<?php
$class_name = 'header--sticky';

if ( wpgrade::option( 'nav_always_show' ) ) {
	$class_name .= '  nav-scroll-show';
} else {
	$class_name .= '  nav-scroll-hide';
}

$parallax_speed = wpgrade::option( 'parallax_speed' );

$data_parallax_speed    = 'data-parallax-speed=' . (( $parallax_speed !== NULL ) ? '"' . esc_attr( $parallax_speed ) . '"' : '"0.5"');
$data_smoothscrolling   = ( wpgrade::option( 'use_smooth_scroll' ) == 1 ) ? 'data-smoothscrolling' : '';
$data_main_color        = ( wpgrade::option( 'main_color' ) ) ? 'data-color="' . esc_attr( wpgrade::option( 'main_color' ) ) . '"' : '';

$header_static  = wpgrade::option('nav_show_scroll') ? '' : 'is--static'; ?>

<body <?php body_class( $class_name );
echo ' ' . $data_smoothscrolling . ' ' . $data_parallax_speed . ' ' . $data_main_color ?> >
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
	your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to
	improve your experience.</p>
<![endif]-->
<div class="header  inverse--not-yet  <?php echo esc_attr( $header_static ) ?>">
	<div class="logo">
		<?php get_template_part( 'templates/header/branding' ); ?>
	</div>
	<div class="navigation  clearfix">
		<?php if ( has_nav_menu( 'main_horizontal_menu' ) ) {
			wpgrade_main_horizontal_nav(); ?>
			<div class="navigation__text">
				<div class="navigation__menu-label">
					<span class="label label--close"><?php _e( 'Close', 'mies_txtd' ); ?></span>
				</div>
				<?php get_template_part( 'templates/navigation-links' ); ?>
			</div>
		<?php } else { ?>
			<div class="navigation__text">
				<div class="navigation__menu-label">
					<span class="label label--open"><?php echo wpgrade::option('nav_menu_text'); ?></span>
					<span class="label label--close"><?php _e( 'Close', 'mies_txtd' ); ?></span>
				</div>
				<?php get_template_part( 'templates/navigation-links' ); ?> 
			</div>
		<?php } ?>
		<div class="navigation__trigger  <?php if ( !has_nav_menu( 'main_menu' ) ) echo 'has--no-main-menu'; ?>">
			<span class="trigger  trigger__top"></span>
			<span class="trigger  trigger__middle"></span>
			<span class="trigger  trigger__bottom"></span>
		</div>
			<form action="<?php echo get_site_url(); ?>" method="GET">
			  <input name="s" size="9" value="Search" class="navigation__text" style="position:relative;top:-25PX;height:40px;color:#808080" onclick="this.value=''">
			</form>
	</div><!-- .navigation -->
</div><!-- .header -->
<div class="overlay  overlay--navigation">
	<nav class="overlay__wrapper">

		<?php get_template_part( 'sidebar-before-overlay' ); ?>

		<div class="site-navigation">
			<?php
			$theme_locations = get_nav_menu_locations();
			$has_main_menu   = false;

			if ( isset( $theme_locations["main_menu"] ) && ( $theme_locations["main_menu"] != 0 ) ) {
				$has_main_menu = true;
			} ?>
			<h2 class="accessibility"><?php _e( 'Primary Navigation', 'mies_txtd' ) ?></h2>
			<?php wpgrade_main_nav(); ?>
		</div>

		<?php get_template_part( 'sidebar-after-overlay' ); ?>

	</nav>
</div><!-- .overlay.overlay-navigation -->