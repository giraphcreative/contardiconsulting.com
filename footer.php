<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
$admin_email = get_option( 'admin_email' );
?>
	
	</section>
	
	<footer class="footer">
		<div class="column first">
			<?php print apply_filters( 'the_content', get_option( 'pure_address' ) ); ?>
		</div>
		<div class="column">
			<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'nav-menu' ) ); ?>
		</div>
		<!--
		<div class="column">
			<form name="subscribe" action="/subscribe">
				<label>Keep in Touch.<input type="text" name="email" value="" placeholder="Email Address" /></label>
				<input type="submit" name="submit" value="Subscribe" />
			</form>
		</div>
		-->
		<p class="copyright">Copyright &copy; <?php print date( 'Y' ) ?> Contardi Consulting. All Rights Reserved.</p>
	</footer>

</div><!-- #container -->

<?php wp_footer(); ?>
</body>
</html>