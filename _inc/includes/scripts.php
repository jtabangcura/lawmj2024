<script>

jQuery(document).ready(function($) {

//new WOW().init();

//add scrolled class
$(window).scroll(function() {    
  var scroll = $(window).scrollTop();
  if (scroll >= 50) {
    $('#header').addClass('scrolled');
  } else {
    $('#header').removeClass('scrolled');
  }
});
$(document).on('load',function() {    
  var scroll = $(window).scrollTop();
  if (scroll === 0) {
    $('#header').removeClass('scrolled');
  } else {
    $('#header').addClass('scrolled');
  }
});

//mobile nav
jQuery('#nav-toggle .open-nav').on('click', function() {
  jQuery(this).closest('#header').addClass('active');
});
jQuery('#nav-toggle .close-nav').on('click', function() {
  jQuery(this).closest('#header').removeClass('active');
});
jQuery('#header ul > li > .toggle > .openSubNav').on('click',function() {
  jQuery(this).closest('ul').find('li').removeClass('active');
  jQuery(this).closest('li').addClass('active');
});
jQuery('#header .closeSubNav').on('click',function() {
  jQuery(this).closest('ul').find('li').removeClass('active');
});

// remove href from # links
jQuery('#header .navs a[href="#"]').each(function() {
  jQuery(this).removeAttr('href').parent().addClass('no-link');
});

//check for empty form fields
jQuery('textarea').addClass('empty').on('change focusout', function() {
  if (jQuery(this).val() == '') jQuery(this).addClass('empty');
  else jQuery(this).removeClass('empty');
}).on('focusin', function() {
  jQuery(this).removeClass('empty');
});

// Open all PDFs or urls that don't belong to our domain in a new window or tab
jQuery('a[href^="http"]:not([data-lity],[data-lity-close])').each(function() {
  var a = new RegExp('/' + window.location.host + '/');
  if(!a.test(this.href)) {
    $(this).click(function(event) {
      event.preventDefault();
      event.stopPropagation();
      window.open(this.href, '_blank');
    });
  }
});

});//endjquery

///// CUSTOM SCRIPTS HERE /////
jQuery(document).ready(function($) {

  //check for embedded videos
  jQuery('iframe').each(function() {
    var src = jQuery(this).attr('src');
    var vimeo = 'player.vimeo.com';
    var youtube = 'youtube.com';
    if(src.indexOf(vimeo) != -1 || src.indexOf(youtube) != -1){
      jQuery(this).addClass('block absolute cover');
      jQuery(this).wrap('<div class="video-wrap relative"></div>');
    }
  });

  //select2
  jQuery('select').each(function() {
    var select = jQuery(this);
    select.select2({
      placeholder: select.find('option:first-child').text(),
      minimumResultsForSearch: Infinity,
      //allowClear: true,
      dropdownParent: select.parent()
    });
  });

  //custom radio buttons
  jQuery('.gform-field-label').on('click',function() {
    var radBoxID = jQuery(this).attr('for');
    var radBox = jQuery('#'+radBoxID);
    if (radBox.prop('checked') == true) {
      //alert("Checkbox is checked.");
    }
    else if(radBox.prop('checked') == false){
      //alert("Checkbox is unchecked.");
    }
  });

});

</script>