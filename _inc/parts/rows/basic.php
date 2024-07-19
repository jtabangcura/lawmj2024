<?php

$pID = getPageID();

if (get_post_type() == 'widget'):
  $widget = get_field('mj_widget');
  $row = $widget['row'];
else :
  $row = get_sub_field('row',$pID);
endif;

$content = $row['row_content'];
$image = $row['row_image'];
$align = $row['row_content_align'];

?>

<div class="container">

	<div class="content content-<?php if ($align) echo $align; else echo 'center' ?>">
		<div class="inner-content text-left"><?php echo $content ?></div>
	</div>

</div>