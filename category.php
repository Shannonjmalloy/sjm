<?php
/**
 * Category Archive Template
 *
 * Template for display all Work archive pages.
 *
 * @since 1.0.0
 *
 * @package
 * @subpackage Templates
 */

?>

<?php get_header(); ?>

<?php get_template_part( 'hero' ); ?>
<?php get_template_part( 'partials/filter-buttons' ); ?>


    <div class="row container">
        <div class="small-12 columns loop-work-container" role="main" data-equalizer="">

            <?php
            /** This action is documented in includes/Linchpin/hatch-hooks.php */
            do_action( 'rebar_content_before' ); ?>

            <?php if ( have_posts() ) : ?>

                <?php
                /** This action is documented in includes/Linchpin/hatch-hooks.php */
                do_action( 'rebar_loop_before' ); ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'partials/loop-work', get_post_type( 'post' ) ); ?>

                <?php endwhile; ?>

                <?php
                /** This action is documented in includes/Linchpin/hatch-hooks.php */
                do_action( 'rebar_loop_after' ); ?>

            <?php else : ?>

                <?php get_template_part( 'content', 'none' ); ?>

            <?php endif; ?>

            <?php
            /** This action is documented in includes/Linchpin/hatch-hooks.php */
            do_action( 'rebar_content_after' ); ?>

            <?php get_template_part( 'images/partials/pagination' ); ?>
        </div>
    </div>
<?php get_footer();
