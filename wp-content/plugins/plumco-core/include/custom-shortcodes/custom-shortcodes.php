<?php
/* Spacer */
function plumco_spacer_function($atts, $content = true) {
  extract(shortcode_atts(array(
    "height" => '',
  ), $atts));

  $result = do_shortcode('[vc_empty_space height="'. $height .'"]');
  return $result;

}
add_shortcode("plumco_spacer", "plumco_spacer_function");

/* Social Icons */
function plumco_socials_function($atts, $content = true) {
  extract(shortcode_atts(array(
    "social_select" => '',
    "custom_class" => '',
    "section_title" => '',
    // Colors
    "icon_color" => '',
    "icon_hover_color" => '',
    "bg_color" => '',
    "bg_hover_color" => '',
    "border_color" => '',
    "icon_size" => '',
  ), $atts));

  // Shortcode Style CSS
  $e_uniqid       = uniqid();
  $inline_style   = '';

  // Colors & Size
  if ( $icon_color || $icon_size ) {
    $inline_style .= '.social-'. $e_uniqid .'.social ul li a {';
    $inline_style .= ( $icon_color ) ? 'color:'. $icon_color .';' : '';
    $inline_style .= ( $icon_size ) ? 'font-size:'. plumco_core_check_px($icon_size) .';' : '';
    $inline_style .= '}';
  }


  // add inline style
  plumco_add_inline_style( $inline_style );
  $styled_class  = ' social-'. $e_uniqid;

  $result = '<div class="social" '.esc_attr( $styled_class ).'><span>'.esc_html( $section_title ).'</span><ul>'. do_shortcode($content) .'</ul></div>';
  return $result;

}
add_shortcode("plumco_socials", "plumco_socials_function");

/* Social Icon */
function plumco_social_function($atts, $content = NULL) {
   extract(shortcode_atts(array(
      "social_link" => '',
      "social_icon" => '',
      "target_tab" => ''
   ), $atts));

   $social_link = ( isset( $social_link ) ) ? 'href="'. $social_link . '"' : '';
   $target_tab = ( $target_tab === '1' ) ? ' target="_blank"' : '';

   $result = '<li><a '. $social_link . $target_tab .'><i class="'. $social_icon .'"></i></a></li>';
   return $result;

}
add_shortcode("plumco_social", "plumco_social_function");



/* Simple Images */
function plumco_image_lists_function($atts, $content = true) {
  extract(shortcode_atts(array(
    "custom_class" => '',
  ), $atts));

  $result = '<ul class="simple-img '. $custom_class .'">'. do_shortcode($content) .'</ul>';
  return $result;

}
add_shortcode("plumco_image_lists", "plumco_image_lists_function");

/* Simple Image */
function plumco_image_list_function($atts, $content = NULL) {
  extract(shortcode_atts(array(
    "get_image" => '',
    "link" => '',
    "open_tab" => ''
  ), $atts));

  // Atts
  if ($get_image) {
    $my_image = ($get_image) ? '<img src="'. $get_image .'" alt=""/>' : '';
  } else {
    $my_image = '';
  }
  if ($link) {
    $open_tab = $open_tab ? 'target="_blank"' : '';
    $link_o = '<a href="'. $link .'" '. $open_tab .'>';
    $link_c = '</a>';
  } else {
    $link_o = '';
    $link_c = '';
  }

  $result = '<li>'. $link_o . $my_image . $link_c .'</li>';
  return $result;

}
add_shortcode("plumco_image_list", "plumco_image_list_function");

