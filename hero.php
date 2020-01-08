<?php
/**
 * Hero/Slideshow area
 *
 * @since 1.0.0
 *
 * @package 
 * @subpackge Templates
 *
 * Template Part: Hero
 */

if (has_post_thumbnail( $post->ID ) ) {
    $hero_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
    $hero_image = $hero_image_url[0];
}

if ( is_archive()) {
    $pt = get_post_type_object( 'work' );

    $pt_singular_name = $pt->labels->singular_name;
    $title_name = $pt_singular_name;

    $the_title_name = '<h1>' . $title_name . '</h1>';

    if ( is_category() || is_tag() || is_tax() ) {
        $current_archive = get_queried_object();
        $archive_name    = $current_archive->name;

        $the_title_name = '<h1>' . $title_name . '</h1><h3>' . $archive_name . '</h3>';
    }
}
else {
    $the_title_name = '<h1>' . get_the_title() . '</h1>';
}

?>

<?php if ( ! is_front_page()) : ?>
<header id="homepage-hero" class="container" role="banner"  <?php if ( ! is_archive() )  { echo 'style="background-image: url( ' .  $hero_image . ' ) "; ' ; } ?> >
	<div class="row">
		<div class="hero-heading columns">
			<?php echo $the_title_name; ?>
		</div>
	</div>
</header>
<?php endif; ?>