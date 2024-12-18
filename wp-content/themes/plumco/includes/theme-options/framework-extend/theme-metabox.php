<?php
/*
 * All Metabox related options for Plumco theme.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

function plumco_metabox_options( $options ) {

 $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
    $contact_forms = array();
    if ( $cf7 ) {
      foreach ( $cf7 as $cform ) {
        $contact_forms[ $cform->ID ] = $cform->post_title;
      }
    } else {
      $contact_forms[ esc_html__( 'No contact forms found', 'plumco' ) ] = 0;
    }
  $options      = array();

  // -----------------------------------------
  // Post Metabox Options                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'post_type_metabox',
    'title'     => esc_html__('Post Options', 'plumco'),
    'post_type' => 'post',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // All Post Formats
      array(
        'name'   => 'section_post_formats',
        'fields' => array(

          // Standard, Image
          array(
            'title' => 'Standard Image',
            'type'  => 'subheading',
            'content' => esc_html__('There is no Extra Option for this Post Format!', 'plumco'),
            'wrap_class' => 'plumco-minimal-heading hide-title',
          ),
          // Standard, Image

          // Gallery
          array(
            'type'    => 'notice',
            'title'   => 'Gallery Format',
            'wrap_class' => 'hide-title',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('Gallery Format', 'plumco')
          ),
          array(
            'id'          => 'gallery_post_format',
            'type'        => 'gallery',
            'title'       => esc_html__('Add Gallery', 'plumco'),
            'add_title'   => esc_html__('Add Image(s)', 'plumco'),
            'edit_title'  => esc_html__('Edit Image(s)', 'plumco'),
            'clear_title' => esc_html__('Clear Image(s)', 'plumco'),
          ),
          array(
            'type'    => 'text',
            'title'   => esc_html__('Add Video URL', 'plumco' ),
            'id'   => 'video_post_format',
            'desc' => esc_html__('Add youtube or vimeo video link', 'plumco' ),
            'wrap_class' => 'video_post_format',
          ),
          array(
            'type'    => 'icon',
            'title'   => esc_html__('Add Quote Icon', 'plumco' ),
            'id'   => 'quote_post_format',
            'desc' => esc_html__('Add Quote Icon here', 'plumco' ),
            'wrap_class' => 'quote_post_format',
          ),
          // Gallery

        ),
      ),

    ),
  );

  // -----------------------------------------
  // Page Metabox Options                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'page_type_metabox',
    'title'     => esc_html__('Page Custom Options', 'plumco'),
    'post_type' => array('post', 'page'),
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // Title Section
      array(
        'name'  => 'page_topbar_section',
        'title' => esc_html__('Top Bar', 'plumco'),
        'icon'  => 'fa fa-minus',

        // Fields Start
        'fields' => array(

          array(
            'id'           => 'topbar_options',
            'type'         => 'image_select',
            'title'        => esc_html__('Topbar', 'plumco'),
            'options'      => array(
              'default'     => PLUMCO_CS_IMAGES .'/topbar-default.png',
              'custom'      => PLUMCO_CS_IMAGES .'/topbar-custom.png',
              'hide_topbar' => PLUMCO_CS_IMAGES .'/topbar-hide.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'hide_topbar_select',
            ),
            'radio'     => true,
            'default'   => 'default',
          ),
          array(
            'id'          => 'top_left',
            'type'        => 'textarea',
            'title'       => esc_html__('Top Left', 'plumco'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
            'shortcode'       => true,
          ),
          array(
            'id'          => 'top_right',
            'type'        => 'textarea',
            'title'       => esc_html__('Top Right', 'plumco'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
            'shortcode'       => true,
          ),
          array(
            'id'    => 'topbar_bg',
            'type'  => 'color_picker',
            'title' => esc_html__('Topbar Background Color', 'plumco'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
          ),
          array(
            'id'    => 'topbar_border',
            'type'  => 'color_picker',
            'title' => esc_html__('Topbar Border Color', 'plumco'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
          ),

        ), // End : Fields

      ), // Title Section

      // Header
      array(
        'name'  => 'header_section',
        'title' => esc_html__('Header', 'plumco'),
        'icon'  => 'fa fa-bars',
        'fields' => array(

          array(
            'id'           => 'select_header_design',
            'type'         => 'image_select',
            'title'        => esc_html__('Select Header Design', 'plumco'),
            'options'      => array(
              'default'     => PLUMCO_CS_IMAGES .'/hs-0.png',
              'style_one'   => PLUMCO_CS_IMAGES .'/hs-1.png',
              'style_two'   => PLUMCO_CS_IMAGES .'/hs-2.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'header_design',
            ),
            'radio'     => true,
            'default'   => 'default',
            'info'      => esc_html__('Select your header design, following options will may differ based on your selection of header design.', 'plumco'),
          ),
          array(
            'id'    => 'transparency_header',
            'type'  => 'switcher',
            'title' => esc_html__('Transparent Header', 'plumco'),
            'info' => esc_html__('Use Transparent Method', 'plumco'),
          ),
          array(
            'id'    => 'transparent_menu_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Menu Color', 'plumco'),
            'info' => esc_html__('Pick your menu color. This color will only apply for non-sticky header mode.', 'plumco'),
            'dependency'   => array('transparency_header', '==', 'true'),
          ),
          array(
            'id'    => 'transparent_menu_hover_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Menu Hover Color', 'plumco'),
            'info' => esc_html__('Pick your menu hover color. This color will only apply for non-sticky header mode.', 'plumco'),
            'dependency'   => array('transparency_header', '==', 'true'),
          ),
          array(
            'id'             => 'choose_menu',
            'type'           => 'select',
            'title'          => esc_html__('Choose Menu', 'plumco'),
            'desc'          => esc_html__('Choose custom menus for this page.', 'plumco'),
            'options'        => 'menus',
            'default_option' => esc_html__('Select your menu', 'plumco'),
          ),

          // Enable & Disable
          array(
            'type'    => 'notice',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('Enable & Disable', 'plumco'),
            'dependency' => array('header_design', '!=', 'default'),
          ),
          array(
            'id'    => 'sticky_header',
            'type'  => 'switcher',
            'title' => esc_html__('Sticky Header', 'plumco'),
            'info' => esc_html__('Turn On if you want your naviagtion bar on sticky.', 'plumco'),
            'default' => true,
            'dependency' => array('header_design', '!=', 'default'),
          ),
        ),
      ),
      // Header

      // Banner & Title Area
      array(
        'name'  => 'banner_title_section',
        'title' => esc_html__('Banner & Title Area', 'plumco'),
        'icon'  => 'fa fa-bullhorn',
        'fields' => array(

          array(
            'id'        => 'banner_type',
            'type'      => 'select',
            'title'     => esc_html__('Choose Banner Type', 'plumco'),
            'options'   => array(
              'default-title'    => 'Default Title',
              'revolution-slider' => 'Shortcode [Rev Slider]',
              'hide-title-area'   => 'Hide Title/Banner Area',
            ),
          ),
          array(
            'id'    => 'page_revslider',
            'type'  => 'textarea',
            'title' => esc_html__('Revolution Slider or Any Shortcodes', 'plumco'),
            'desc' => __('Enter any shortcodes that you want to show in this page title area. <br />Eg : Revolution Slider shortcode.', 'plumco'),
            'attributes' => array(
              'placeholder' => esc_html__('Enter your shortcode...', 'plumco'),
            ),
            'dependency'   => array('banner_type', '==', 'revolution-slider'),
          ),
          array(
            'id'    => 'page_custom_title',
            'type'  => 'text',
            'title' => esc_html__('Custom Title', 'plumco'),
            'attributes' => array(
              'placeholder' => esc_html__('Enter your custom title...', 'plumco'),
            ),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'        => 'title_area_spacings',
            'type'      => 'select',
            'title'     => esc_html__('Title Area Spacings', 'plumco'),
            'options'   => array(
              'padding-default' => esc_html__('Default Spacing', 'plumco'),
              'padding-custom' => esc_html__('Custom Padding', 'plumco'),
            ),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'title_top_spacings',
            'type'  => 'text',
            'title' => esc_html__('Top Spacing', 'plumco'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('banner_type|title_area_spacings', '==|==', 'default-title|padding-custom'),
          ),
          array(
            'id'    => 'title_bottom_spacings',
            'type'  => 'text',
            'title' => esc_html__('Bottom Spacing', 'plumco'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('banner_type|title_area_spacings', '==|==', 'default-title|padding-custom'),
          ),
          array(
            'id'    => 'title_area_bg',
            'type'  => 'background',
            'title' => esc_html__('Background', 'plumco'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'titlebar_bg_overlay_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Overlay Color', 'plumco'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'title_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Title Color', 'plumco'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),

        ),
      ),
      // Banner & Title Area

      // Content Section
      array(
        'name'  => 'page_content_options',
        'title' => esc_html__('Content Options', 'plumco'),
        'icon'  => 'fa fa-file',

        'fields' => array(

          array(
            'id'        => 'content_spacings',
            'type'      => 'select',
            'title'     => esc_html__('Content Spacings', 'plumco'),
            'options'   => array(
              'padding-default' => esc_html__('Default Spacing', 'plumco'),
              'padding-custom' => esc_html__('Custom Padding', 'plumco'),
            ),
            'desc' => esc_html__('Content area top and bottom spacings.', 'plumco'),
          ),
          array(
            'id'    => 'content_top_spacings',
            'type'  => 'text',
            'title' => esc_html__('Top Spacing', 'plumco'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('content_spacings', '==', 'padding-custom'),
          ),
          array(
            'id'    => 'content_bottom_spacings',
            'type'  => 'text',
            'title' => esc_html__('Bottom Spacing', 'plumco'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('content_spacings', '==', 'padding-custom'),
          ),
        ), // End Fields
      ), // Content Section

      // Enable & Disable
      array(
        'name'  => 'hide_show_section',
        'title' => esc_html__('Enable & Disable', 'plumco'),
        'icon'  => 'fa fa-toggle-on',
        'fields' => array(

          array(
            'id'    => 'hide_header',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Header', 'plumco'),
            'label' => esc_html__('Yes, Please do it.', 'plumco'),
          ),
          array(
            'id'    => 'hide_breadcrumbs',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Breadcrumbs', 'plumco'),
            'label' => esc_html__('Yes, Please do it.', 'plumco'),
          ),
          array(
            'id'    => 'hide_footer',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Footer', 'plumco'),
            'label' => esc_html__('Yes, Please do it.', 'plumco'),
          ),
       
        ),
      ),
      // Enable & Disable

    ),
  );

  // -----------------------------------------
  // Page Layout
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'page_layout_options',
    'title'     => esc_html__('Page Layout', 'plumco'),
    'post_type' => 'page',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'page_layout_section',
        'fields' => array(

          array(
            'id'        => 'page_layout',
            'type'      => 'image_select',
            'options'   => array(
              'full-width'    => PLUMCO_CS_IMAGES . '/page-1.png',
              'extra-width'   => PLUMCO_CS_IMAGES . '/page-2.png',
              'left-sidebar'  => PLUMCO_CS_IMAGES . '/page-3.png',
              'right-sidebar' => PLUMCO_CS_IMAGES . '/page-4.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'page_layout',
            ),
            'default'    => 'full-width',
            'radio'      => true,
            'wrap_class' => 'text-center',
          ),
          array(
            'id'            => 'page_sidebar_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'plumco'),
            'options'        => plumco_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'plumco'),
            'dependency'   => array('page_layout', 'any', 'left-sidebar,right-sidebar'),
          ),

        ),
      ),

    ),
  );


// -----------------------------------------
  // Project
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'project_options',
    'title'     => esc_html__('Project Extra Options', 'plumco'),
    'post_type' => 'project',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'project_option_section',
        'fields' => array(
          array(
            'id'           => 'project_title',
            'type'         => 'text',
            'title'        => esc_html__('Project title', 'plumco'),
            'add_title' => esc_html__('Add Project title', 'plumco'),
            'attributes' => array(
              'placeholder' => esc_html__('Project Title', 'plumco'),
            ),
            'info'    => esc_html__('Write Project Title.', 'plumco'),
          ),  
          array(
            'id'           => 'project_subtitle',
            'type'         => 'text',
            'title'        => esc_html__('Project Subtitle', 'plumco'),
            'add_title' => esc_html__('Add Project Subtitle', 'plumco'),
            'attributes' => array(
              'placeholder' => esc_html__('Project Sub Title', 'plumco'),
            ),
            'info'    => esc_html__('Write Project Sub Title.', 'plumco'),
          ),   
          array(
            'id'           => 'project_image',
            'type'         => 'image',
            'title'        => esc_html__('Project Image', 'plumco'),
            'add_title' => esc_html__('Add Project Image', 'plumco'),
          ),
           // Start fields
        ),
      ),

    ),
  );



 // -----------------------------------------
  // Service
  // -----------------------------------------

  $options[]    = array(
    'id'        => 'service_options',
    'title'     => esc_html__('Service Meta', 'plumco'),
    'post_type' => 'service',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(
      array(
        'name'   => 'service_infos',
        'fields' => array(
          array(
            'title'   => esc_html__('Service Title', 'plumco'),
            'id'      => 'service_title',
            'type'    => 'text',
            'attributes' => array(
              'placeholder' => esc_html__('Jhon Deno', 'plumco'),
            ),
            'info'    => esc_html__('Write Service Title.', 'plumco'),

          ),
          array(
            'title'   => esc_html__('Service Excerpt', 'plumco'),
            'id'      => 'service_excerpt',
            'type'    => 'textarea',
            'attributes' => array(
              'placeholder' => esc_html__('Excerpt Content', 'plumco'),
            ),
            'info'    => esc_html__('Write Service Short Content.', 'plumco'),

          ),
         array(
            'id'           => 'service_icon',
            'type'         => 'image',
            'title'        => esc_html__('Service Icon Image', 'plumco'),
            'add_title' => esc_html__('Service icon', 'plumco'),
            'info'    => esc_html__('Attached Service icon.', 'plumco'),
          ),
         array(
            'id'           => 'service_thumb',
            'type'         => 'image',
            'title'        => esc_html__('Service Image', 'plumco'),
            'add_title' => esc_html__('Service grid image', 'plumco'),
            'info'    => esc_html__('Attached Service Image.', 'plumco'),
          ),

        ),
      ),
    ),
  );


if (class_exists( 'WooCommerce' )){ 
   // -----------------------------------------
    // Product
    // -----------------------------------------
    $options[]    = array(
      'id'        => 'plumco_woocommerce_section',
      'title'     => esc_html__('Product Title', 'plumco'),
      'post_type' => 'product',
      'context'   => 'normal',
      'priority'  => 'high',
      'sections'  => array(

        // All Post Formats
        array(
          'name'   => 'plumco_single_title',
          'fields' => array(
            array(
              'id'          => 'plumco_product_title',
              'type'        => 'text',
              'title'       => esc_html__('Single Title', 'plumco'),
              'attributes' => array(
                'placeholder' => 'The Title Gose Here'
              ),
            ),

          ),
        ),

      ),
    );
}
// -----------------------------------------
  // Donation Forms
  // -----------------------------------------
  $options[]    = array(
    'id'        => '_donation_form_metabox',
    'title'     => esc_html__('Donation Deadline', 'plumco'),
    'post_type' => 'give_forms',
    'context'   => 'normal',
    'priority'  => 'high',
    'sections'  => array(

      // All Post Formats
      array(
        'name'   => 'section_deadline',
        'fields' => array(
          array(
            'id'          => 'donation_deadline',
            'type'        => 'text',
            'title'       => esc_html__('Deadline Date', 'plumco'),
            'attributes' => array(
              'placeholder' => 'DD/MM/YYYY'
            ),
          ),
          // Gallery

        ),
      ),

    ),
  );
  
  // -----------------------------------------
  // Causes
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'causes_options',
    'title'     => esc_html__('Causes Extra Options', 'plumco'),
    'post_type' => 'give_forms',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'causes_option_section',
        'fields' => array(
         array(
            'id'           => 'causes_image',
            'type'         => 'image',
            'title'        => esc_html__('Causes Image', 'plumco'),
            'add_title' => esc_html__('Add Causes Image', 'plumco'),
          ),
         array(
            'id'           => 'case_form_title',
            'type'         => 'text',
            'default'    => 'Donate Now',
            'title'        => esc_html__('Form Title', 'plumco'),
            'add_title' => esc_html__('Add Form Title here', 'plumco'),
          ),
        ),
      ),

    ),
  );

  // -----------------------------------------
  // post options
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'post_options',
    'title'     => esc_html__('Grid Image', 'plumco'),
    'post_type' => 'post',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(
      array(
        'name'   => 'post_option_section',
        'fields' => array(
          array(
            'id'           => 'widget_post_title',
            'type'         => 'text',
            'title'        => esc_html__('Widget Post Title', 'plumco'),
            'add_title' => esc_html__('Add Widget Post Title here', 'plumco'),
          ),
          array(
            'id'           => 'grid_image',
            'type'         => 'image',
            'title'        => esc_html__('Post Grid Image', 'plumco'),
            'add_title' => esc_html__('Add Post Grid Image', 'plumco'),
          ),
        ),
      ),

    ),
  );


  return $options;

}
add_filter( 'cs_metabox_options', 'plumco_metabox_options' );