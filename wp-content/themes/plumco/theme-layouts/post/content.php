<?php
/**
 * Template part for displaying posts.
 */
// Metabox
$plumco_id    = ( isset( $post ) ) ? $post->ID : 0;
$plumco_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $plumco_id;
$plumco_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $plumco_id;
$plumco_meta  = get_post_meta( $plumco_id, 'page_type_metabox', true );
$plumco_large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
$plumco_alt = get_post_meta($plumco_large_image, '_wp_attachment_image_alt', true);
$plumco_read_more_text = cs_get_option('read_more_text');
$plumco_read_text = $plumco_read_more_text ? $plumco_read_more_text : esc_html__( 'Read More', 'plumco' );
$plumco_post_type = get_post_meta( get_the_ID(), 'post_type_metabox', true );
$plumco_metas_hide = (array) cs_get_option( 'theme_metas_hide' );
  // Sticky
$post_class = get_post_class();
$find_sticky = array_search( 'sticky', $post_class );

if ( 'gallery' == get_post_format() && ! empty( $plumco_post_type['gallery_post_format'] ) ) {
  $post_format_class = ' slider-post';
  $quote_output = '';
} elseif ( 'video' == get_post_format() && ! empty( $plumco_post_type['video_post_format'] ) ) {
  $post_format_class = ' video-post';
  $quote_output = '';
}  elseif ( 'quote' == get_post_format() && ! empty( $plumco_post_type['quote_post_format'] ) ) {
  $post_format_class = ' quote-post';
  $post_format_class = ' <div class="quote-icon"><i class="ti-quote-right"></i></div>';
} else {
  $post_format_class = ' ';
  $quote_output = '';
}
?>
 <div <?php post_class('post'.$post_format_class); ?>>
  <?php
    if ( $find_sticky ) {
        echo '<div class="sticky-badge"><h2>Featured</h2></div>';
    }
    if ( 'gallery' == get_post_format() && ! empty( $plumco_post_type['gallery_post_format'] ) ) { ?>
    <div class="entry-media post-slider"
        data-nav="true"
        data-autoplay="true"
        data-auto-height="true"
        data-dots="true">
    <?php
      $plumco_ids = explode( ',', $plumco_post_type['gallery_post_format'] );
      foreach ( $plumco_ids as $id ) {
        $plumco_attachment = wp_get_attachment_image_src( $id, 'full' );
        $plumco_alt = get_post_meta($id, '_wp_attachment_image_alt', true);
        echo '<img src="'. $plumco_attachment[0] .'" alt="'. esc_attr( $plumco_alt ) .'" />';
      }
    ?>
  </div>
  <?php } elseif ( 'video' == get_post_format() && ! empty( $plumco_post_type['video_post_format'] ) ) { ?>
    <div class="entry-media video-holder">
        <img src="<?php echo esc_url( $plumco_large_image[0] ); ?>" alt="<?php echo esc_attr( $plumco_alt ); ?>">
        <a href="<?php echo esc_url( $plumco_post_type['video_post_format'] ); ?>?autoplay=1" class="video-btn" data-type="iframe">
            <i class="fi flaticon-play-button"></i>
        </a>
    </div>
   <?php }  elseif ( 'quote' == get_post_format() ) { ?>
      <div class="quote-icon"></div>
    <?php } elseif ( $plumco_large_image ) { ?>
    <div class="entry-media">
        <img src="<?php echo esc_url( $plumco_large_image[0] ); ?>" alt="<?php echo esc_attr( $plumco_alt ); ?>">
    </div>
    <?php } ?>
    <div class="entry-meta">
      <ul>
        <li>
           <?php if ( !in_array( 'author', $plumco_metas_hide ) ) { // Author Hide
              printf(
              '<span><i class="fi flaticon-user author"></i>'.esc_html__(' By: ','plumco').'<a href="%1$s" rel="author">%2$s</a></span>',
              esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author()
              );
          } ?>
        </li>
        <li>
        <i class="fi ti-comment-alt"></i>
           <a class="plumco-comment" href="<?php echo esc_url( get_comments_link() ); ?>">
            <?php printf( esc_html( _nx( 'Comments (%1$s)', 'Comments (%1$s)', get_comments_number(), 'comments title', 'plumco' ) ), '<span class="comment">'.number_format_i18n( get_comments_number() ).'</span>','<span>' . get_the_title() . '</span>' ); ?>
          </a>
        </li>
        <li><i class="fi ti-calendar"></i>
          <a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_date() );  ?></a>
        </li>
      </ul>
    </div>
    <div class="entry-details">
      <h3><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo get_the_title(); ?></a></h3>
       <p>
        <?php
            $blog_excerpt = cs_get_option('theme_blog_excerpt');
            if ($blog_excerpt) {
              $blog_excerpt = $blog_excerpt;
            } else {
              $blog_excerpt = '23';
            }
            plumco_excerpt($blog_excerpt);
            echo plumco_wp_link_pages();
        ?>
      </p>
      <a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more">
        <?php echo esc_attr($plumco_read_text); ?>
      </a>
    </div>
</div>
