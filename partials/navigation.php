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
<nav class="top-bar show-for-small-only">
	<section class="top-bar-title">
		<a href="<?php esc_attr_e( home_url() ); ?>">
			<?php if ( ! empty( $logo ) ) : ?>
				<img src="<?php esc_attr_e( $options['logo_upload'] ); ?>"
				     alt="<?php esc_attr_e( bloginfo( 'name' ) ); ?>"/>
			<?php else : ?>
				<?php bloginfo( 'name' ); ?>
			<?php endif; ?>
		</a>
	</section>

	<section class="top-bar-right">
		<a class="right-off-canvas-toggle menu-icon" data-toggle="offCanvas"><span></span></a>
	</section>
</nav>

<div id="main-menu" class="show-for-medium-up" data-parent="<?php esc_attr_e( $post->post_type ); ?>">
	<div class="top-bar" data-topbar="">
		<div class="top-bar-title">
			<a href="<?php esc_attr_e( home_url() ); ?>">
				<?php if ( ! empty( $logo ) ) : ?>
					<img src="<?php esc_attr_e( $options['logo_upload'] ); ?>"
					     alt="<?php esc_attr_e( get_bloginfo( 'name' ) ); ?>" />
				<?php else : ?>
					<?php bloginfo( 'name' ); ?>
				<?php endif; ?>
			</a>
		</div>

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
