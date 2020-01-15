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
$roles = wp_get_post_terms( get_the_id(), 'role' );
$employers = wp_get_post_terms( get_the_id(),'employer');
$project_years = wp_get_post_terms( get_the_id(),'project_year');
$programs = wp_get_post_terms( get_the_id(),'programs');

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

                <div class="small-12 medium-4 large-3 columns tag-container"><!-- data-sticky-container -->
                    <div class="tags">  <!-- "sticky"  data-sticky data-anchor="foo"-->
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
                        <?php if( $roles ) { ?>
                            <span class="role">
                            Role: 
                                <?php foreach ($roles as $role) {
                                    $role_link = get_term_link( $role );
                                    echo '<a href="' . esc_url( $role_link ) . '">' . $role->name . '</a>'; 
                                } ?>
                            </span><br/>
                        <?php } ?>
                        <?php if( $employers ) { ?>
                            <span class="employer">
                            Employer: 
                                <?php foreach ($employers as $employer) {
                                    $employer_link = get_term_link( $employer );
                                    echo '<a href="' . esc_url( $employer_link ) . '">' . $employer->name . '</a>'; 
                                } ?>
                            </span><br/>
                        <?php } ?>
                        <?php if( $programs ) { ?>
                            <span class="programs">
                                Programs:
                                <?php foreach($programs as $program) {
                                    $program_link = get_term_link( $program );
                                    echo '<a href="' . esc_url( $program_link ) . '">' . $program->name . '</a>';} ?>
                            </span><br/>
                        <?php } ?>
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

            </div>
        </div>
        <!--prev next posts-->
        <!--<div class="row">
            <div class="small-12 columns"><hr/></div>
            <div class="link next small-6 columns">
                <div class="show-for-medium-up"><?php next_post_link( '%link', '%title' ); ?></div>
            </div>
            <div class="link previous small-6 columns">
                <div class="show-for-medium-up text-right"><?php previous_post_link( '%link', '%title' ); ?></div>
            </div> 
        </div>-->
        <!--related posts-->
        <div class="related-work-footer row">
            <div class="column small-12 ">
                <?php echo do_shortcode('[related-work]'); ?>
            </div>
        </div>

        <?php

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif; ?>

    </article>
<?php
/** This action is documented in includes/Linchpin/hatch-hooks.php */
do_action( 'rebar_post_after' );
