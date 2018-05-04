<?php
/**
 * Single Post Template
 *
 * Default template utilized for single posts
 *
 * @since 1.0.0
 *
 * @package
 * @subpackage Templates
 */

?>
<?php get_header(); ?>

    <div class="single-work-container">

        <?php do_action( 'rebar_content_before' ); ?>

        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'content' , 'work' ); ?>

        <?php endwhile; ?>

        <?php do_action( 'rebar_after_content' ); ?>

    </div>

<?php get_footer();