/* Simple Underline Link */
function plumco_simple_link_function($atts, $content = NULL) {
  extract(shortcode_atts(array(
    "link_style" => '',
    "link_icon" => '',
    "link_text" => '',
    "link" => '',
    "target_tab" => '',
    "custom_class" => '',
    // Normal
    "text_color" => '',
    "border_color" => '',
    // Hover
    "text_hover_color" => '',
    "border_hover_color" => '',
    // Size
    "text_size" => '',
  ), $atts));

  // Atts
  $target_tab = $target_tab ? 'target="_blank"' : '';
  if ($link_style === 'link-arrow-right') {
    $arrow_icon = $link_icon ? ' <i class="'. $link_icon .'"></i>' : ' <i class="fa fa-caret-right"></i>';
  } elseif ($link_style === 'link-arrow-left') {
    $arrow_icon = $link_icon ? ' <i class="'. $link_icon .'"></i>' : ' <i class="fa fa-caret-left"></i>';
  } else {
    $arrow_icon = '';
  }
  $link_style = $link_style ? $link_style. ' ' : 'link-underline ';

  // Shortcode Style CSS
  $e_uniqid       = uniqid();
  $inline_style   = '';

  // Colors & Size
  if ( $text_color || $text_size ) {
    $inline_style .= '.-simple-link-'. $e_uniqid .'.-'. $link_style .', .-simple-link-'. $e_uniqid .'.-link-arrow-left i, .-simple-link-'. $e_uniqid .'.-link-arrow-right i {';
    $inline_style .= ( $text_color ) ? 'color:'. $text_color .';' : '';
    $inline_style .= ( $text_size ) ? 'font-size:'. plumco_core_check_px($text_size) .';' : '';
    $inline_style .= '}';
  }
  if ( $text_hover_color ) {
    $inline_style .= '.-simple-link-'. $e_uniqid .'.-'. $link_style .':hover, .-simple-link-'. $e_uniqid .'.-link-arrow-right:hover, .-simple-link-'. $e_uniqid .'.-link-arrow-left:hover, .-simple-link-'. $e_uniqid .'.-link-arrow-right:hover i, .-simple-link-'. $e_uniqid .'.-link-arrow-left:hover i {';
    $inline_style .= ( $text_hover_color ) ? 'color:'. $text_hover_color .';' : '';
    $inline_style .= '}';
  }
  if ( $border_color ) {
    $inline_style .= '.-simple-link-'. $e_uniqid .'.-'. $link_style .':after {';
    $inline_style .= ( $border_color ) ? 'background-color:'. $border_color .';' : '';
    $inline_style .= '}';
  }
  if ( $border_hover_color ) {
    $inline_style .= '.-simple-link-'. $e_uniqid .'.-'. $link_style .':hover:after {';
    $inline_style .= ( $border_hover_color ) ? 'background-color:'. $border_hover_color .';' : '';
    $inline_style .= '}';
  }

  // add inline style
  plumco_add_inline_style( $inline_style );
  $styled_class  = ' -simple-link-'. $e_uniqid;

  $result = '<a href="'. $link .'" '. $target_tab .' class="-'. $link_style . $custom_class . $styled_class .'">'. $link_text . $arrow_icon .'</a>';
  return $result;

}
add_shortcode("plumco_simple_link", "plumco_simple_link_function");


/* Top bar info */
function plumco_widget_topbars_functions($atts, $content = true) {
   extract(shortcode_atts(array(
      "custom_class" => '',
   ), $atts));

   $result = '<div class="contact-intro'. $custom_class .'"><ul>'. do_shortcode($content) .'</ul></div>';
   return $result;

}
add_shortcode("plumco_widget_topbars", "plumco_widget_topbars_functions");

/* Top bar info */
function plumco_widget_topbar_function($atts, $content = NULL) {
   extract(shortcode_atts(array(
      "info_icon" => '',
      "subtitle" => '',
      "title" => '',
      "link" => '',
      "open_tab" => '',
   ), $atts));


   if ($link) {
      $open_tab = $open_tab ? 'target="_blank"' : '';
      $link_o = '<a href="'. $link .'" '. $open_tab .'>';
      $link_c = '</a>';
    } else {
      $link_o = '';
      $link_c = '';
    }

  $info_icon = $info_icon ? '<i class="'.esc_attr( $info_icon ).'"></i>' : '';

  $result = '<li>'.$info_icon.'<span>'.esc_html( $subtitle ).'</span>'.$link_o.''.esc_html( $title ).''.$link_c.'</li>';
   return $result;
}
add_shortcode("plumco_widget_topbar", "plumco_widget_topbar_function");


/*header Social */
function plumco_header_socials_function($atts, $content = true) {
   extract(shortcode_atts(array(
      "custom_class" => '',
      "custom_text" => ''
   ), $atts));

   $result = '<div class="social'. $custom_class .'"><ul class="clearfix"><li>'.esc_html( $custom_text ).'</li>'. do_shortcode($content) .'</ul></div>';
   return $result;

}
add_shortcode("plumco_header_socials", "plumco_header_socials_function");

