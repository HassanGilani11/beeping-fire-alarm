<?php
/*
 * All Front-End Helper Functions
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

/* Exclude category from blog */
if( ! function_exists( 'plumco_excludecat' ) ) {
  function plumco_excludecat($query) {
  	if ( $query->is_home ) {
  		$exclude_cat_ids = cs_get_option('theme_exclude_categories');
  		if($exclude_cat_ids) {
  			foreach( $exclude_cat_ids as $exclude_cat_id ) {
  				$exclude_from_blog[] = '-'. $exclude_cat_id;
  			}
  			$query->set('cat', implode(',', $exclude_from_blog));
  		}
  	}
  	return $query;
  }
  add_filter('pre_get_posts', 'plumco_excludecat');
}

/* Excerpt Length */
class Plumco_Excerpt {

  // Default length (by WordPress)
  public static $length = 55;

  // Output: plumco_excerpt('short');
  public static $types = array(
    'short' => 25,
    'regular' => 55,
    'long' => 100
  );

  /**
   * Sets the length for the excerpt,
   * then it adds the WP filter
   * And automatically calls the_excerpt();
   *
   * @param string $new_length
   * @return void
   * @author Baylor Rae'
   */
  public static function length($new_length = 55) {
    Plumco_Excerpt::$length = $new_length;
    add_filter('excerpt_length', 'Plumco_Excerpt::new_length');
    Plumco_Excerpt::output();
  }

  // Tells WP the new length
  public static function new_length() {
    if( isset(Plumco_Excerpt::$types[Plumco_Excerpt::$length]) )
      return Plumco_Excerpt::$types[Plumco_Excerpt::$length];
    else
      return Plumco_Excerpt::$length;
  }

  // Echoes out the excerpt
  public static function output() {
    the_excerpt();
  }

}

// Custom Excerpt Length
if( ! function_exists( 'plumco_excerpt' ) ) {
  function plumco_excerpt($length = 55) {
    Plumco_Excerpt::length($length);
  }
}

if ( ! function_exists( 'plumco_new_excerpt_more' ) ) {
  function plumco_new_excerpt_more( $more ) {
    return ' ';
  }
  add_filter('excerpt_more', 'plumco_new_excerpt_more');
}

/* Tag Cloud Widget - Remove Inline Font Size */
if( ! function_exists( 'plumco_tag_cloud' ) ) {
  function plumco_tag_cloud($tag_string){
    return preg_replace("/style='font-size:.+pt;'/", '', $tag_string);
  }
  add_filter('wp_generate_tag_cloud', 'plumco_tag_cloud', 10, 3);
}

/* Password Form */
if( ! function_exists( 'plumco_password_form' ) ) {
  function plumco_password_form( $output ) {
    $output = str_replace( 'type="submit"', 'type="submit" class=""', $output );
    return $output;
  }
  add_filter('the_password_form' , 'plumco_password_form');
}


