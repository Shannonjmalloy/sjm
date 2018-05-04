<?php
/**
 * Loop Template
 *
 * The default template for displaying looped content.
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

    <article <?php post_class( 'small-12 medium-6 large-4 columns' ) ?> id="post-<?php the_ID(); ?>" data-equalizer-watch>

        <header>
            <a href="<?php echo get_post_permalink();?>">
                <?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
            </a>
        </header>

        <div class="entry-content">

            <a href="<?php echo get_post_permalink();?>">
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( '', array( 'class' => 'th' ) ); ?>
                <?php endif; ?>
            </a>

            <div class="category"><?php the_category(); ?></div>

            <?php
            /** This action is documented in includes/Linchpin/hatch-hooks.php */
            do_action( 'rebar_post_entry_content_before' ); ?>

            <?php
            /** This action is documented in includes/Linchpin/hatch-hooks.php */
            do_action( 'rebar_post_entry_content_after' ); ?>
        </div>

    </article>
<?php
/** This action is documented in includes/Linchpin/hatch-hooks.php */
do_action( 'rebar_post_after' );
