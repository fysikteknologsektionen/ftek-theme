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
	<footer id="page-footer">
		<address id="footer-contact">
			<ul>
				<li>Fysikteknologsektionen</li>
				<li><?= __('Org. no', 'ftek') ?>: 857208-8477</li>
				<li>Email: <a href="mailto:info@ftek.se" target="_blank">info@ftek.se</a></li>
				<li><?= __('Visitor adress', 'ftek') ?>: <a href="https://www.google.com/maps/place/Focus/@57.690859,11.9751408,19z/data=!4m5!3m4!1s0x464ff373530bf8cd:0xb31fc4afa7529106!8m2!3d57.6910046!4d11.975559" target="_blank">Focus, Kemivägen 11, 412 58 Göteborg</a></li>
				<li><?= __('Mailing adress', 'ftek') ?>: <a href="https://www.google.com/maps/place/Fysikgränd+3,+411+33+Göteborg/" target="_blank">Fysikgränd 3, 411 33 Göteborg</a></li>
				<li><a href="/kontakt"><?= __('Looking for someone?', 'ftek') ?></a></li>
			</ul>
		</address>
		<div id="footer-djungle-saying">
			<p><a href="/sektionshelgon"><?= generate_footer_quote() ?></a></p>
		</div>
		<div id="footer-chs-logo">
			<a href="https://chalmersstudentkar.se"><img id="chs-logo" src="<?php bloginfo('stylesheet_directory'); ?>/images/chalmers.svg" /></a>
		</div>
		<div id="footer-development">
			<p><?=__('Development', 'ftek')?>: Pontus Granström</p>
			<p><?=__('Development and design', 'ftek')?>: <a href="https://github.com/JohanWinther" target="_self">Johan Winther</a></p>
			<p><?=__('Maintenance and development', 'ftek')?>: <a href="/spidera/">Spidera</a></p>
		</div>
		<div id="footer-copyright">
			<p><a href="/support">Support</a></p>
			<p>© 2018 Fysikteknologsektionen<p>
		</div>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>
