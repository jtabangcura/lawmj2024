</div><?php //end #content_wrapper ?>

<footer id="footer" class="lightGrayBg">
	<div class="container">
		
		<div class="d-md-flex justify-content-between footer-wrap">
			<div class="right text-right">
				
				<?php if (has_nav_menu('aux-nav')) : ?>
				<div class="menu-aux-nav-container">
					<ul id="menu-aux-footer-nav" class="menu d-flex align-items-center justify-content-end animate">
						<?php
						wp_nav_menu(array(
							'theme_location' => 'aux-nav',
							'items_wrap' => '%3$s',
							'container' => '',
							'depth' => '1',
						));
						?>
					</ul>
				</div><?php endif ?>

				<?php

				$address = get_field('mj_address','option');
				$map = get_field('mj_map','option');

				if ($address)
					echo '<div id="address">'.$address.'</div>';
					echo '<div id="map">'.$map.'</div>' ?>

			</div>
			<div class="left d-flex flex-column">

				<?php if (has_nav_menu('footer-nav')) : ?>
				<div class="menu-footer-nav-container">
					<ul id="menu-footer-nav" class="menu">
						<?php
						wp_nav_menu(array(
							'theme_location' => 'footer-nav',
							'items_wrap' => '%3$s',
							'container' => '',
						));

						?>
					</ul>
				</div><?php endif ?>

				<div id="footer-content">
					<?php the_field('mj_footer','option') ?>
				</div>

			</div>
		</div>

	</div>
</footer>

<div id="mediaJS"></div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-3473258-30', 'auto');
  ga('send', 'pageview');

</script>

<?php get_template_part('_inc/includes/scripts') ?>

<?php wp_footer() ?>

</body>
</html>