<?php
    // Logo Image
    // Metabox - Header Transparent
    $plumco_id    = ( isset( $post ) ) ? $post->ID : 0;
    $plumco_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $plumco_id;
    $plumco_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $plumco_id;
    $plumco_meta  = get_post_meta( $plumco_id, 'page_type_metabox'. true );
    $plumco_preloader_image  = cs_get_option( 'preloader_image' );

    $plumco_preloader_url = wp_get_attachment_url( $plumco_preloader_image );
    $plumco_preloader_alt = get_post_meta( $plumco_preloader_image, '_wp_attachment_image_alt', true );

    if ( $plumco_preloader_url ) {
        $plumco_preloader_url = $plumco_preloader_url;
    } else {
        $plumco_preloader_url = PLUMCO_IMAGES.'/preloader.png';
    }

?>
<!-- start preloader -->
<div class="preloader">
    <div class="vertical-centered-box">
        <div class="content">
            <div class="loader-circle"></div>
            <div class="loader-line-mask">
                <div class="loader-line"></div>
            </div>
            <img src="<?php echo esc_url( $plumco_preloader_url ); ?>" alt="<?php echo esc_attr( $plumco_preloader_alt ); ?>">
        </div>
    </div>
</div>
<!-- end preloader -->