/* Widget Layouts */
if ( ! function_exists( 'plumco_footer_widgets' ) ) {
  function plumco_footer_widgets() {

    $output = '';
    $footer_widget_layout = cs_get_option('footer_widget_layout');

    if( $footer_widget_layout ) {

      switch ( $footer_widget_layout ) {
        case 1: $widget = array('piece' => 1, 'class' => 'col-sm-12 col'); break;
        case 2: $widget = array('piece' => 2, 'class' => 'col-md-6 col-sm-12 col-12'); break;
        case 3: $widget = array('piece' => 3, 'class' => 'col col-lg-4 col-md-6 col-sm-12 col-12'); break;
        case 4: $widget = array('piece' => 4, 'class' => 'col col-lg-3 col-md-6 col-sm-12 col-12'); break;
        case 5: $widget = array('piece' => 3, 'class' => 'col-lg-3 col', 'layout' => 'col-lg-6', 'queue' => 1); break;
        case 6: $widget = array('piece' => 3, 'class' => 'col-lg-3 col', 'layout' => 'col-lg-6', 'queue' => 2); break;
        case 7: $widget = array('piece' => 3, 'class' => 'col-lg-3 col', 'layout' => 'col-lg-6', 'queue' => 3); break;
        case 8: $widget = array('piece' => 4, 'class' => 'col-lg-2 col', 'layout' => 'col-lg-6', 'queue' => 1); break;
        case 9: $widget = array('piece' => 4, 'class' => 'col-lg-2 col', 'layout' => 'col-lg-6', 'queue' => 4); break;
        default : $widget = array('piece' => 4, 'class' => 'col-lg-3 col'); break;
      }

      for( $i = 1; $i < $widget["piece"]+1; $i++ ) {

        $widget_class = ( isset( $widget["queue"] ) && $widget["queue"] == $i ) ? $widget["layout"] : $widget["class"];

        if (is_active_sidebar('footer-'. $i)) {
          $output .= '<div class="'. $widget_class .'">';
          ob_start();
            dynamic_sidebar( 'footer-'. $i );
          $output .= ob_get_clean();
          $output .= '</div>';
        }

      }
    }

    return $output;

  }
}


/* WP Link Pages */
if ( ! function_exists( 'plumco_wp_link_pages' ) ) {
  function plumco_wp_link_pages() {
    $defaults = array(
      'before'           => '<div class="wp-link-pages">' . esc_html__( 'Pages:', 'plumco' ),
      'after'            => '</div>',
      'link_before'      => '<span>',
      'link_after'       => '</span>',
      'next_or_number'   => 'number',
      'separator'        => ' ',
      'pagelink'         => '%',
      'echo'             => 1
    );
    wp_link_pages( $defaults );
  }
}

/* Metas */
if ( ! function_exists( 'plumco_post_metas' ) ) {
  function plumco_post_metas() {
  $metas_hide = (array) cs_get_option( 'theme_metas_hide' );
  ?>
  <div class="bp-top-meta">
    <?php
    if ( !in_array( 'category', $metas_hide ) ) { // Category Hide
      if ( get_post_type() === 'post') {
        $category_list = get_the_category_list( ' ' );
        if ( $category_list ) {
          echo '<div class="bp-cat">'. $category_list .' </div>';
        }
      }
    } // Category Hides
    if ( !in_array( 'date', $metas_hide ) ) { // Date Hide
    ?>
    <div class="bp-date">
      <span><?php echo get_the_date('M d, Y'); ?></span>
    </div>
    <?php } // Date Hides
    if ( !in_array( 'author', $metas_hide ) ) { // Author Hide
    ?>
    <div class="bp-author">
      <?php
      printf(
        '<span>'. esc_html__('by','plumco') .' <a href="%1$s" rel="author">%2$s</a></span>',
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        get_the_author()
      );
      ?>
    </div>
    <?php } ?>
  </div>
  <?php
  }
}

