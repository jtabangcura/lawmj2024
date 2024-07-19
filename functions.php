<?php

// theme setup
add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup(){
  load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'html5', array( 'search-form' ) );
}

@ini_set( 'upload_max_size' , '24M' );
@ini_set( 'post_max_size', '24M');
@ini_set( 'max_execution_time', '300' );

// add custom styles
function cstyles(){
  wp_enqueue_style( 'bootstrap-grid24','//cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css', false, '5.0.1',false);
  wp_enqueue_style( 'slick','//cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.7/themes/odometer-theme-default.min.css', false, '0.4.7',false);
  wp_enqueue_style( 'select2','//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css', false, '4.0.13',false);
  wp_enqueue_style( 'scrollbar','//cdnjs.cloudflare.com/ajax/libs/jquery.scrollbar/0.2.11/jquery.scrollbar.min.css', false, '0.2.11',false);
  wp_enqueue_style( 'animate','//cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', false, '4.1.1',false);
  wp_enqueue_style( 'build',  get_template_directory_uri() . '/_inc/css/build.css', false, '',false);
}
add_action( 'wp_enqueue_scripts', 'cstyles' );

// add custom scripts
function cscripts() {
  wp_enqueue_script( 'jquery','//code.jquery.com/jquery-3.7.0.slim.min.js', false, '3.7.0', true );  
  wp_enqueue_script( 'bootstrap','//cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js', false, '5.0.1', true);
  wp_enqueue_script( 'slick','//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', false, '1.8.1', true);
  wp_enqueue_script( 'select2','//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', false, '4.0.13', true);
  wp_enqueue_script( 'wow','//cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', false, '0.2.11', true);

}
add_action( 'wp_enqueue_scripts', 'cscripts' );

//svg support
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

//menus
function register_menus() {
  register_nav_menus(
    array(
      'main-nav' => __( 'Main Nav' ),
      'aux-nav' => __( 'Aux Nav' ),
      'footer-nav' => __( 'Footer Nav' ),
    )
  );
}
add_action( 'init', 'register_menus' );

//post type selector in ACF
add_action( 'acf/register_fields', 'my_register_fields' );

function my_register_fields() {

  include_once( 'acf-post-type-selector/acf-post-type-selector.php' );

}

//enable excerpt
add_action( 'init', 'enable_excerpts' );
function enable_excerpts() {
   add_post_type_support( 'page', 'excerpt' );
}
function my_excerpt_length($length){ 
  return 100;
}
add_filter('excerpt_length', 'my_excerpt_length');

//custom pagination
function custom_pagination( $paged = '', $max_page = '' ) {
  $big = 999999999; // need an unlikely integer
  if( ! $paged ) {
    $paged = get_query_var('paged');
  }

  if( ! $max_page ) {
    global $wp_query;
    $max_page = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
  }

  echo '<div id="pagination" class="wow fadeIn" data-wow-delay="1s">'.paginate_links( array(
    'base'       => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format'     => '?paged=%#%',
    'current'    => max( 1, $paged ),
    'total'      => $max_page,
    'mid_size'   => 3,
    'prev_text'  => __( '<i class="fa-solid fa-chevron-left"></i><span>Previous</span>' ),
    'next_text'  => __( '<span>Next</span><i class="fa-solid fa-chevron-right"></i>' ),
    'type'       => 'list'
  ) ).'</div>';
}

// remove prefix from archive title
add_filter( 'get_the_archive_title', function ($title) {    
if ( is_category() ) {    
        $title = single_cat_title( '', false );    
    } elseif ( is_tag() ) {    
        $title = single_tag_title( '', false );    
    } elseif ( is_author() ) {    
        $title = '<span class="vcard">' . get_the_author() . '</span>' ;    
    } elseif ( is_tax() ) { //for custom post types
        $title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title( '', false );
    }
return $title;    
});

// add category to <body> class
add_filter('body_class','add_category_to_single');
function add_category_to_single($classes) {
  if (is_single() ) {
    global $post;
    foreach((get_the_category($post->ID)) as $category) {
      // add category slug to the $classes array
      $classes[] = $category->category_nicename;
    }
  }
  // return the $classes array
  return $classes;
}

//get page id
function getPageID() {
  global $post;
  if (is_home())
    $pageID = get_option('page_for_posts');
  else
    $pageID = $post->ID;
  return $pageID;
}

//current year shortcode for footer
function current_year( $atts ){
  return date('Y');
}
add_shortcode( 'current_year', 'current_year' );

