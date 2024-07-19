<section id="banner" class="relative darkgrayBg bgCover darkGrayBg"<?php if (!is_front_page()) : ?> style="background-image:url('<?php the_post_thumbnail_url('full') ?>')"<?php endif ?>>
	<div class="content-wrap absolute centerCenter text-center">
		<div class="container">
			<?php 
				if (is_front_page())
					the_content();
				else
					echo '<h1>'.get_the_title().'</h1>'
			?>
		</div>
	</div>
	<?php if (is_front_page()) : ?>
		<img class="parallax" src="<?php the_post_thumbnail_url('full') ?>" style="max-width: 100%" />
	<?php endif ?>
</section>
<?php if (is_front_page()) : ?>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/simple-parallax-js@5.6.1/dist/simpleParallax.min.js?ver=5.6.1" id="simple-parallax-js"></script>
<script>
	var image = document.getElementsByClassName('parallax');
	new simpleParallax(image,{orientation:'down'});
</script>
<style>
	@media (max-width: 768px) {
		#banner {background-image: url('<?php the_post_thumbnail_url('full') ?>')}
	}
</style>
<?php endif ?>