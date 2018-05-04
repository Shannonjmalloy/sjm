<?php
/**
 * HatchMenu class.
 *
 * @package Hatch
 * @since 1.0.0
 */

/**
 * Class HatchMenu
 */
class HatchMenu {
	/**
	 * Construct.
	 *
	 * @access public
	 */
	function __construct() {
		add_action( 'wp_before_admin_bar_render', array( $this, 'add_links' ) );
	}

	/**
	 * Add a link to display if you are on staging or prod.
	 *
	 * @todo this should be a plugin
	 * @since 1.0
	 *
	 * @access public
	 * @return void
	 */
	function add_links() {
		global $wp_admin_bar;

		if ( strpos( site_url(), 'staging' ) !== false ) {
			$title  = __( 'Staging', 'launchpad' );
			$meta   = array(
				'class'    => 'staging',
			);
		} else {
			$title  = __( 'Production', 'launchpad' );
			$meta   = array(
				'class'    => 'production',
			);
		}

		$args = array(
			'parent' => 'top-secondary',
			'id'     => 'staging_flag',
			'title'  => '',
			'href'   => '#',
			'meta'	 => $meta,
		);

		$wp_admin_bar->add_menu( $args );
	}
}
