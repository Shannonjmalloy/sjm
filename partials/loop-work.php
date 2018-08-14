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

$featured_image_bg = ( get_the_post_thumbnail() != '') ? "background-image: url('" . get_the_post_thumbnail_url() . "');" : "background-color: #36494E";
$categories = wp_get_post_terms( get_the_id(), 'category' );


/** This action is documented in includes/Linchpin/hatch-hooks.php */
do_action( 'rebar_post_before' ); ?>

    <article <?php post_class( 'small-12 medium-6 large-4 columns clickable' ) ?> id="post-<?php the_ID(); ?>">

        <div class="featured_image_bg " style="<?php echo $featured_image_bg; ?>" data-equalizer-watch>
            <a href="<?php echo get_post_permalink();?>">
                <div class="work-archive-link" data-equalizer-watch>
                    <?php the_title( '<h3 class="entry-title">', '</h3>' );
                    if ( $categories ):
                        foreach ( $categories as $category ): ?>
                            <a href="<?php echo get_term_link( $category->term_id, 'category' ); ?>" class="<?php echo $category->slug; ?>"><?php echo $category->name; ?></a>
                        <?php endforeach;
                    endif; ?>

                    <?php
                    /** This action is documented in includes/Linchpin/hatch-hooks.php */
                    do_action( 'rebar_post_entry_content_before' ); ?>

                    <?php
                    /** This action is documented in includes/Linchpin/hatch-hooks.php */
                    do_action( 'rebar_post_entry_content_after' ); ?>
                </div>
            </a>
        </div>

    </article>
<?php
/** This action is documented in includes/Linchpin/hatch-hooks.php */
do_action( 'rebar_post_after' );
