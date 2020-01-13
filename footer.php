<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package ftek
 * @since ftek 2.0
 */
?>
	<footer id="page-footer">
		<div id="footer-contact">
			<h2><a href="<?= get_page_link(124) ?>" title="<?= get_the_title(124) ?>"><?= bloginfo('name') ?></a></h2>
			<dl>
				<div><dt><?= __('Org. no', 'ftek') ?></dt><dd>857208-8477</dd></div>
				<div><dt><?= __('Ansvarig utgivare', 'ftek') ?></dt><dd>Alexandru Golic</dd></div>
				<div><dt>E-mail</dt><dd><a href="mailto:info@ftek.se" target="_blank">info@ftek.se</a></dd></div>
				<div><dt><?= __('Visitor address', 'ftek') ?></dt><dd><a href="https://www.google.com/maps/place/Focus/@57.690859,11.9751408,19z/data=!4m5!3m4!1s0x464ff373530bf8cd:0xb31fc4afa7529106!8m2!3d57.6910046!4d11.975559" target="_blank">Focus, Kemivägen 11</a></dd></div>
				<div><dt><?= __('Mailing address', 'ftek') ?></dt><dd><a href="https://www.google.com/maps/place/Fysikgränd+3,+411+33+Göteborg/" target="_blank">Fysikgränd 3, 411 33 Göteborg</a></dd></div>
				<div><dt><a href="/kontakt"><?= __('Looking for someone?', 'ftek') ?></a></dt></div>
			</dl>
		</div>
		<div id="footer-djungle-saying">
			<p><a href="/dragos"><?= __(generate_footer_quote(), 'ftek') ?></a></p>
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
		<?php /* Contact page and privacy policy page */ ?>
			<p><a href="<?= get_page_link(23) ?>"><?= get_the_title(23) ?></a> | <a href="<?= get_page_link(6122) ?>"><?= get_the_title(6122) ?></a></p>
			<p><a href="/support">Support</a></p>
			<p>© <?= date("Y") ?> Fysikteknologsektionen<p>
		</div>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>
