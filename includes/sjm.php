<?php
/**
 * SJM
 *
 * @author Shannon Malloy
 * @package sjm
 *
 */

class sjm {

	public $apple_favicon_sizes = array(
		57,
		60,
		72,
		76,
		114,
		120,
		144,
		152,
		180,
	);

	public $favicon_sizes = array(
		16,
		32,
		96,
		192,
	);

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {

		$foundation = new Foundation();
		$hatch  = new Hatch();

		add_filter( 'upload_mimes',			array( $this, 'upload_mimes' ) );
		add_filter( 'admin_footer_text', 	array( $this, 'admin_footer_text' ) );
		add_filter( 'site_icon_image_sizes', array( $this, 'site_icon_image_sizes' ) );
		add_filter( 'site_icon_meta_tags',   array( $this, 'site_icon_meta_tags' ) );

		add_action( 'wp_enqueue_scripts', 	array( $this, 'wp_enqueue_scripts') );
		add_action( 'wp_enqueue_scripts', 	array( $this, 'wp_enqueue_styles') );
		add_action( 'init', 			  	array( $this, 'init' ) );
		add_action( 'widgets_init', 	  	array( $this, 'widgets_init' ) );
		add_action( 'customize_register',	array( $this, 'customize_register' ) );

		add_action( 'after_setup_theme', 	array( $this, 'after_setup_theme' ) );
		add_action( 'after_setup_theme',	array( $this, 'add_editor_styles' ) );
	}

	/**
	 * Init hook function.
	 *
	 * @access public
	 * @return void
	 */
	function init() {
		register_nav_menus( array(
		    'top-bar' 			=> 'Top Bar', // registers the menu in the WordPress admin menu editor
		    'footer' 			=> 'Footer',
		    'mobile-off-canvas' => 'Mobile (Off Canvas)',
		    'social'            => 'Social Links',
		));
	}

	/**
	 * Add in the theme author info, hatch info and be sure to keep love for WordPress
	 * admin_footer_text function.
	 *
	 * @access public
	 * @return void
	 */
	function admin_footer_text() {
		echo 'Powered by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Created by <a href="http://shannonmalloy.com/?utm_source=hatch&utm_medium=rebar_footer&utm_campaign=rebar_notice" target="_blank">Shannon Malloy</a> and augmented by the <a href="http://github.com/linchpinagency/hatch/?utm_source=hatch&utm_medium=rebar_footer&utm_campaign=rebar_notice" target="_blank">Hatch</a>';
	}

	/**
	 * Save custom favicon sizes from customizer upload
	 *
	 * @access public
	 * @param $sizes Array of image sizes to save.
	 * @return Merged array containing custom favicon sizes.
	 */
	function site_icon_image_sizes( $sizes ) {
		foreach ( $this->apple_favicon_sizes as $apple_favicon_size  ) {
			$sizes[] = $apple_favicon_size;
		}

		foreach ( $this->favicon_sizes as $favicon_size  ) {
			$sizes[] = $apple_favicon_size;
		}

		return $sizes;
	}

	/**
	 * Insert favicon meta tags to the head of the site.
	 *
	 * @access public
	 * @param $meta_tags Array of meta tags returned to output.
	 @ return Merged array containing custom meta tags.
	 */
	function site_icon_meta_tags( $meta_tags ) {
		foreach ( $this->apple_favicon_sizes as $apple_favicon_size  ) {
			$meta_tags[] = sprintf( '<link rel="apple-touch-icon" sizes="%s" href="%s" />', $apple_favicon_size . 'x' . $apple_favicon_size, esc_url( get_site_icon_url( $apple_favicon_size ) ) );
		}

		foreach ( $this->favicon_sizes as $favicon_size  ) {
			$meta_tags[] = sprintf( '<link rel="icon" type="image/png" sizes="%s" href="%s" />', $favicon_size . 'x' . $favicon_size, esc_url( get_site_icon_url( $favicon_size ) ) );
		}

		return $meta_tags;
	}

