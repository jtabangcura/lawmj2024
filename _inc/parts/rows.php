<?php

wp_reset_query(); wp_reset_postdata();

if (is_home()||is_single())
	$pID = get_option('page_for_posts');
else
	$pID = get_the_ID();

if (have_rows('mj_rows',$pID)) :

	$rowCount = count(get_field('mj_rows',$pID));

	$rowTypes = array();

	while (have_rows('mj_rows',$pID)) : the_row();
		$rowTypes[] = get_sub_field('row_details')['type'];
	endwhile;

	if (get_field('mj_page_css')) :
		echo '<style>'.get_field('mj_page_css').'</style>';
	endif;

while (have_rows('mj_rows',$pID)) : the_row();


//////////


$rN = get_row_index();
$rType = get_sub_field('row_details')['type'];
$row = get_sub_field('row');

if ($rType == 'widget') :

	$post = $row['row_widget'][0];

	setup_postdata($post);

	$wg = get_field('mj_widget');

	$rType = $wg['row_details']['type'];
	$rAnchor = $wg['row_details']['anchor'];
	$rShow = $wg['row_details']['show'];
	$row = $wg['row'];
	$rCTA = $row['row_ctas'];

else :

	$rAnchor = get_sub_field('row_details')['anchor'];
	$rShow = get_sub_field('row_details')['show'];
	$rCTA = $row['row_ctas'];

endif;

$bgColor = $row['row_bg_color'];
$bgDesktop = $row['row_bg']['desktop'];
$bgMobile = $row['row_bg']['mobile'];



if ($rShow === true) :
//////////


echo '<section
				id="row-'.$rN.'"
				class="
					page-row relative '.$rType. ' '.$bgColor.'Bg';

					if ($rType == 'basic' && $row['row_image']['image']) echo ' has-image';

					if ($rType == 'team') echo ' type-'.$row['row_team_style'];

					if ($bgDesktop||$bgMobile) echo ' has-bg bgCover';

					if ($rowCount == $rN) echo ' last';
					if ($rN == 1) echo ' first';

	echo '" style="z-index: '.$rN.'">';

				if ($rAnchor) echo '<div id="'.$rAnchor.'" class="anchor absolute"></div>';

				if ($bgDesktop||$bgMobile) :

					if ($bgDesktop&&!$bgMobile)
						echo '<style>#row-'.$rN.'{background-image:url('.$bgDesktop['url'].')}</style>';
					elseif (!$bgDesktop&&$bgMobile)
						echo '<style>#row-'.$rN.'{background-image:url('.$bgMobile['url'].')}</style>';
					else
						echo '<style>#row-'.$rN.'{background-image:url('.$bgDesktop['url'].')}@media (max-width: 768px) {#row-'.$rN.'{background-image:url('.$bgMobile['url'].')}}</style>';

				endif;

				///// ROW CONTENT /////
				get_template_part('_inc/parts/rows/'.$rType);
				///// end ROW CONTENT /////

				if ($rCTA) :

					echo '<div class="cta-wrap text-center d-flex align-items-center justify-content-center flex-wrap">';
						foreach ($rCTA as $cta)
							cta($cta['cta']['title'],$cta['cta']['url']);
					echo '</div>';

				endif;

echo '</section>';


//////////
endif; wp_reset_query();



endwhile; endif;

$rN = null;
$rType = null;
$row = null;

$rAnchor = null;
$rShow = null;
$rCTA = null;

$bgColor = null;
$bgDesktop = null;
$bgMobile = null;

?>