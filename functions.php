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

add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
    if( is_archive() && (is_category() || is_tag()) && empty( $query->query_vars['suppress_filters'] ) ) {
        $post_type = get_query_var('post_type');
        if($post_type)
            $post_type = $post_type;
        else
            $post_type = array('post', 'work');
        $query->set('post_type',$post_type);
        return $query;
    }
}

function recent_posts($atts, $content = NULL)
{
    $atts = shortcode_atts(
        [
            'orderby' => 'date',
            'posts_per_page' => '6',
            'post_type' => 'work',

        ], $atts, 'recent-posts' );

    $query = new WP_Query( $atts );

    $output = '<ul class="recent-posts">';

    while($query->have_posts()) : $query->the_post();

        $output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a> - <small>' . get_the_date() . '</small></li>';

    endwhile;

    wp_reset_query();

    return $output . '</ul>';
}
add_shortcode('recent-posts', 'recent_posts');