/* Address Info */
function plumco_header_social_function($atts, $content = NULL) {
   extract(shortcode_atts(array(
      "social_icon" => '',
      "social_icon_color" => '',
      "social_link" => '',
      "target_tab" => ''
   ), $atts));

   // Color
   $social_icon_color = $social_icon_color ? 'color:'. $social_icon_color .';' : '';

   $social_link =  ( isset( $social_link ) ) ? $social_link : '#';
   $target_tab = ( $target_tab === 'yes' ) ? 'target="_blank"' : '';
   $social_icon = ( isset( $social_icon ) ) ? '<i class="'.esc_attr(  $social_icon ) .'" style="'. $social_icon_color .'"></i>' : '';

   $result = '<li><a href="'.esc_url( $social_link ).'" '.esc_attr( $target_tab ).'>'.$social_icon.'</a></li>';
   return $result;

}
add_shortcode("plumco_header_social", "plumco_header_social_function");


/*header Middle Info */
function plumco_header_menu_infos_function($atts, $content = true) {
   extract(shortcode_atts(array(
      "custom_class" => ''
   ), $atts));

   $result = '<div class="contact-info '. $custom_class .'"><ul>'. do_shortcode($content) .'</ul></div>';
   return $result;

}
add_shortcode("plumco_header_menu_infos", "plumco_header_menu_infos_function");

/*header Middle Info  */
function plumco_header_menu_info_function($atts, $content = NULL) {
   extract(shortcode_atts(array(
      "menu_text" => '',
      "menu_link" => ''
   ), $atts));

   $result = '<li><li><a href="'.esc_html( $menu_link ).'">'.esc_html( $menu_text ).'</a></li>';
   return $result;

}
add_shortcode("plumco_header_menu_info", "plumco_header_menu_info_function");
/*header Middle Info End */

/* Address Infos */
function plumco_address_infos_function($atts, $content = true) {
   extract(shortcode_atts(array(
      "custom_class" => ''
   ), $atts));

   $result = '<div class="-top-info '. $custom_class .'">'. do_shortcode($content) .'</div>';
   return $result;

}
add_shortcode("plumco_address_infos", "plumco_address_infos_function");

/* Address Info */
function plumco_address_info_function($atts, $content = NULL) {
   extract(shortcode_atts(array(
      "address_style" => '',
      "info_icon" => '',
      "info_icon_color" => '',
      "info_main_text" => '',
      "info_main_text_link" => '',
      "info_main_text_color" => '',
      "info_sec_text" => '',
      "info_sec_text_link" => '',
      "info_sec_text_color" => '',
      "target_tab" => ''
   ), $atts));

   // Color
   $info_icon_color = $info_icon_color ? 'color:'. $info_icon_color .';' : '';
   $info_main_text_color = $info_main_text_color ? 'color:'. $info_main_text_color .';' : '';
   $info_sec_text_color = $info_sec_text_color ? 'color:'. $info_sec_text_color .';' : '';

   $address_style = ( $address_style === 'style-two' ) ? '-ai-two' : '';
   $target_tab = ( $target_tab === '1' ) ? 'target="_blank"' : '';
   $info_icon = ( isset( $info_icon ) ) ? '<i class="'. $info_icon .'" style="'. $info_icon_color .'"></i>' : '';

   if (isset( $info_main_text ) && !$info_main_text_link ) {
      $info_main_text = '<span style="'. $info_main_text_color .'">'. $info_main_text .'</span>';
   } elseif (isset( $info_main_text ) && isset( $info_main_text_link )) {
      $info_main_text = '<span><a href="'. $info_main_text_link .'" '. $target_tab .'  style="'. $info_main_text_color .'">'. $info_main_text .'</a></span>';
   } else {
      $info_main_text = '';
   }
   if (isset( $info_sec_text ) && !$info_sec_text_link ) {
      $info_sec_text = '<p style="'. $info_sec_text_color .'">'. $info_sec_text .'</p>';
   } elseif (isset( $info_sec_text ) && isset( $info_sec_text_link )) {
      $info_sec_text = '<a href="'. $info_sec_text_link .'" '. $target_tab .' style="'. $info_sec_text_color .'">'. $info_sec_text .'</a>';
   } else {
      $info_sec_text = '';
   }

   $result = '<div class="-address-info '. $address_style .'">'. $info_icon .'<div class="-ai-content">'. $info_main_text . $info_sec_text .'</div></div>';
   return $result;

}
add_shortcode("plumco_address_info", "plumco_address_info_function");