/* Author Info */
if ( ! function_exists( 'plumco_author_info' ) ) {
  function plumco_author_info() {

    if (get_the_author_meta( 'url' )) {
      $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
      $website_url = get_the_author_meta( 'url' );
      $target = 'target="_blank"';
    } else {
      $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
      $website_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
      $target = '';
    }

    // variables
    $author_text = cs_get_option('author_text');
    $author_text = $author_text ? $author_text : esc_html__( 'Author', 'plumco' );
    $author_content = get_the_author_meta( 'description' );
    $facebook = get_the_author_meta( 'facebook' );
    $twitter = get_the_author_meta( 'twitter' );
    $instagram = get_the_author_meta( 'instagram' );
    $pinterest = get_the_author_meta( 'pinterest' );
if ($author_content) {
?>
<div class="author-box">
    <div class="author-avatar">
        <a href="<?php the_permalink(); ?>" target="_blank"><?php echo get_avatar( get_the_author_meta( 'ID' ), 125 ); ?></a>
    </div>
    <div class="author-content">
         <a href="<?php echo esc_url($author_url); ?>" class="author-name"><?php echo get_the_author_meta('first_name').' '.get_the_author_meta('last_name'); ?></a>
        <p><?php echo get_the_author_meta( 'description' ); ?></p>
        <?php if( $facebook || $twitter || $instagram || $pinterest ) { ?>
        <div class="socials">
            <ul class="social-link">
                <li>
                  <?php if($twitter) { ?>
                  <a href="<?php echo esc_url( $twitter ); ?>"><i class="ti-facebook"></i></a>
                  <?php } ?>
               </li>
                <li>
                  <?php if($facebook) { ?>
                    <a href="<?php echo esc_url( $facebook ); ?>"><i class="ti-twitter-alt"></i></a>
                  <?php } ?>
                </li>
                <li>
                  <?php if($instagram) { ?>
                    <a href="<?php echo esc_attr( $instagram ); ?>"><i class="ti-instagram"></i></a>
                  <?php } ?>
                </li>
                <li>
                 <?php if($pinterest) { ?>
                  <a href="<?php echo esc_url( $pinterest ); ?>"><i class="ti-pinterest-alt"></i></a>
                 <?php } ?>
                </li>
            </ul>
        </div>
      <?php } ?>
    </div>
</div>

<?php
} // if $author_content
  }
}

/* ==============================================
   Custom Comment Area Modification
=============================================== */
if ( ! function_exists( 'plumco_comment_modification' ) ) {
  function plumco_comment_modification($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    if ( 'div' == $args['style'] ) {
      $tag = 'div';
      $add_below = 'comment';
    } else {
      $tag = 'li';
      $add_below = 'div-comment';
    }
    $comment_class = empty( $args['has_children'] ) ? '' : 'parent';
  ?>

  <<?php echo esc_attr($tag); ?> <?php comment_class('item ' . $comment_class .' ' ); ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
   <article>
    <div id="div-comment-<?php comment_ID() ?>" class="plumco-comment">
    <?php endif; ?>
    <div class="comment-theme">
        <div class="comment-image">
          <?php if ( $args['avatar_size'] != 0 ) {
            echo get_avatar( $comment, 80 );
          } ?>
        </div>
    </div>
    <div class="comment-main-area">
      <div class="comments-meta">
        <h4><?php printf( '%s', get_comment_author() ); ?></h4>
         <span class="comments-date"><?php echo 'says '. get_comment_date(' F d, Y'); echo ' at '. get_comment_time(); ?></span>
      </div>
      <?php if ( $comment->comment_approved == '0' ) : ?>
      <em class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'plumco' ); ?></em>
      <?php endif; ?>
      <div class="comment-content">
        <?php comment_text(); ?>
        <div class="comments-reply">
          <?php
            comment_reply_link( array_merge( $args, array(
            'reply_text' => '<span class="comment-reply-link icofont icofont-reply-all">'.esc_html__( 'Reply', 'plumco' ).'</span>',
            'before' => '',
            'class'  => '',
            'depth' => $depth,
            'max_depth' => $args['max_depth']
            ) ) );
          ?>
        </div>
      </div>
    </div>
  <?php if ( 'div' != $args['style'] ) : ?>
  </div>
  </article>
  <?php endif;
  }
}

