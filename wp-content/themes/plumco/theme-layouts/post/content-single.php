<?php
/**
 * Single Post.
 */
$plumco_large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
$plumco_large_image = $plumco_large_image ? $plumco_large_image[0] : '';
$image_alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
$plumco_post_type = get_post_meta( get_the_ID(), 'post_type_metabox', true );
// Single Theme Option
$plumco_post_pagination_option = cs_get_option('single_post_pagination');
$plumco_single_featured_image = cs_get_option('single_featured_image');
$plumco_single_author_info = cs_get_option('single_author_info');
$plumco_single_share_option = cs_get_option('single_share_option');
$plumco_metas_hide = (array) cs_get_option( 'theme_metas_hide' );
?>
  <div <?php post_class('post clearfix'); ?>>
  	<?php if ( $plumco_large_image ) { ?>
  	  <div class="entry-media">
        <img src="<?php echo esc_url( $plumco_large_image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
   		</div>
  	<?php	} ?>
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
	     <?php
				the_content();
				echo plumco_wp_link_pages();
			 ?>
    </div>
</div>
<?php if( has_tag() || ( $plumco_single_share_option && function_exists('plumco_wp_share_option') ) ) { ?>
<div class="tag-share-wrap">
  <div class="tag-share clearfix">
    <?php if( has_tag() ) { ?>
       <div class="tag">
            <?php
              echo '<span>'.esc_html__('Tags:','plumco').'</span>';
              $tag_list = get_the_tags();
              if($tag_list) {
                echo the_tags( ' <ul class="tags"><li>', '</li><li>', '</li></ul>' );
             } ?>
        </div>
  </div>
  <div class="tag-share-s2 clearfix">
      <?php } 
      if ( $plumco_single_share_option && function_exists('plumco_wp_share_option') ) {
            echo plumco_wp_share_option();
        }
     ?>
  </div>
</div>
<?php
}
if( !$plumco_single_author_info ) {
	plumco_author_info();
	}
?>