	/**
	 * We have found that these are pretty much 3 areas that clients request
	 * for easier customizations.
	 *
	 * Registers our 3 base sidebars
	 * Home Widgets
	 * Page Widgets
	 * Footer Widgets
	 *
	 * @access public
	 * @return void
	 */
	function widgets_init() {
		register_sidebar( array(
			'name'          => 'Home Widgets',
			'id'            => 'home-widgets',
			'description'   => 'Widgets that are displayed on the home page.',
			'class'         => 'home-widgets',
			'before_widget' => '<div id="%1$s" class="widget small-4 columns %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => 'Page Widgets',
			'id'            => 'page-widgets',
			'description'   => 'Widgets that are displayed on interior pages.',
			'class'         => 'page-widgets',
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widgettitle">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => 'Footer Widgets',
			'id'            => 'footer-widgets',
			'description'   => 'Widgets that are displayed in the footer.',
			'class'         => 'footer-widgets',
			'before_widget' => '<div id="%1$s" class="right %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widgettitle">',
			'after_title'   => '</h5>',
		) );
	}

	/**
	 * print_jquery_in_footer function.
	 * Removes the jquery library from the header and prints it in the footer
	 *
	 * @access public
	 * @param array &$scripts
	 * @return void
	 */
	function print_jquery_in_footer( &$scripts) {
		if ( ! is_admin() )
			$scripts->add_data( 'jquery', 'group', 1 );
	}

	/**
	 * after_setup_theme function.
	 *
	 * @access public
	 * @return void
	 */
	function after_setup_theme() {
	    add_theme_support( 'menus' );
	    add_theme_support( 'title-tag' );
	    add_theme_support( 'post-thumbnails' );
	    add_theme_support( 'automatic-feed-links' );
	    update_option( 'image_default_link_type', 'none' );
	}

	/**
	 * wp_enqueue_scripts function.
	 *
	 * @access public
	 * @return void
	 */
	function wp_enqueue_scripts() {
		wp_enqueue_script( 'sjm', 	 get_stylesheet_directory_uri() . '/js/sjm.js', array( 'jquery' ), SJM_VERSION, true );
        wp_enqueue_script( 'slick-js', get_stylesheet_directory_uri() . '/vendor/slick/slick.js', array( 'jquery' ), '1.8.0' );

    }

	/**
	 * Enqueue our theme styles.
	 *
	 * @access public
	 * @return void
	 */
	function wp_enqueue_styles() {
		wp_enqueue_style( 'app-css', get_stylesheet_directory_uri() . '/css/sjm.css' );
        wp_enqueue_style( 'typekit', '//use.typekit.net/yxo3vya.css', array(), '1.0.0');
        wp_enqueue_style( 'foundation-icons', get_stylesheet_directory_uri() . '/bower_components/foundation-sites/foundation-icons/foundation-icons.css' );
        wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() . '/vendor/slick/slick.css' );
        wp_enqueue_style( 'slick-theme-css', get_stylesheet_directory_uri() . '/vendor/slick/slick-theme.css' );
	}

	/*
	 * customize_register function.
	 *
	 * Allows header logo to be set-up from
	 * the customize panel under Appearance within the WordPress Admin
	 *
	 * Also allow for the .svg extension within logo uploading
	 *
	 * @since 1.0
	 *
	 * @param $wp_customize
	 */
	function customize_register ( $wp_customize ) {

		$wp_customize->add_section (
			'sjm_logo', array(
				'title' 	=> __('Site Logo', 'sjm'),
				'priority' 	=> 80,
			)
		);

		$wp_customize->add_setting (
			'sjm_theme_options[logo_upload]', array(
				'default'		=> get_stylesheet_directory_uri() . '/assets/images/linchpin-icon-white.svg',
				'capability' 	=> 'edit_theme_options',
				'type'			=> 'option',
			)
		);

		$wp_customize->add_control (
			new WP_Customize_Image_Control( $wp_customize, 'logo_upload', array (
				'label'		=> __('Site Logo', 'sjm'),
				'section' 	=> 'sjm_logo',
				'settings' 	=> 'sjm_theme_options[logo_upload]',
				'extensions'	=> array( 'jpg', 'jpeg', 'png', 'gif', 'svg' ),
			) )
		);
	}

	/**
	 * linchpin_upload_mimes function.
	 *
	 * @access public
	 * @param array $mimes (default: array())
	 * @return array
	 */
	function upload_mimes( $mimes = array() ) {
	    $mimes['svg'] = 'image/svg+xml';
	    return $mimes;
	}

	/**
	 * add customized styles to the WordPress admin to match frontend editing
	 */
	function add_editor_styles() {
		$admin_style = get_stylesheet_directory_uri() . '/css/admin-editor.css';

	    add_editor_style( $admin_style );
	}
}