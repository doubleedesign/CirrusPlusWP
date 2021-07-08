	<footer class="footer site-footer">
		<div class="site-footer__main">
			<div class="content row">
				<nav class="col-xs-12 col-lg-grow">
					<?php
					wp_nav_menu(array(
						'theme_location' 	=> 'footer-menu',
						'menu_id' 			=> 'footer-menu',
						'menu_class' 		=> 'footer-nav row',
						'container'			=> false,
						'fallback_cb'		=> false,
						'depth'				=> 2, // depth of 1 will be a straightforward list;
													// depth of 2 will automatically lay out as columns with hierarchical styling.
													// See inc/setup/menus and scss/layout/_footer.scss to adjust.
					)); ?>
				</nav>
				<div class="footer-contact col-xs-12 col-lg-shrink">
					<h2>Contact Us</h2>
					<?php echo doublee_address('expanded'); ?>
				</div>
			</div>
		</div>
		<div class="site-footer__fineprint">
			<div class="content row">
				<small class="col-6">Content copyright &copy; 2021 Client Name.</small>
				<small class="col-6">Website by <a href="https://www.doubleedesign.com.au" target="_blank">Double-E Design</a>.</small>
			</div>
		</div>
	</footer>
</div> <!-- end wrapper -->
<?php wp_footer(); ?>
</body>
</html>