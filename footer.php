<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package EarlyZon
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">

			<div class="col-md-12 text-center">

				<div class="site-info">
					<a href="<?php echo site_url('submit')?>">Submit an early bird</a>
					<a href="<?php echo site_url('deals')?>">View all early birds</a>
					<a href="<?php echo site_url('upcoming-conferences')?>">Upcoming Conferences</a>
					<a href="<?php echo site_url('contact-us')?>">Contact us</a>
				</div><!-- .site-info -->

			</div>


		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
