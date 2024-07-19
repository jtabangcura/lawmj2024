<?php

$pID = getPageID();
$rN = get_row_index();

if (get_post_type() == 'widget'):
  $widget = get_field('mj_widget');
  $row = $widget['row'];
else :
  $row = get_sub_field('row',$pID);
endif;

$content = $row['row_content'];
$accordion = $row['row_accordion'];

?>

<div class="container">

	<div class="content content-center">
		<div class="inner-content text-center"><?php echo $content ?></div>
	</div>

	<?php if ($accordion) : $aN = 0 ?>

		<div class="accordion" id="accordion-<?php echo $rN ?>">

			<?php foreach ($accordion as $acc) : ?>

				<?php

				$aN++;

				$head = $acc['heading'];
				$slug = sanitize_title($head);
				$body = $acc['content'];

				?>

			  <div class="accordion-item">
			    <h3 class="accordion-header" id="heading-<?php echo $slug ?>">
			      <button class="accordion-button<?php if ($aN != 1) echo ' collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $slug ?>" aria-expanded="<?php if ($aN == 1) echo 'true'; else echo 'false' ?>" aria-controls="<?php echo $slug ?>">
			        <?php echo $head ?>
			      </button>
			    </h3>
			    <div id="<?php echo $slug ?>" class="accordion-collapse collapse<?php if ($aN == 1) echo ' show' ?>" aria-labelledby="heading-<?php echo $slug ?>" data-bs-parent="#accordion-<?php echo $rN ?>">
			      <div class="accordion-body">
			        <?php echo $body ?>
			      </div>
			    </div>
			  </div>

			<?php endforeach ?>

		</div>

	<?php endif ?>

</div>