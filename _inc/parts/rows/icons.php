<?php

$rN = get_row_index();
$pID = getPageID();

if (get_post_type() == 'widget'):
  $widget = get_field('mj_widget');
  $row = $widget['row'];
else :
  $row = get_sub_field('row',$pID);
endif;

$content = $row['row_content'];
$icons = $row['row_icons'];

?>

<div class="container">

	<div class="content content-<?php if ($align) echo $align; else echo 'center' ?>">
			<div class="inner-content text-center"><?php echo $content ?></div>
		</div>

	<?php if ($icons) : ?>
		<div class="icons d-md-flex align-items-start justify-content-center flex-wrap">
			<?php foreach ($icons as $icon) : ?>

				<div class="icon text-center">
					<<?php if ($icon['cta']) echo 'a'; else echo 'div' ?> class="block icon-wrap" <?php if ($icon['cta']) echo 'href="'.$icon['cta']['url'].'"' ?>>
						<span class="block relative square circle animate">
							<span class="block absolute vCenter svg"><?php echo $icon['icon'] ?></span>
						</span>
					</<?php if ($icon['cta']) echo 'a'; else echo 'div' ?>>
					<h3><?php echo $icon['heading'] ?></h3>
					<p class="caption"><?php echo $icon['caption'] ?></p>
				</div>

			<?php endforeach ?>
		</div>
	<?php endif ?>

</div>