/* Useful Links */
function plumco_useful_links_function($atts, $content = true) {
   extract(shortcode_atts(array(
      "column_width" => '',
      "custom_class" => ''
   ), $atts));

   $result = '<div class="topbar-link"><div class="contact-info"><ul class="useful-links '. $custom_class .' '. $column_width .'">'. do_shortcode($content) .'</ul></div></div>';
   return $result;

}
add_shortcode("plumco_useful_links", "plumco_useful_links_function");

/* Useful Link */
function plumco_useful_link_function($atts, $content = NULL) {
   extract(shortcode_atts(array(
      "target_tab" => '',
      "title_link" => '',
      "link_title" => ''
   ), $atts));

   $title_link = ( isset( $title_link ) ) ? 'href="'. $title_link . '"' : '';
   $target_tab = ( $target_tab === '1' ) ? 'target="_blank"' : '';

   $result = '<li><a '. $title_link . $target_tab .'>'. $link_title .'</a></li>';
   return $result;

}
add_shortcode("plumco_useful_link", "plumco_useful_link_function");

/* Footer Menus */
function plumco_footer_menus_function($atts, $content = true) {
   extract(shortcode_atts(array(
      "custom_class" => ''
   ), $atts));

   $result = '<div class="site-map"><ul class=" '. $custom_class .'">'. do_shortcode($content) .'</ul></div>';
   return $result;

}
add_shortcode("plumco_footer_menus", "plumco_footer_menus_function");

/* Footer Menu */
function plumco_footer_menu_function($atts, $content = NULL) {
   extract(shortcode_atts(array(
      "menu_title" => '',
      "menu_link" => '',
      "target_tab" => ''
   ), $atts));

   $menu_link = ( isset( $menu_link ) ) ? 'href="'. $menu_link . '"' : '';
   $target_tab = ( $target_tab === '1' ) ? 'target="_blank"' : '';

   $result = '<li><a '. $menu_link . $target_tab .'>'. $menu_title .'</a></li>';
   return $result;

}
add_shortcode("plumco_footer_menu", "plumco_footer_menu_function");

/* footer contact */
function plumco_footer_contacts_functions($atts, $content = true) {
   extract(shortcode_atts(array(
      "custom_class" => '',
   ), $atts));

   $result = '<div class="contact-ft"><ul>'. do_shortcode($content) .'</ul></div>';
   return $result;

}
add_shortcode("plumco_footer_contact_infos", "plumco_footer_contacts_functions");

/*  footer contact  */
function plumco_footer_contacts_function($atts, $content = NULL) {
   extract(shortcode_atts(array(
      "icon" => '',
      "item_title" => '',
   ), $atts));

   $result = '<li><i class="'.esc_attr( $icon ).'"></i>'.esc_html( $item_title ).'</li>';
   return $result;

}
add_shortcode("plumco_footer_contact_info", "plumco_footer_contacts_function");


 /* footer Address */
function plumco_addresss_functions($atts, $content = true) {
   extract(shortcode_atts(array(
      "custom_class" => '',
   ), $atts));
    $result = '<div class="address-widget '. $custom_class .'">'. do_shortcode($content) .'</div>';
   return $result;
}
add_shortcode("plumco_footer_address_item", "plumco_addresss_functions");


 /* footer Addresss */
function plumco_address_functions($atts, $content = NULL) {
   extract(shortcode_atts(array(
      "item" => '',
   ), $atts));

    $result = '<p>'.esc_html( $item ).'</p>';
    return $result;
}
add_shortcode("plumco_footer_address_items", "plumco_address_functions");

