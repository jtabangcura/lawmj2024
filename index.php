<?php get_header() ?>

<?php get_template_part('_inc/parts/banner') ?>

<?php if (!is_front_page()) : ?>
	<section id="row-0" class="page-row relative basic whiteBg">
		<div class="container">
			<div class="content">
				<div class="inner-content text-center">
					<?php the_content() ?>					
				</div>
			</div>
		</div>
	</section>
<?php endif ?>

<?php get_template_part('_inc/parts/rows') ?>

<?php get_footer() ?>