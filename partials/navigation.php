<?php
/**
 * Navigation
 *
 * This template handles our main navigation markup
 *
 * @since 1.0.0
 *
 * @package 
 * @subpackage Partials
 */

?>
<?php
$options = get_option( 'sjm_theme_options' );

if ( isset( $options['logo_upload'] ) ) {
	$logo = true;
}

?>
<div id="mobile-menu" class="hide-for-large">
    <nav class="top-bar row expanded">
        <section class="top-bar-title small-10 columns">
              <a href="<?php esc_attr_e( home_url() ); ?>" class="site-logo">
                <?php if ( ! empty( $logo ) ) : ?>
                    <img src="<?php esc_attr_e( $options['logo_upload'] ); ?>"
                         alt="<?php esc_attr_e( get_bloginfo( 'name' ) ); ?>"/>
                <?php else : ?>
                    <?php bloginfo( 'name' ); ?>
                <?php endif; ?>
            </a>
        </section>
        <section class="small-2 columns">
            <div class="top-bar-right">
                <a class="right-off-canvas-toggle icon-menu" data-toggle="offCanvas"></a>
            </div>
        </section>
    </nav>
</div>
<div id="main-menu" class="hide-for-medium-down show-for-large " data-parent="<?php esc_attr_e( $post->post_type ); ?>" data-sticky-container>
	<div class="top-bar row expanded" data-topbar="" data-sticky data-options="marginTop:0;">
		<div class="top-bar-title small-5 columns">
            <a href="<?php esc_attr_e( home_url() ); ?>" class="site-logo">
                <?php if ( ! empty( $logo ) ) : ?>
                    <img src="<?php esc_attr_e( $options['logo_upload'] ); ?>"
                         alt="<?php esc_attr_e( get_bloginfo( 'name' ) ); ?>" class="site-logo" />
                <?php else : ?>
                    <?php bloginfo( 'name' ); ?>
                <?php endif; ?>
            </a>
        </div>
		<div class="small-7 columns">
            <div class="top-bar-right">
			<?php
            wp_nav_menu( array(
                'container'       => false,
                'container_class' => '',
                'menu'            => '',
                'menu_id'         => 'primary-menu',
                'menu_class'      => 'dropdown menu',
                'theme_location'  => 'top-bar',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'depth'           => 5,
                'fallback_cb'     => false,
                'walker'          => new Foundation_Walker_Nav_Menu(),
            ) );

			?>
            </div>
		</div>
	</div>
</div>
