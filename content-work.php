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


?>

<?php
/** This action is documented in includes/Linchpin/hatch-hooks.php */
do_action( 'rebar_post_before' ); ?>

    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">

        <header class="featured_image_bg" style="<?php echo $featured_image_bg; ?>">
            <div class="row">
                <div class="small-12 columns">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    <div class="category"><?php the_category(); ?></div>
                </div>
            </div>
        </header>

        <div class="entry-content">
            <div class="row">

                <?php
                    /** This action is documented in includes/Linchpin/hatch-hooks.php */
                    do_action( 'rebar_post_entry_content_before' ); ?>

                <div class="small-12 medium-5 large-4 columns">
                    <div class="tags">
                        <h4>
                        <?php $posttags = get_the_tags();
                        if ($posttags) {
                            echo '<ul>';
                            foreach($posttags as $tag) {
                                echo '<li>' . $tag->name . '</li>';
                            }
                            echo'</ul>';
                        } ?>
                        </h4>
                    </div>
                </div>

                <div class="small-12 medium-7 large-8 columns">
                    <?php the_content(); ?>
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
