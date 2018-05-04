<?php
/**
 *
 * Include all of our needed Classes and scripts
 *
 * Originally based on the work done by Ole Fredrik Lie (http://olefredrik.com) Forked by Linchpin
 *
 * Also uses some sweet grunt init scaffolding from 10up.
 *
 * We've added in a ton of functionality we utilize on a daily basis.
 * It's not necessarily meant to have a TON of options and controls.
 * Just a clean base for Linchpin build outs.
 * Use as you'd like please fork and commit back.
 *
 */

// Useful global constants
define( 'SJM_VERSION', '' );

if ( ! defined( 'SCRIPT_DEBUG' ) ) {
	define( 'SCRIPT_DEBUG', true ); // enable script debug by default
}

include_once( 'includes/Linchpin/hatch.php' );        // Hatch Classes
include_once( 'includes/Foundation/foundation.php' ); // Foundation Classes
include_once( 'includes/sjm.php' ); // Theme Class

/**
 *	Instantiate our classes.
 */

$theme = new sjm();
