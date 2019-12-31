<?php
/**
 * sjm_shortcodes
 *
 * @author Shannon Malloy
 * @package sjm
 *
 */

class sjm_shortcodes {
    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    function __construct() {
        //add shortcode before creating the function
        add_shortcode( 'recent-work',    array( $this, 'recent_work') );
        add_shortcode( 'featured-work',    array( $this, 'featured_work') );
    }

    function recent_work( $atts ) {
        $atts = shortcode_atts(array(
            'id'        => '',
            'recent'   => '3',
        ), $atts, 'recent-work');

        $ids = $atts['id'];

        $ids = array_map( 'trim', explode( ',', $atts['id'] ) );
        $recent = $atts['recent'];

        //if id's are defined
        if ($atts['id']) {
            $args = array(
                'post_type'      => 'work',
                'posts_per_page' => $recent,
                'post__in'       => $ids,
                'order'          => 'ASC',
                'orderby'        =>'post__in'
            );
        } else {
            // just show the 3 most recent posts
            $args = array(
                'post_type' => 'work',
                'posts_per_page' => $recent,
                'order'          => 'DSC',

            );
        }

        $work = new WP_Query( $args );

        //this order of this particular piece can sometime cause issues
        ob_start(); ?>

        <?php
        // if there are posts start the loop
        if ( $work->have_posts() ) :?>
            <div id="recent-work" class="row loop-work-container" data-equalizer="">

                    <?php //start loop 'while'
                    while ( $work->have_posts() ) : $work->the_post();

                        $featured_image_bg = ( get_the_post_thumbnail() != '') ? "background-image: url('" . get_the_post_thumbnail_url() . "');" : "background-color: #36494E";
                        $categories = wp_get_post_terms( get_the_id(), 'category' );
                    ?>

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

                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>

            </div>

        <?php endif;

        $output = ob_get_contents();

        ob_end_clean();

        return $output;

    }


    function featured_work( $atts ) {
        $atts = shortcode_atts(array(
            'id'        => '',
            'recent'   => '1',
        ), $atts, 'featured-work');

        $ids = $atts['id'];

        $ids = array_map( 'trim', explode( ',', $atts['id'] ) );
        $recent = $atts['recent'];

        //if id's are defined
        if ($atts['id']) {
            $args = array(
                'post_type'      => 'work',
                'posts_per_page' => $recent,
                'post__in'       => $ids,
                'order'          => 'ASC',
                'orderby'        =>'post__in'
            );
        } else {
            // just show the most recent posts
            $args = array(
                'post_type' => 'work',
                'posts_per_page' => $recent,
                'order'          => 'DSC',

            );
        }

        $work = new WP_Query( $args );

        //this order of this particular piece can sometime cause issues
        ob_start(); ?>

        <?php
        // if there are posts start the loop
        if ( $work->have_posts() ) :?>
            <div id="featured-work" class="row loop-work-container">

                <?php //start loop 'while'
                while ( $work->have_posts() ) : $work->the_post();

                    $featured_image_bg = ( get_the_post_thumbnail() != '') ? "background-image: url('" . get_the_post_thumbnail_url() . "');" : "background-color: #36494E";
                    $categories = wp_get_post_terms( get_the_id(), 'category' );
                    ?>

                    <article <?php post_class( 'row clickable' ) ?> id="post-<?php the_ID(); ?>" data-equalizer="">

                        <div class="smal1-12 medium-6 columns" style="<?php echo $featured_image_bg; ?>" data-equalizer-watch>
                            <a href="<?php echo get_post_permalink();?>">
                                <?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
                            </a>
                        </div>

                        <div class="post-text smal1-12 medium-6 columns" data-equalizer-watch>
                            <div class="work-archive-link" >
                                <?php if ( $categories ):
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
                            <p><?php esc_html_e( wp_trim_words( get_the_excerpt(), 30 ) ); ?></p>
                            <?php if ( get_post_meta( get_the_ID(), '_od_show_date', true ) ) : ?>
                                <p class="displayed-post-date"><?php echo date('n.d.Y', strtotime( get_the_date() ) ); ?></p>
                            <?php endif; ?>
                        </div>

                    </article>

                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>

            </div>

        <?php endif;

        $output = ob_get_contents();

        ob_end_clean();

        return $output;

    }  
}