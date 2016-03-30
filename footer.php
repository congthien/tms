<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tsm
 */

?>


	</div><!-- #content -->



	<!-- Site Footer -->
	<div class="site-footer parallax parallax3" >
		<div class="container">
				<div class="row">
							<div class="col-md-5 col-sm-6">
									<?php dynamic_sidebar( 'footer-1' ); ?>
							</div>

							<div class="col-md-3 col-md-offset-1 col-sm-3">
									<?php dynamic_sidebar( 'footer-2' ); ?>
							</div>
							<div class="col-md-3 col-sm-3">
									<?php dynamic_sidebar( 'footer-3' ); ?>
							</div>
					</div>
			</div>
	</div>
	<!-- Site Footer -->
	<div class="site-footer-bottom">
			<div class="container">
					<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="copyrights-col-left">
										<p><?php printf( __( get_theme_mod( 'tms_footer_copy_right' ) ) ); ?></p>
									</div>
							</div>
							<div class="col-md-6 col-sm-6"></div>

							<div class="copyrights-col-right">
								<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'footer-menu' ) ); ?>
							</div>
					</div>
			</div>
	</div>
	<a id="back-to-top"><i class="fa fa-angle-double-up"></i></a>




</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
