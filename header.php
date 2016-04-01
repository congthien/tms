<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tms
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>



<body <?php body_class(); ?>>
<div id="page" class="body site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'tms' ); ?></a>

	<header id="masthead" class="topbar .hidden-sm" role="banner">
			<div class="container vrpadl0">

					<?php wp_nav_menu( array( 'theme_location' => 'top', 'menu_class' => 'social-icons topmenu pull-right' ) ); ?>


					<div class="widget sidebar-widget widget_search home_search pull-right col-md-3 col-sm-4 col-xs-8">
						<?php echo get_search_form() ?>
					</div>


					<div class="col-md-3">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="btn btn-primary hidden-xs hidden-sm"><?php bloginfo( 'name' ); ?></a>
					</div>

			</div>

	</header><!-- #masthead -->


	<!-- Site Header Wrapper -->
  <div class="site-header-wrapper">
        <!-- Site Header -->
        <div class="site-header">
            <div class="container">

                <div class="site-logo">
						<?php
						$site_text_logo 	= get_bloginfo( 'name' );
						$site_image_logo 	= get_theme_mod( 'tms_site_image_logo' );

						if ((isset($site_text_logo) && $site_text_logo != "") || (isset($site_image_logo) && $site_image_logo != "")) {
								if (isset($site_image_logo) && $site_image_logo != "") {
										echo '<a class="default-logo" href="' . esc_url( site_url( '/') ) . '" rel="home">';
											echo '<img src="' . $site_image_logo . '" alt="' . get_bloginfo('title') . '">';
										echo '</a>';
										echo '<a class="default-retina-logo" href="' . esc_url( site_url( '/') ) . '" rel="home">';
											echo '<img src="' . $site_image_logo . '" alt="' . get_bloginfo('title') . '">';
										echo '</a>';
										echo '<a class="sticky-logo" href="' . esc_url( site_url( '/') ) . '" rel="home">';
											echo '<img src="' . $site_image_logo . '" alt="' . get_bloginfo('title') . '">';
										echo '</a>';
										echo '<a class="sticky-retina-logo" href="' . esc_url( site_url( '/') ) . '" rel="home">';
											echo '<img src="' . $site_image_logo . '" alt="' . get_bloginfo('title') . '">';
										echo '</a>';
								} elseif (isset($site_text_logo) && $site_text_logo != "") {
										echo '<a class="site-text-logo" href="' . esc_url(site_url('/')) . '" rel="home">' . $site_text_logo . '</a>';
								}
						} else {
								if (is_front_page() && is_home()) :
										echo '<h1 class="site-title"><a href="' . esc_url(site_url('/')) . '" rel="home">' . get_bloginfo('name') . '</a></h1>';
								else :
										echo '<p class="site-title"><a href="' . esc_url(site_url('/')) . '" rel="home">' . get_bloginfo('name') . '</a></p>';
								endif;
						}

						?>

				</div>

             	<a href="#" class="visible-sm visible-xs" id="menu-toggle"><i class="fa fa-bars"></i></a>

				<?php
				$args = array('theme_location' => 'primary', 'menu_class' => 'sf-menu dd-menu pull-right');
				if ( has_nav_menu( 'mobile' ) ) {
					$args['container_class'] = 'hidden-xs hidden-sm';
				}
				wp_nav_menu( $args );
				?>

				<?php if ( has_nav_menu( 'mobile' ) ) {
					wp_nav_menu( array( 'theme_location' => 'mobile', 'menu_class' => 'sf-menu dd-menu', 'container_class' => 'visible-xs visible-sm hidden-md hidden-lg' ) );
				} ?>

            </div>
        </div>
  </div>

	<div id="content" class="site-content">
