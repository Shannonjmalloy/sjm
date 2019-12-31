<?php
/**
 * Content Work Template
 *
 * The default template for displaying content. Used within single and index/archive/search templates.
 *
 * @since 1.0.0
 *
 * @package
 * @subpackage Templates
 */

$featured_image_bg = ( get_the_post_thumbnail() != '') ? "background-image: url('" . get_the_post_thumbnail_url() . "');" : "background-color: #f7f6ef";
$categories = wp_get_post_terms( get_the_id(), 'category' );

$post_date = get_the_date( 'Y' );
?>

<?php
/** This action is documented in includes/Linchpin/hatch-hooks.php */
do_action( 'rebar_post_before' ); ?>

    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">

        <header class="header">
            <div class="row">
                <div class="small-12 columns">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    <div class ="post-categories">
                        <?php if ( $categories ):
                            foreach ( $categories as $category ): ?>
                                <a href="<?php echo get_term_link( $category->term_id, 'category' ); ?>" class="<?php echo $category->slug; ?>"><?php echo $category->name; ?></a>
                            <?php endforeach;
                        endif; ?>
                    </div>
                    <div class="post-date">
                       <h5><?php echo $post_date; ?></h5>
                    </div>
                </div>
            </div>
        </header>

        <div class="entry-content">
            <div class="row" id="foo">

                <?php
                    /** This action is documented in includes/Linchpin/hatch-hooks.php */
                    do_action( 'rebar_post_entry_content_before' ); ?>

                <div class="small-12 medium-4 large-3 columns tag-container" data-sticky-container>
                    <div class="tags sticky" data-sticky data-anchor="foo" >
                        <h4>
                        <?php $posttags = get_the_tags();
                        if ($posttags) {
                            echo '<ul>';
                            foreach($posttags as $tag) {
                                echo '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
                            }
                            echo'</ul>';
                        } ?>
                        </h4>
                    </div>
                </div>

                <div class="small-12 medium-8 large-9 columns">
                    <?php if ( get_the_content() ) : ?>
                        <h2>The Vision</h2><hr/><?php the_content(); ?>
                    <?php elseif (get_field('Introduction')) : ?>
                        <h2>The Vision</h2><hr/><?php the_field('Introduction'); ?>
                    <?php endif; ?>


                    <?php if ( get_field('sketches') ) : ?>
                        <h2>The Process</h2><hr/><div class="sketches"> <?php the_field('sketches') ?></div>
                    <?php endif; ?>

                    <?php if ( get_field('the_project')) : ?>
                        <h2>Final Product</h2><hr/><div class="finalproduct"> <?php the_field('the_project') ?></div>
                    <?php endif; ?>

                </div>


                    <?php
                    /** This action is documented in includes/Linchpin/hatch-hooks.php */
                    do_action( 'rebar_post_entry_content_after' ); ?>

                <div class="small-12 columns">

                    <footer>
                        <?php wp_link_pages( array(
                            'before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'sjm' ),
                            'after'  => '</p></nav>',
                        ) ); ?>
                    </footer>

                </div>
            </div>
        </div>

        <?php get_template_part( 'partials/edit-controls' ); ?>

        <?php

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif; ?>

    </article>
<?php
/** This action is documented in includes/Linchpin/hatch-hooks.php */
do_action( 'rebar_post_after' );
