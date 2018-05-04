<?php
/**
 * Work Archive Template
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

    <div class="row container">
        <div class="small-12 columns" role="main">


            <?php
            /** This action is documented in includes/Linchpin/hatch-hooks.php */
            do_action( 'rebar_content_before' ); ?>

            <?php if ( have_posts() ) : ?>

                <?php
                /** This action is documented in includes/Linchpin/hatch-hooks.php */
                do_action( 'rebar_loop_before' ); ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">

                        <div class="entry-content">
                            <div class="small-12 medium-4 large-3 columns">

                                <a href="<?php echo get_post_permalink();?>">

                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( '', array( 'class' => 'th' ) ); ?>
                                    <?php endif; ?>

                                    <?php the_title( '<p class="entry-title">', '</p>' ); ?>
                                </a>
                                <div class="tags"><?php the_tags(); ?></div>

                                <?php
                                /** This action is documented in includes/Linchpin/hatch-hooks.php */
                                do_action( 'rebar_post_entry_content_before' ); ?>

                                <?php the_content(); ?>

                                <?php
                                /** This action is documented in includes/Linchpin/hatch-hooks.php */
                                do_action( 'rebar_post_entry_content_after' ); ?>
                            </div>
                        </div>


                    </article>
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
        <?php get_sidebar(); ?>
    </div>
<?php get_footer();
