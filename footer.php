<?php
/**
 * Footer Template
 *
 * All stuff that should typically be in the footer.
 *
 * @since 1.0.0
 *
 * @package 
 * @subpackage Templates
 */

?>

				</section>

				<?php
				/** This action is documented in includes/Linchpin/hatch-hooks.php */
				do_action( 'rebar_footer_before' ); ?>

				<footer id="footer">
					<div class="main-footer container small">
						<?php
						/** This action is documented in includes/Linchpin/hatch-hooks.php */
						do_action( 'rebar_main_footer_inner_before' ); ?>

						<div class="row">
							<div class="small-12 columns">

								<?php dynamic_sidebar( 'footer-widgets' ); ?>

							</div>
						</div>

						<?php
						/** This action is documented in includes/Linchpin/hatch-hooks.php */
						do_action( 'rebar_main_footer_inner_after' ); ?>
					</div>

					<div class="sub-footer container small">
						<?php
						/** This action is documented in includes/Linchpin/hatch-hooks.php */
						do_action( 'rebar_sub_footer_inner_before' ); ?>

						<div class="row">
							<div class="small-12 medium-6 columns">
								<?php
									wp_nav_menu( array(
										'container'       => false,
										'container_class' => '',
										'menu'            => '',
										'menu_class'      => 'social menu',
										'theme_location'  => 'social',
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

							<div class="small-12 medium-6 columns text-right">
								<?php echo sprintf( '&copy; %s %s. All Rights Reserved.', date( 'Y' ), __( get_bloginfo( 'name' ), 'sjm' ) ); ?>
							</div>
						</div>

						<?php
						/** This action is documented in includes/Linchpin/hatch-hooks.php */
						do_action( 'rebar_sub_footer_inner_after' ); ?>
					</div>
				</footer>

				<?php
				/** This action is documented in includes/Linchpin/hatch-hooks.php */
				do_action( 'rebar_footer_after' ); ?>

				<a class="exit-off-canvas"></a>

				<?php
				/** This action is documented in includes/Linchpin/hatch-hooks.php */
				do_action( 'rebar_layout_end' ); ?>

			</div>
		</div>

		<?php wp_footer(); ?>

		<?php
		/**
		 * Additional Footer Scripts is attached to this action
		 * If this action is removed from your Additional Footer Scripts
		 * area within the Theme Settings will no longer print to the
		 * front end of your theme
		 *
		 *
		 */
		/** This action is documented in includes/Linchpin/hatch-hooks.php */
		do_action( 'rebar_body_before_close' ); ?>
	</body>
</html>