/* Comments Form - Textarea next to Normal Fields */
if( ! function_exists( 'plumco_move_comment_field' ) ) {
  add_filter( 'comment_form_fields', 'plumco_move_comment_field' );
  function plumco_move_comment_field( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
  }
}
/* Title Area */
if ( ! function_exists( 'plumco_title_area' ) ) {
  function plumco_title_area() {

    global $post, $wp_query;
    // Get post meta in all type of WP pages
    $plumco_id    = ( isset( $post ) ) ? $post->ID : 0;
    $plumco_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $plumco_id;
    $plumco_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $plumco_id;
    $plumco_meta  = get_post_meta( $plumco_id, 'page_type_metabox', true );
    if ($plumco_meta && (!is_archive() || is_woocommerce_shop())) {
      $custom_title = $plumco_meta['page_custom_title'];
      if ($custom_title) {
        $custom_title = $custom_title;
      } elseif(post_type_archive_title()) {
        post_type_archive_title();
      } else {
        $custom_title = '';
      }
    } else { $custom_title = ''; }

    if ( is_home() && is_front_page() ) {
      echo esc_html__( 'Blog', 'plumco' );
    } elseif ( is_home() && !is_front_page() ) {
      single_post_title();
    } elseif ( is_search() ) {
      printf( esc_html__( 'Search Results for %s', 'plumco' ), '<span>' . get_search_query() . '</span>' );
    } elseif ( is_category() || is_tax() ){
      single_cat_title();
    } elseif ( is_tag() ){
      single_tag_title( esc_html__('Posts Tagged: ', 'plumco') );
    } elseif ( is_archive() ){
      if ( is_day() ) {
        printf( wp_kses( __( 'Archive for <span>%s</span>', 'plumco' ), array( 'span' => array() ) ), get_the_date());
      } elseif ( is_month() ) {
        printf( wp_kses( __( 'Archive for <span>%s</span>', 'plumco' ), array( 'span' => array() )), get_the_date( 'F, Y' ));
      } elseif ( is_year() ) {
        printf( wp_kses( __( 'Archive for <span>%s</span>', 'plumco' ), array( 'span' => array() ) ), get_the_date( 'Y' ));
      } elseif ( is_author() ) {
        printf( wp_kses( __( 'Posts by: <span>%s</span>', 'plumco' ), array( 'span' => array() ) ), get_the_author_meta( 'display_name', $wp_query->post->post_author ));
      } elseif( is_woocommerce_shop() ) {
        esc_html_e( 'Shop', 'plumco' );
      } elseif( is_product() ) {
        esc_html_e( 'Shop Single', 'plumco' );
      } elseif ( is_post_type_archive() ) {
        post_type_archive_title();
      } else {
        esc_html_e( 'Archives', 'plumco' );
      }
    } elseif( ( class_exists( 'WooCommerce' ) ) && ( is_product() ) ) {
       the_title();
    } elseif( is_singular( 'project' ) ) {
       the_title();
    } elseif( is_singular( 'service' ) ) {
      the_title();
    }  elseif( is_404() ) {
      esc_html_e('404 Error', 'plumco');
    } elseif( $custom_title ) {
      echo esc_attr($custom_title);
    } else {
      if (is_single()) {
        the_title();
      } else {
        the_title();
      }
    }
  }
}


// Pingback Head
function plumco_pingback_header() {
  if ( is_singular() && pings_open() ) {
    printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
  }
}
add_action( 'wp_head', 'plumco_pingback_header' );


/**
 * blog pagination function.
 */
if ( ! function_exists( 'plumco_posts_navigation' ) ) :
  function plumco_posts_navigation() {
    the_posts_pagination(
      array(
        'mid_size'  => 2,
        'prev_text'    => wp_kses( '<i class="fi ti-arrow-left"></i>', array( 'i' => array( 'class' => array() ) ) ),
        'next_text'    => wp_kses( '<i class="fi ti-arrow-right"></i>', array( 'i' => array( 'class' => array() ) ) ),
      )
    );
  }
endif;


/**
 * blog Single pagination function.
 */
if ( ! function_exists( 'plumco_single_pagination' ) ) :
  function plumco_single_pagination() {
    $newer_post = cs_get_option('newer_post');
    $newer_post = ( $newer_post ) ? $newer_post : esc_html__('Next Post', 'plumco');
    $older_post = cs_get_option('older_post');
    $older_post = ( $older_post ) ? $older_post : esc_html__('Previous Post', 'plumco');
    the_post_navigation(
      array(
        'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html( 'Next Post', 'plumco' ) . '</span> ' .
          '<span class="screen-reader-text">' . esc_html( $newer_post ) . '</span> <br/>' .
          '<span class="post-title">%title</span>',
        'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html( 'Previous Post', 'plumco' ) . '</span> ' .
          '<span class="screen-reader-text">' . esc_html( $older_post ) . '</span> <br/>' .
          '<span class="post-title">%title</span>',
      )
    );
  }
