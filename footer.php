<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package ftek
 * @since ftek 0.1
 */
?>

<div class="push-footer"></div>
<!-- #page -->
	<footer id="page-footer">
		<div id="footer-container">
	    	<a href="http://chs.chalmers.se"><img id="chs-logo" src="<?php bloginfo('stylesheet_directory'); ?>/images/chalmers.svg" /></a>
	    	<div id="footer-djungle-saying">
	    	    <?= generate_footer_quote() ?>
	    	</div>
	    	<div id="colophon">
	    	    <p>
	    	        Design och grundutveckling: Pontus Granström
	    	    </p>
	    	    <p>
	    	        Underhåll och utveckling: Spidera
	    	    </p>
	    	    <p>
	    	    	<a href="https://www.ftek.se/spidera/support">Är något trasigt?</a>
	    	    </p> 
	    	</div>
		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
