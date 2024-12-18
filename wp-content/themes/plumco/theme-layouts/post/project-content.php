<?php
/**
 * Single Event.
 */
$plumco_large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
$plumco_large_image = $plumco_large_image[0];
$image_alt = get_post_meta( $plumco_large_image, '_wp_attachment_image_alt', true);
$project_options = get_post_meta( get_the_ID(), 'project_options', true );
$project_page_options = get_post_meta( get_the_ID(), 'project_page_options', true );

$plumco_prev_pro = cs_get_option('prev_service');
$plumco_next_pro = cs_get_option('next_servic');
$plumco_prev_pro = ($plumco_prev_pro) ? $plumco_prev_pro : esc_html__('Previous project', 'plumco');
$plumco_next_pro = ($plumco_next_pro) ? $plumco_next_pro : esc_html__('Next project', 'plumco');
$plumco_prev_post = get_previous_post( '', false);
$plumco_next_post = get_next_post( '', false);

?>        
<div class="content-area">
			<div class="project-thumb">
				<?php if ( isset( $plumco_large_image ) ): ?>
        <img src="<?php echo esc_url( $plumco_large_image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
      	<?php endif ?>
			</div>
			<div class="project-article">
     		<?php the_content(); ?>
     </div>
</div> 

 