/* Blockquote */
function plumco_blockquote_function($atts, $content = true) {
  extract(shortcode_atts(array(
    "blockquote_style" => '',
    "text_size" => '',
    "custom_class" => '',
    "content_color" => '',
    "left_color" => '',
    "border_color" => '',
    "bg_color" => ''
  ), $atts));

  // Shortcode Style CSS
  $e_uniqid        = uniqid();
  $inline_style  = '';

  // Text Color
  if ( $text_size || $content_color || $border_color || $bg_color ) {
    $inline_style .= '.-blockquote-'. $e_uniqid .' {';
    $inline_style .= ( $text_size ) ? 'font-size:'. $text_size .';' : '';
    $inline_style .= ( $content_color ) ? 'color:'. $content_color .';' : '';
    $inline_style .= ( $border_color ) ? 'border-color:'. $border_color .';' : '';
    $inline_style .= ( $bg_color ) ? 'background-color:'. $bg_color .';' : '';
    $inline_style .= '}';
  }
  if ( $left_color ) {
    $inline_style .= '.-blockquote-'. $e_uniqid .':before {';
    $inline_style .= ( $left_color ) ? 'background-color:'. $left_color .';' : '';
    $inline_style .= '}';
  }

  // add inline style
  plumco_add_inline_style( $inline_style );
  $styled_class  = ' -blockquote-'. $e_uniqid;

  // Style
  $blockquote_style = ($blockquote_style === 'style-two') ? 'blockquote-two ' : '';

  $result = '<blockquote class="'. $blockquote_style . $custom_class . $styled_class .'">'. do_shortcode($content) .'</blockquote>';
  return $result;

}
add_shortcode("plumco_blockquote", "plumco_blockquote_function");


/* Footer Logo Items */
function plumco_widget_footer_infos_functions($atts, $content = true) {
   extract(shortcode_atts(array(
      "custom_class" => '',
      "footer_logo" => '',
      "desc" => '',
   ), $atts));

  $image_url = wp_get_attachment_url( $footer_logo );
  $image_alt = get_post_meta( $footer_logo, '_wp_attachment_image_alt', true);

   $result = '<div class="widget about-widget '. $custom_class .'">
       <div class="logo widget-title">
          <img src="'.esc_url( $image_url ).'" alt="'.esc_attr( $image_alt ).'">
       </div>
       <p>'.esc_html( $desc ).'</p>
       <div class="social-icons">
         <ul>'. do_shortcode($content) .'</ul>
       </div>
    </div>';
   return $result;

}
add_shortcode("footer_infos", "plumco_widget_footer_infos_functions");


/* Footer Logo Item */
function plumco_widget_footer_infos_function($atts, $content = NULL) {
   extract(shortcode_atts(array(
      "social_icon" => '',
      "social_link" => '',
   ), $atts));

   $result = '<li><a href="'.esc_url( $social_link ).'"><i class="'.esc_attr( $social_icon ).'"></i></a></li>';
   return $result;

}
add_shortcode("footer_info", "plumco_widget_footer_infos_function");


/* Contact Infos */
function plumco_widget_contact_infos_functions($atts, $content = true) {
   extract(shortcode_atts(array(
      "custom_class" => '',
      "heading_title" => ''
   ), $atts));

   $result = '<div class="contact-widget-inner '. $custom_class .'"><h3>'.esc_html( $heading_title ).'</h3><ul>'. do_shortcode($content) .'</ul></div>';
   return $result;

}
add_shortcode("plumco_widget_contact_infos", "plumco_widget_contact_infos_functions");


/* Widget Contact Info */
function plumco_widget_contact_infos_function($atts, $content = NULL) {
   extract(shortcode_atts(array(
      "custom_class" => '',
      "title" => '',
      "desc" => '',
      "image_url" => '',
      "link_text" => '',
      "link" => '',
   ), $atts));

    $image_url = wp_get_attachment_url( $image_url );
    $image_alt = get_post_meta( $image_url, '_wp_attachment_image_alt', true);

    if ( $image_url ) {
      $image_style = ' style="';
      $image_style .= ( $image_url ) ? 'background-image: url( '. $image_url .' );' : '';
      $image_style .= '"';
    } else {
      $image_style = '';
    }

   $result = '<div class="wpo-contact-widgets '.esc_attr( $custom_class ).'" '.wp_kses_post( $image_style ).' ><h2>'.esc_html( $title ).'</h2><p>'.esc_html( $desc ).'</p><a class="theme-btn" href="'.esc_url( $link ).'">'.esc_html( $link_text ).'</a></div>';
   return $result;

}
add_shortcode("plumco_widget_contact_info", "plumco_widget_contact_infos_function");


