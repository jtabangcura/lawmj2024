<?php global $blog;
	$big = 999999999; // need an unlikely integer

	$html = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    //recommended for pretty permalinks, but you could use 'format' => '?paged=%#%', if you prefer
	    'format' => '/page/%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $news->max_num_pages,
	    'prev_next' => false,
	    'mid_size' => 4
	) );

	//set your additional decorative elements

	//mimics the default for paginate_links()
	$pretext = 'Previous Page';
	$posttext = 'Next Page'; 

	//assuming this set of links goes at bottom of page
	$pre_deco = '<span id="bottom-deco-pre-link" class="deco-links">' . $pretext . '</span>';
	$post_deco = '<span id="bottom-deco-post-link" class="deco-links">' . $posttext . '</span>';

	 //key variable 
	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;

	//add decorative non-link to first page
	/*if ( 1 === $paged) {

	  $html = $pre_deco . $html;

	}

	//add decorative non-link to last page    
	if ( $news->max_num_pages ==  $paged   ) {

	  $html = $html . $post_deco; 

	}*/

	//may be helpful to create a larger containing div so...
	echo '<div id="pagination"><div class="container"><div class="row"><div class="col-sm-24 textCenter"><span class="pages">Pages</span>';

	echo $html;

	echo '</div></div></div></div>';
?>