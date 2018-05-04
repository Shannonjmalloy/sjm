<?php
/**
 * Content-work Template
 *
 * The default template for displaying portfolio content. Used within single and index/archive/search templates.
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

    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">

        <div class="entry-content">
            <div class="small-12 medium-4 large-3 columns">

                <a href="<?php echo get_post_permalink();?>">

                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( '', array( 'class' => 'th' ) ); ?>
                    <?php endif; ?>

                    <?php the_title( '<p class="entry-title">', '</p>' ); ?>
                </a>
                <div class="category"><?php the_category(); ?></div>

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


<?php
/** This action is documented in includes/Linchpin/hatch-hooks.php */
do_action( 'rebar_post_after');
