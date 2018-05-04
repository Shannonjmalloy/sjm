<?php
/**
 * Content Template
 *
 * The default template for displaying content. Used within single and index/archive/search templates.
 *
 * @since 1.0.0
 *
 * @package 
 * @subpackage Templates
 */

?>

<?php
/** This action is documented in includes/Linchpin/hatch-hooks.php */
do_action( 'rebar_post_before' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<h1><?php the_title(); ?></h1>
	</header>

	<?php
	/** This action is documented in includes/Linchpin/hatch-hooks.php */
	do_action( 'rebar_post_entry_content_before' ); ?>

	<div class="entry-content">
		<?php the_content( __( 'Continue reading...', 'sjm' ) ); ?>
	</div>

	<?php
	/** This action is documented in includes/Linchpin/hatch-hooks.php */
	do_action( 'rebar_post_entry_content_after' ); ?>

	<?php get_template_part( 'partials/edit-controls' ); ?>
</article>

<?php
/** This action is documented in includes/Linchpin/hatch-hooks.php */
do_action( 'rebar_post_after');