//page title shortcode
function page_title( $atts ){
  return get_the_title();
}
add_shortcode( 'page_title', 'page_title' );

//get template
add_action('wp_head', 'show_template');
function show_template() {
    global $template;
    return basename($template);
}

////////////////////////////////////////////////////////////////////////////////
// Body class adding page-parent
//
function cc_body_class( $classes ) {
  global $post;
  if ( is_page() ) {
    // Has parent / is sub-page
    if ( $post->post_parent ) {
      # Parent post name/slug
      $parent = get_post( $post->post_parent );
      $classes[] = 'section-'.$parent->post_name;
      // Parent template name
      $parent_template = get_post_meta( $parent->ID, '_wp_page_template', true);
      if ( !empty($parent_template) )
      $classes[] = 'section-template-'.sanitize_html_class( str_replace( '.', '-', $parent_template ), '' );
    }
  }
  return $classes;
}
add_filter( 'body_class', 'cc_body_class' );

/*
* Customize the default color palette for TinyMce editor
*/
function wpr_custom_color_tinymce( $options ) {
    $options['textcolor_map'] = json_encode(
        array(
            'e92c0c','Red',
            '1fc9be','Teal',
            'f6f6f6','Silver',
            'ebebeb','Light Gray',
            '939393','Gray',
            '3c4c57','Dark Gray',
            '202f39','Black',
        )
    );
    return $options;
}
add_filter( 'tiny_mce_before_init', 'wpr_custom_color_tinymce' );

//text-scroll shortcode
function textScroll( $a ) {
  $a = shortcode_atts( array(
    'text' => 'text1|text2|text3'
  ), $a );
  return '<span class="text-scroll"><span class="scroll"><span>'.str_replace('|','</span><span>', $a['text']).'</span></span></span>';
}
add_shortcode('text-scroll','textScroll');

//cta shortcode
function cta_sc( $a ) {
  $a = shortcode_atts( array(
    'url' => '#',
    'text' => 'Learn More',
    'new-tab' => 'no'
  ), $a );
  $output = "<div class=\"clear\"></div><a href=\"{$a['url']}\" class=\"relative cta-btn\"";
  if ($a['new-tab'] == 'yes') { $output .= " target=\"_blank\""; }
  $output .= ">{$a['text']}</a>";
  return $output;
}
add_shortcode('cta','cta_sc');

//php cta function
function cta($text = 'Learn More', $url = false) {
  echo '<a class="relative cta-btn" href="'.$url.'">'.$text.'</a>';
}

//php cta_nolink function
function cta_nolink($text = 'Learn More') {
  echo '<span class="relative cta-btn">'.$text.'</a>';
}

//remove <p> from around images
function img_unautop($pee) {
  $pee = preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '<div class="figure">$1</div>', $pee);
  return $pee;
}
add_filter( 'acf_the_content', 'img_unautop', 30 );

//display news category depending on whether or not more than one category is selected and if a primary category has been selected with the Yoast SEO plugin
function newsCat() {

  $newsCat = get_the_category();

  $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id());
  $wpseo_primary_term = $wpseo_primary_term->get_primary_term();

  if (class_exists('WPSEO_Primary_Term') && $wpseo_primary_term != '')
    echo get_term( $wpseo_primary_term )->name;
  else
    echo $newsCat[0]->name;

}

// Removes comments from admin menu
add_action( 'admin_menu', 'pk_remove_admin_menus' );
function pk_remove_admin_menus() {
  remove_menu_page( 'edit-comments.php' );
}
add_action( 'wp_before_admin_bar_render', 'pk_remove_comments_admin_bar' );
function pk_remove_comments_admin_bar() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('comments');
}

//check if page has children
function has_children() {
  global $post;
  return count( get_posts( array('post_parent' => $post->ID, 'post_type' => $post->post_type) ) );
}

// Remove p tags from images, scripts, and iframes.
function unwrap_media($content) {
  $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
  $content = preg_replace('/<p>\s*(<iframe.*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
  $content = preg_replace('/<p>\s*(<figure.*>*.<\/figure>)\s*<\/p>/iU', '\1', $content);
  return $content;
}
add_filter('the_content','unwrap_media');

// when wp_trim_words doesn't work
function limit_text($text, $limit) {
  if (str_word_count($text, 0) > $limit) {
    $words = str_word_count($text, 2);
    $pos   = array_keys($words);
    $text  = substr($text, 0, $pos[$limit]) . '...';
  }
  return $text;
}


?>