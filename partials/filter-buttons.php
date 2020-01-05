<?php
/**
 * Buttons to filter work in archive area
 *
 * @since 1.0.0
 *
 * @package 
 * @subpackge Templates
 *
 * Template Part: Filter Buttons
 */
?>

<div class="filter-buttons row">
    <div class="columns small-12">
        <?php
        $categories = get_categories( array(
            'orderby' => 'name',
            'order'   => 'ASC'
        ) );
         
        $category_name = $category->name;
        $category_termid = $category->term_id;


        foreach( $categories as $category ) {
            $category_link = sprintf( 
                '<a class="filter-button button category-' . strtolower(esc_html( $category->name )) . '" href="%1$s" alt="%2$s">%3$s</a>',
                esc_url( get_category_link( $category->term_id ) ),
                esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
                esc_html( $category->name )
            );
             
            echo sprintf( esc_html__( '%s', 'textdomain' ), $category_link );
        } ?> 

        <a class="filter-button button" href="<?php echo get_post_type_archive_link( 'work' ); ?>">All Work</a>  
    </div>               
</div>