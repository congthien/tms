<?php
/**
 * tms functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package tms
 */

if ( ! function_exists( 'tms_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tms_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on tms, use a find and replace
	 * to change 'tms' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'tms', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'tms_blog_medium', 600, 400, true );
	add_image_size( 'tms_product_thumb', 265, 353, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'tms' ),
		'footer'  => esc_html__( 'Footer', 'tms' ),
		'top'  	  => esc_html__( 'Top Menu', 'tms' ),
		'mobile'  => esc_html__( 'Mobile Menu', 'tms' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	// add_theme_support( 'post-formats', array(
	// 	'aside',
	// 	'image',
	// 	'video',
	// 	'quote',
	// 	'link',
	// ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'tms_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'tms_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tms_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tms_content_width', 640 );
}
add_action( 'after_setup_theme', 'tms_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tms_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'tms' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'tms' ),
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget footer_widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'tms' ),
		'id'            => 'footer-2',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget footer_widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'tms' ),
		'id'            => 'footer-3',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget footer_widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'tms_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tms_scripts() {



	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), '3.3.6' );
	wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri() . '/assets/css/bootstrap-theme.css', array(), '3.3.6' );

	wp_enqueue_style( 'tms-style', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css', array(), '4.5' );
	wp_enqueue_style( 'line-icons', get_template_directory_uri() . '/assets/css/line-icons.css', array(), '4.4' );
	wp_enqueue_style( 'animations', get_template_directory_uri() . '/assets/css/animations.css', array(), '4.4' );

	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), '4.4' );
	wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css', array(), '1.24' );
	wp_enqueue_style( 'owl.theme', get_template_directory_uri() . '/assets/css/owl.theme.css', array(), '1.24' );
	wp_enqueue_style( 'custom', get_template_directory_uri() . '/assets/css/custom.css', array(), '4.4' );
	wp_enqueue_style( 'color3-2', get_template_directory_uri() . '/assets/css/color3-2.css', array(), '4.4' );




	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'tms-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . 		'/assets/js/bootstrap.js', array(), '3.3.6', true );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . 		'/assets/js/modernizr.js', array(), '3.3.6', true );
	wp_enqueue_script( 'ui-plugins', get_template_directory_uri() . 		'/assets/js/ui-plugins.js', array(), '3.3.6', true );
	wp_enqueue_script( 'helper-plugins', get_template_directory_uri() . 		'/assets/js/helper-plugins.js', array(), '3.3.6', true );
	wp_enqueue_script( 'jquery.flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider.js', array(), '20151215', true );
	wp_enqueue_script( 'jquery.magnific-popup.min', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array(), '20151215', true );
	wp_enqueue_script( 'owl.carousel.min', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), '20151215', true );

	wp_enqueue_script( 'init', get_template_directory_uri() . 		'/assets/js/init.js', array(), '4.4', true );

	wp_enqueue_script( 'tms-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tms_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Metabox for page.
 */
//require get_template_directory() . '/inc/page-metabox.php';