/* Widget Contact Info */
function plumco_widget_testimonial_function($atts, $content = NULL) {
   extract(shortcode_atts(array(
      "custom_class" => '',
      "title" => '',
      "subtitle" => '',
      "desc" => '',
      "image_url" => '',
   ), $atts));

    $image_url = wp_get_attachment_url( $image_url );
    $image_alt = get_post_meta( $image_url, '_wp_attachment_image_alt', true);

  
   $result = '<div class="testimonial-widget '.esc_attr( $custom_class ).'"><div class="quote"><p>'.esc_html( $desc ).'</p></div><div class="client"><img src="'.esc_url( $image_url ).'" alt="'.esc_attr( $image_alt ).'"><h4>'.esc_html( $title ).'</h4><p>'.esc_html( $subtitle ).'</p></div></div>';
   return $result;

}
add_shortcode("plumco_widget_testimonial", "plumco_widget_testimonial_function");


/* Service Contact Widgets */
function plumco_service_widget_contacts_functions($atts, $content = true) {
   extract(shortcode_atts(array(
      "custom_class" => '',
      "contact_title" => '',
   ), $atts));
   $result = '<div class="service-features-widget  '. $custom_class .'"><div><h3>'.esc_html( $contact_title ).'</h3><ol>'. do_shortcode($content) .'</ol></div></div>';
   return $result;

}
add_shortcode("plumco_service_widget_contacts", "plumco_service_widget_contacts_functions");

/* Service Contact Widget */
function plumco_service_widget_contact_functions($atts, $content = NULL) {
   extract(shortcode_atts(array(
      "info" => '',
   ), $atts));

   $result = '<li>'.esc_html( $info ).'</li>';
   return $result;
}
add_shortcode("plumco_service_widget_contact", "plumco_service_widget_contact_functions");

/* Download Widgets */
function plumco_download_widgets_functions($atts, $content = true) {
   extract(shortcode_atts(array(
      "custom_class" => '',
   ), $atts));
   $result = '<div class="download-widget '. $custom_class .'"><ul>'. do_shortcode($content) .'</ul></div>';
   return $result;

}
add_shortcode("plumco_download_widgets", "plumco_download_widgets_functions");

/* Download Widget */
function plumco_download_widget_functions($atts, $content = NULL) {
   extract(shortcode_atts(array(
      "download_icon" => '',
      "title" => '',
      "link" => '',
   ), $atts));

   $result = '<li><a href="'.esc_url( $link ).'"><i class="'.esc_attr( $download_icon ).'"></i>'.esc_html( $title ).'</a><li>';
   return $result;
}
add_shortcode("plumco_download_widget", "plumco_download_widget_functions");

/* Current Year - Shortcode */
if( ! function_exists( 'plumco_current_year' ) ) {
  function plumco_current_year() {
    return date('Y');
  }
  add_shortcode( 'plumco_current_year', 'plumco_current_year' );
}

/* Get Home Page URL - Via Shortcode */
if( ! function_exists( 'plumco_home_url' ) ) {
  function plumco_home_url() {
    return esc_url( home_url( '/' ) );
  }
  add_shortcode( 'plumco_home_url', 'plumco_home_url' );
}


/* About Widget */
function plumco_widget_about_block_function($atts, $content = NULL) {
   extract(shortcode_atts(array(
      "custom_class" => '',
      "title" => '',
      "image_url" => '',
      "desc" => '',
      "link_text" => '',
      "link" => '',
   ), $atts));

    $image_url = wp_get_attachment_url( $image_url );
    $image_alt = get_post_meta( $image_url, '_wp_attachment_image_alt', true);
   
   $result = '<div class="about-widget  '.esc_attr( $custom_class ).'"><div class="img-holder"><img src="'.esc_url( $image_url ).'" alt="'.esc_attr( $image_alt ).' "></div><h4>'.esc_html( $title ).'</h4><p>'.esc_html( $desc ).'</p><a href="'.esc_url( $link ).'">'.esc_html( $link_text ).'</a></div>';
   return $result;

}
add_shortcode("plumco_about_widget", "plumco_widget_about_block_function");