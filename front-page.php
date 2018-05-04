<?php
/**
 * Front Page Template
 *
 * Default template utilized when your theme has a define "Front Page"
 * within Setting->Reading within the WordPress admin
 *
 * @since 1.0.0
 *
 * @package 
 * @subpackage Templates
 */

?>

<?php get_header(); ?>

	<?php get_template_part( 'hero' ); ?>

	<div class="row container">
		<div class="small-12 columns" role="main">

			<?php do_action( 'rebar_content_before' ); ?>

			<?php if ( have_posts() ) : ?>

				<?php do_action( 'rebar_loop_before' ); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile; ?>

				<?php do_action( 'rebar_loop_after' ); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

			<?php do_action( 'rebar_content_after' ); ?>

		</div>
	</div>

<?php get_footer();