endif;



/**
 * Plumco Header function.
 */

if (!function_exists('plumco_header_function')) {
  function plumco_header_function(){

  // Metabox
  global $post;
  $plumco_id    = ( isset( $post ) ) ? $post->ID : false;
  $plumco_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $plumco_id;
  $plumco_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $plumco_id;
  $plumco_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('testimonial') ) ? $plumco_id : false;
  $plumco_meta  = get_post_meta( $plumco_id, 'page_type_metabox', true );
  // Theme Layout Width
  $plumco_layout_width  = cs_get_option( 'theme_layout_width' );
  $theme_preloder  = cs_get_option( 'theme_preloder' );
  $plumco_layout_width_class = ( $plumco_layout_width === 'container' ) ? 'layout-boxed' : 'layout-full';
  // Header Style
  if ( $plumco_meta ) {
    $plumco_header_design  = $plumco_meta['select_header_design'];
    $plumco_sticky_header = isset( $plumco_meta['sticky_header'] ) ? $plumco_meta['sticky_header'] : '' ;
  } else {
    $plumco_header_design  = cs_get_option( 'select_header_design' );
    $plumco_sticky_header  = cs_get_option( 'sticky_header' );
  }

  if ( $plumco_header_design === 'default' ) {
    $plumco_header_design_actual  = cs_get_option( 'select_header_design' );
  } else {
    $plumco_header_design_actual = ( $plumco_header_design ) ? $plumco_header_design : cs_get_option('select_header_design');
  }

  $plumco_header_design_actual = $plumco_header_design_actual ? $plumco_header_design_actual : 'style_two';

  if ( $plumco_header_design_actual == 'style_two' ) {
    $header_class = 'header-style-2';
  }  else {
    $header_class = 'header-style-1';
  }

  if ( has_nav_menu( 'primary' ) ) {
     $has_menu = ' has-menu ';
  } else {
     $has_menu = ' dont-has-menu ';
  }

  if ( $plumco_sticky_header ) {
    $plumco_sticky_header = $plumco_sticky_header ? ' sticky-menu-on ' : '';
  } else {
    $plumco_sticky_header = '';
  }
  // Header Transparent
  if ( $plumco_meta ) {
    $plumco_transparent_header = $plumco_meta['transparency_header'];
    $plumco_transparent_header = $plumco_transparent_header ? ' header-transparent' : ' dont-transparent';
    // Shortcode Banner Type
    $plumco_banner_type = ' '. $plumco_meta['banner_type'];
  } else { $plumco_transparent_header = ' dont-transparent'; $plumco_banner_type = ''; }
  wp_head();
  ?>
  </head>
  <body <?php body_class(); ?>>
     <?php wp_body_open(); ?>
  <div class="page-wrapper <?php echo esc_attr( $plumco_layout_width_class ); ?>"> <!-- #plumco-theme-wrapper -->
  <?php if( $theme_preloder ) {
   get_template_part( 'theme-layouts/header/preloder' );
   } ?>
    <header id="header" class="wpo-site-header <?php echo esc_attr( $header_class ); ?>">
        <?php  get_template_part( 'theme-layouts/header/top','bar' ); ?>
      <nav id="site-navigation" class="navigation navbar navbar-expand-lg navbar-light <?php echo esc_attr( $plumco_sticky_header.$has_menu ); ?>">
        <?php get_template_part( 'theme-layouts/header/menu','bar' ); ?>
      </nav>
    </header>
    <?php
    // Title Area
    $plumco_need_title_bar = cs_get_option('need_title_bar');
    if ( !$plumco_need_title_bar ) {
      get_template_part( 'theme-layouts/header/title', 'bar' );
    }

  }
}
