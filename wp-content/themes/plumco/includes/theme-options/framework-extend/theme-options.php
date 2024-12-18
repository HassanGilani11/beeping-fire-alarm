<?php
/*
 * All Theme Options for Plumco theme.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

function plumco_settings( $settings ) {

  $settings           = array(
    'menu_title'      => PLUMCO_NAME . esc_html__(' Options', 'plumco'),
    'menu_slug'       => sanitize_title(PLUMCO_NAME) . '_options',
    'menu_type'       => 'theme',
    'menu_icon'       => 'dashicons-awards',
    'menu_position'   => '4',
    'ajax_save'       => false,
    'show_reset_all'  => true,
    'framework_title' => PLUMCO_NAME .' <small>V-'. PLUMCO_VERSION .' by <a href="'. PLUMCO_BRAND_URL .'" target="_blank">'. PLUMCO_BRAND_NAME .'</a></small>',
  );

  return $settings;

}
add_filter( 'cs_framework_settings', 'plumco_settings' );

// Theme Framework Options
function plumco_options( $options ) {

  $options      = array(); // remove old options

  // ------------------------------
  // Branding
  // ------------------------------
  $options[]   = array(
    'name'     => 'plumco_theme_branding',
    'title'    => esc_html__('Brand Settings', 'plumco'),
    'icon'     => 'fa fa-address-book-o',
    'sections' => array(

      // brand logo tab
      array(
        'name'     => 'brand_logo',
        'title'    => esc_html__('Logo', 'plumco'),
        'icon'     => 'fa fa-star',
        'fields'   => array(

          // Site Logo
          array(
            'type'    => 'notice',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('Site Logo', 'plumco')
          ),
          array(
            'id'    => 'plumco_logo',
            'type'  => 'image',
            'title' => esc_html__('Default Logo', 'plumco'),
            'info'  => esc_html__('Upload your default logo here. If you not upload, then site title will load in this logo location.', 'plumco'),
            'add_title' => esc_html__('Add Logo', 'plumco'),
          ),
          array(
            'id'    => 'plumco_trlogo',
            'type'  => 'image',
            'title' => esc_html__('Transparent Logo', 'plumco'),
            'info'  => esc_html__('Upload your Transparent logo here. If you not upload, then site title will load in this logo location.', 'plumco'),
            'add_title' => esc_html__('Add Logo', 'plumco'),
          ),
          array(
            'id'          => 'plumco_logo_top',
            'type'        => 'number',
            'title'       => esc_html__('Logo Top Space', 'plumco'),
            'attributes'  => array( 'placeholder' => 5 ),
            'unit'        => 'px',
          ),
          array(
            'id'          => 'plumco_logo_bottom',
            'type'        => 'number',
            'title'       => esc_html__('Logo Bottom Space', 'plumco'),
            'attributes'  => array( 'placeholder' => 5 ),
            'unit'        => 'px',
          ),
          // WordPress Admin Logo
          array(
            'type'    => 'notice',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('WordPress Admin Logo', 'plumco')
          ),
          array(
            'id'    => 'brand_logo_wp',
            'type'  => 'image',
            'title' => esc_html__('Login logo', 'plumco'),
            'info'  => esc_html__('Upload your WordPress login page logo here.', 'plumco'),
            'add_title' => esc_html__('Add Login Logo', 'plumco'),
          ),
        ) // end: fields
      ), // end: section
    ),
  );

  // ------------------------------
  // Layout
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_layout',
    'title'  => esc_html__('Theme Layout', 'plumco'),
    'icon'   => 'fa fa-files-o'
  );

  $options[]      = array(
    'name'        => 'theme_general',
    'title'       => esc_html__('General Settings', 'plumco'),
    'icon'        => 'fa fa-cogs',

    // begin: fields
    'fields'      => array(

      // -----------------------------
      // Begin: Responsive
      // -----------------------------
       array(
        'id'    => 'theme_responsive',
        'off_text'  => 'No',
        'on_text'  => 'Yes',
        'type'  => 'switcher',
        'title' => esc_html__('Responsive', 'plumco'),
        'info' => esc_html__('Turn on if you don\'t want your site to be responsive.', 'plumco'),
        'default' => false,
      ),
      array(
        'id'    => 'theme_preloder',
        'off_text'  => 'No',
        'on_text'  => 'Yes',
        'type'  => 'switcher',
        'title' => esc_html__('Preloder', 'plumco'),
        'info' => esc_html__('Turn off if you don\'t want your site to be Preloder.', 'plumco'),
        'default' => true,
      ),
      array(
        'id'    => 'preloader_image',
        'type'  => 'image',
        'title' => esc_html__('Preloader Logo', 'plumco'),
        'info'  => esc_html__('Upload your preoader logo here. If you not upload, then site preoader will load in this preloader location.', 'plumco'),
        'add_title' => esc_html__('Add Logo', 'plumco'),
        'dependency' => array( 'theme_preloder', '==', 'true' ),
      ),
      array(
        'id'    => 'theme_layout_width',
        'type'  => 'image_select',
        'title' => esc_html__('Full Width & Extra Width', 'plumco'),
        'info' => esc_html__('Boxed or Fullwidth? Choose your site layout width. Default : Full Width', 'plumco'),
        'options'      => array(
          'container'    => PLUMCO_CS_IMAGES .'/boxed-width.jpg',
          'container-fluid'    => PLUMCO_CS_IMAGES .'/full-width.jpg',
        ),
        'default'      => 'container-fluid',
        'radio'      => true,
      ),
       array(
        'id'    => 'theme_page_comments',
        'type'  => 'switcher',
        'title' => esc_html__('Hide Page Comments?', 'plumco'),
        'label' => esc_html__('Yes! Hide Page Comments.', 'plumco'),
        'on_text' => esc_html__('Yes', 'plumco'),
        'off_text' => esc_html__('No', 'plumco'),
        'default' => false,
      ),
      array(
        'type'    => 'notice',
        'class'   => 'info cs-plumco-heading',
        'content' => esc_html__('Background Options', 'plumco'),
        'dependency' => array( 'theme_layout_width_container', '==', 'true' ),
      ),
      array(
        'id'             => 'theme_layout_bg_type',
        'type'           => 'select',
        'title'          => esc_html__('Background Type', 'plumco'),
        'options'        => array(
          'bg-image' => esc_html__('Image', 'plumco'),
          'bg-pattern' => esc_html__('Pattern', 'plumco'),
        ),
        'dependency' => array( 'theme_layout_width_container', '==', 'true' ),
      ),
      array(
        'id'    => 'theme_layout_bg_pattern',
        'type'  => 'image_select',
        'title' => esc_html__('Background Pattern', 'plumco'),
        'info' => esc_html__('Select background pattern', 'plumco'),
        'options'      => array(
          'pattern-1'    => PLUMCO_CS_IMAGES . '/pattern-1.png',
          'pattern-2'    => PLUMCO_CS_IMAGES . '/pattern-2.png',
          'pattern-3'    => PLUMCO_CS_IMAGES . '/pattern-3.png',
          'pattern-4'    => PLUMCO_CS_IMAGES . '/pattern-4.png',
          'custom-pattern'  => PLUMCO_CS_IMAGES . '/pattern-5.png',
        ),
        'default'      => 'pattern-1',
        'radio'      => true,
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type', '==|==', 'true|bg-pattern' ),
      ),
      array(
        'id'      => 'custom_bg_pattern',
        'type'    => 'upload',
        'title'   => esc_html__('Custom Pattern', 'plumco'),
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type|theme_layout_bg_pattern_custom-pattern', '==|==|==', 'true|bg-pattern|true' ),
        'info' => __('Select your custom background pattern. <br />Note, background pattern image will be repeat in all x and y axis. So, please consider all repeatable area will perfectly fit your custom patterns.', 'plumco'),
      ),
      array(
        'id'      => 'theme_layout_bg',
        'type'    => 'background',
        'title'   => esc_html__('Background', 'plumco'),
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type', '==|==', 'true|bg-image' ),
      ),

    ), // end: fields

  );

  // ------------------------------
  // Header Sections
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_header_tab',
    'title'    => esc_html__('Header Settings', 'plumco'),
    'icon'     => 'fa fa-header',
    'sections' => array(

      // header design tab
      array(
        'name'     => 'header_design_tab',
        'title'    => esc_html__('Design', 'plumco'),
        'icon'     => 'fa fa-magic',
        'fields'   => array(

          // Header Select
          array(
            'id'           => 'select_header_design',
            'type'         => 'image_select',
            'title'        => esc_html__('Select Header Design', 'plumco'),
            'options'      => array(
              'style_one'    => PLUMCO_CS_IMAGES .'/hs-1.png',
              'style_two'    => PLUMCO_CS_IMAGES .'/hs-2.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'header_design',
            ),
            'radio'        => true,
            'default'   => 'style_one',
            'info' => esc_html__('Select your header design, following options will may differ based on your selection of header design.', 'plumco'),
          ),
          // Header Select

          // Extra's
          array(
            'type'    => 'notice',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('Extra\'s', 'plumco'),
          ),
          array(
            'id'    => 'sticky_header',
            'type'  => 'switcher',
            'title' => esc_html__('Sticky Header', 'plumco'),
            'info' => esc_html__('Turn On if you want your naviagtion bar on sticky.', 'plumco'),
            'default' => true,
          ),
          array(
            'id'    => 'plumco_header_search',
            'type'  => 'switcher',
            'title' => esc_html__('Header Search', 'plumco'),
            'info' => esc_html__('Turn On if you want to Hide Header Search .', 'plumco'),
            'default' => false,
          ),
          array(
            'id'    => 'plumco_menu_cta',
            'type'  => 'switcher',
            'title' => esc_html__('Header CTA', 'plumco'),
            'info' => esc_html__('Turn On if you want to Show Header CTA .', 'plumco'),
            'default' => false,
          ),
          array(
            'id'    => 'header_cta_text',
            'type'  => 'text',
            'title' => esc_html__('Header CTA Text', 'plumco'),
            'info' => esc_html__('Write Header CTA Text here.', 'plumco'),
            'type'        => 'text',
            'default' => 'Free Consultation',
            'dependency'  => array('plumco_menu_cta', '==', true),
          ),
          array(
            'id'    => 'header_cta_link',
            'type'  => 'text',
            'title' => esc_html__('Header CTA Link', 'plumco'),
            'info' => esc_html__('Write Header CTA Link here.', 'plumco'),
            'type'        => 'text',
            'default' => '#',
            'dependency'  => array('plumco_menu_cta', '==', true),
          ),
        )
      ),

      // header top bar
      array(
        'name'     => 'header_top_bar_tab',
        'title'    => esc_html__('Top Bar', 'plumco'),
        'icon'     => 'fa fa-minus',
        'fields'   => array(

          array(
            'id'          => 'top_bar',
            'type'        => 'switcher',
            'title'       => esc_html__('Hide Top Bar', 'plumco'),
            'on_text'     => esc_html__('Yes', 'plumco'),
            'off_text'    => esc_html__('No', 'plumco'),
            'default'     => true,
          ),
          array(
            'id'          => 'top_left',
            'title'       => esc_html__('Top left Block', 'plumco'),
            'desc'        => esc_html__('Top bar left block.', 'plumco'),
            'type'        => 'textarea',
            'shortcode'   => true,
            'dependency'  => array('top_bar', '==', false),
          ),
          array(
            'id'          => 'top_right',
            'title'       => esc_html__('Top Right Block', 'plumco'),
            'desc'        => esc_html__('Top bar right block.', 'plumco'),
            'type'        => 'textarea',
            'shortcode'   => true,
            'dependency'  => array('top_bar', '==', false),
          ),
        )
      ),

      // header banner
      array(
        'name'     => 'header_banner_tab',
        'title'    => esc_html__('Title Bar (or) Banner', 'plumco'),
        'icon'     => 'fa fa-bullhorn',
        'fields'   => array(

          // Title Area
          array(
            'type'    => 'notice',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('Title Area', 'plumco')
          ),
          array(
            'id'      => 'need_title_bar',
            'type'    => 'switcher',
            'title'   => esc_html__('Title Bar ?', 'plumco'),
            'label'   => esc_html__('If you want to Hide title bar in your sub-pages, please turn this ON.', 'plumco'),
            'default'    => false,
          ),
          array(
            'id'             => 'title_bar_padding',
            'type'           => 'select',
            'title'          => esc_html__('Padding Spaces Top & Bottom', 'plumco'),
            'options'        => array(
              'padding-default' => esc_html__('Default Spacing', 'plumco'),
              'padding-custom' => esc_html__('Custom Padding', 'plumco'),
            ),
            'dependency'   => array( 'need_title_bar', '==', 'false' ),
          ),
          array(
            'id'             => 'titlebar_top_padding',
            'type'           => 'text',
            'title'          => esc_html__('Padding Top', 'plumco'),
            'attributes' => array(
              'placeholder'     => '100px',
            ),
            'dependency'   => array( 'title_bar_padding', '==', 'padding-custom' ),
          ),
          array(
            'id'             => 'titlebar_bottom_padding',
            'type'           => 'text',
            'title'          => esc_html__('Padding Bottom', 'plumco'),
            'attributes' => array(
              'placeholder'     => '100px',
            ),
            'dependency'   => array( 'title_bar_padding', '==', 'padding-custom' ),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('Background Options', 'plumco'),
            'dependency' => array( 'need_title_bar', '==', 'false' ),
          ),
          array(
            'id'      => 'titlebar_bg_overlay_color',
            'type'    => 'color_picker',
            'title'   => esc_html__('Overlay Color', 'plumco'),
            'dependency' => array( 'need_title_bar', '==', 'false' ),
          ),
          array(
            'id'    => 'title_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Title Color', 'plumco'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('Breadcrumbs', 'plumco'),
          ),
         array(
            'id'      => 'need_breadcrumbs',
            'type'    => 'switcher',
            'title'   => esc_html__('Hide Breadcrumbs', 'plumco'),
            'label'   => esc_html__('If you want to hide breadcrumbs in your banner, please turn this ON.', 'plumco'),
            'default'    => false,
          ),
        )
      ),

    ),
  );

  // ------------------------------
  // Footer Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'footer_section',
    'title'    => esc_html__('Footer Settings', 'plumco'),
    'icon'     => 'fa fa-tasks',
    'sections' => array(

      // footer widgets
      array(
        'name'     => 'footer_widgets_tab',
        'title'    => esc_html__('Widget Area', 'plumco'),
        'icon'     => 'fa fa-th',
        'fields'   => array(

          // Footer Widget Block
          array(
            'type'    => 'notice',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('Footer Widget Block', 'plumco')
          ),
          array(
            'id'    => 'footer_widget_block',
            'type'  => 'switcher',
            'title' => esc_html__('Enable Widget Block', 'plumco'),
            'info' => __('If you turn this ON, then Goto : Appearance > Widgets. There you can see <strong>Footer Widget 1,2,3 or 4</strong> Widget Area, add your widgets there.', 'plumco'),
            'default' => true,
          ),
          array(
            'id'    => 'footer_widget_layout',
            'type'  => 'image_select',
            'title' => esc_html__('Widget Layouts', 'plumco'),
            'info' => esc_html__('Choose your footer widget theme-layouts.', 'plumco'),
            'default' => 4,
            'options' => array(
              1   => PLUMCO_CS_IMAGES . '/footer/footer-1.png',
              2   => PLUMCO_CS_IMAGES . '/footer/footer-2.png',
              3   => PLUMCO_CS_IMAGES . '/footer/footer-3.png',
              4   => PLUMCO_CS_IMAGES . '/footer/footer-4.png',
              5   => PLUMCO_CS_IMAGES . '/footer/footer-5.png',
              6   => PLUMCO_CS_IMAGES . '/footer/footer-6.png',
              7   => PLUMCO_CS_IMAGES . '/footer/footer-7.png',
              8   => PLUMCO_CS_IMAGES . '/footer/footer-8.png',
              9   => PLUMCO_CS_IMAGES . '/footer/footer-9.png',
            ),
            'radio'       => true,
            'dependency'  => array('footer_widget_block', '==', true),
          ),
           array(
            'id'    => 'plumco_ft_bg',
            'type'  => 'image',
            'title' => esc_html__('Footer Background', 'plumco'),
            'info'  => esc_html__('Upload your footer background.', 'plumco'),
            'add_title' => esc_html__('footer background', 'plumco'),
            'dependency'  => array('footer_widget_block', '==', true),
          ),

        )
      ),

      // footer copyright
      array(
        'name'     => 'footer_copyright_tab',
        'title'    => esc_html__('Copyright Bar', 'plumco'),
        'icon'     => 'fa fa-copyright',
        'fields'   => array(

          // Copyright
          array(
            'type'    => 'notice',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('Copyright Layout', 'plumco'),
          ),
         array(
            'id'    => 'hide_copyright',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Copyright?', 'plumco'),
            'default' => false,
            'on_text' => esc_html__('Yes', 'plumco'),
            'off_text' => esc_html__('No', 'plumco'),
            'label' => esc_html__('Yes, do it!', 'plumco'),
          ),
          array(
            'id'    => 'footer_copyright_layout',
            'type'  => 'image_select',
            'title' => esc_html__('Select Copyright Layout', 'plumco'),
            'info' => esc_html__('In above image, blue box is copyright text and yellow box is secondary text.', 'plumco'),
            'default'      => 'copyright-3',
            'options'      => array(
              'copyright-1'    => PLUMCO_CS_IMAGES .'/footer/copyright-1.png',
              ),
            'radio'        => true,
            'dependency'     => array('hide_copyright', '!=', true),
          ),
          array(
            'id'    => 'copyright_text',
            'type'  => 'textarea',
            'title' => esc_html__('Copyright Text', 'plumco'),
            'shortcode' => true,
            'dependency' => array('hide_copyright', '!=', true),
            'after'       => 'Helpful shortcodes: [current_year] [home_url] or any shortcode.',
          ),

          // Copyright Another Text
          array(
            'type'    => 'notice',
            'class'   => 'warning cs-plumco-heading',
            'content' => esc_html__('Copyright Secondary Text', 'plumco'),
             'dependency'     => array('hide_copyright', '!=', true),
          ),
          array(
            'id'    => 'secondary_text',
            'type'  => 'textarea',
            'title' => esc_html__('Secondary Text', 'plumco'),
            'shortcode' => true,
            'dependency'     => array('hide_copyright', '!=', true),
          ),

        )
      ),

    ),
  );

  // ------------------------------
  // Design
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_design',
    'title'  => esc_html__('Theme Design', 'plumco'),
    'icon'   => 'fa fa-sliders'
  );

  // ------------------------------
  // color section
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_color_section',
    'title'    => esc_html__('Colors', 'plumco'),
    'icon'     => 'fa fa-eyedropper',
    'fields' => array(

      array(
        'type'    => 'heading',
        'content' => esc_html__('Color Options', 'plumco'),
      ),
      array(
        'type'    => 'subheading',
        'wrap_class' => 'color-tab-content',
        'content' => esc_html__('All color options are available in our theme customizer. The reason of we used customizer options for color section is because, you can choose each part of color from there and see the changes instantly using customizer. Highly customizable colors are in Appearance > Customize', 'plumco'),
      ),

    ),
  );

  // ------------------------------
  // Typography section
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_typo_section',
    'title'    => esc_html__('Typography', 'plumco'),
    'icon'     => 'fa fa-header',
    'fields' => array(

      // Start fields
      array(
        'id'                  => 'typography',
        'type'                => 'group',
        'fields'              => array(
          array(
            'id'              => 'title',
            'type'            => 'text',
            'title'           => esc_html__('Title', 'plumco'),
          ),
          array(
            'id'              => 'selector',
            'type'            => 'textarea',
            'title'           => esc_html__('Selector', 'plumco'),
            'info'           => wp_kses( __('Enter css selectors like : <strong>body, .custom-class</strong>', 'plumco'), array( 'strong' => array() ) ),
          ),
          array(
            'id'              => 'font',
            'type'            => 'typography',
            'title'           => esc_html__('Font Family', 'plumco'),
          ),
          array(
            'id'              => 'size',
            'type'            => 'text',
            'title'           => esc_html__('Font Size', 'plumco'),
          ),
          array(
            'id'              => 'line_height',
            'type'            => 'text',
            'title'           => esc_html__('Line-Height', 'plumco'),
          ),
          array(
            'id'              => 'css',
            'type'            => 'textarea',
            'title'           => esc_html__('Custom CSS', 'plumco'),
          ),
        ),
        'button_title'        => esc_html__('Add New Typography', 'plumco'),
        'accordion_title'     => esc_html__('New Typography', 'plumco'),
      ),

      // Subset
      array(
        'id'                  => 'subsets',
        'type'                => 'select',
        'title'               => esc_html__('Subsets', 'plumco'),
        'class'               => 'chosen',
        'options'             => array(
          'latin'             => 'latin',
          'latin-ext'         => 'latin-ext',
          'cyrillic'          => 'cyrillic',
          'cyrillic-ext'      => 'cyrillic-ext',
          'greek'             => 'greek',
          'greek-ext'         => 'greek-ext',
          'vietnamese'        => 'vietnamese',
          'devanagari'        => 'devanagari',
          'khmer'             => 'khmer',
        ),
        'attributes'         => array(
          'data-placeholder' => 'Subsets',
          'multiple'         => 'multiple',
          'style'            => 'width: 200px;'
        ),
        'default'             => array( 'latin' ),
      ),

      array(
        'id'                  => 'font_weight',
        'type'                => 'select',
        'title'               => esc_html__('Font Weights', 'plumco'),
        'class'               => 'chosen',
        'options'             => array(
          '100'   => esc_html__('Thin 100', 'plumco'),
          '100i'  => esc_html__('Thin 100 Italic', 'plumco'),
          '200'   => esc_html__('Extra Light 200', 'plumco'),
          '200i'  => esc_html__('Extra Light 200 Italic', 'plumco'),
          '300'   => esc_html__('Light 300', 'plumco'),
          '300i'  => esc_html__('Light 300 Italic', 'plumco'),
          '400'   => esc_html__('Regular 400', 'plumco'),
          '400i'  => esc_html__('Regular 400 Italic', 'plumco'),
          '500'   => esc_html__('Medium 500', 'plumco'),
          '500i'  => esc_html__('Medium 500 Italic', 'plumco'),
          '600'   => esc_html__('Semi Bold 600', 'plumco'),
          '600i'  => esc_html__('Semi Bold 600 Italic', 'plumco'),
          '700'   => esc_html__('Bold 700', 'plumco'),
          '700i'  => esc_html__('Bold 700 Italic', 'plumco'),
          '800'   => esc_html__('Extra Bold 800', 'plumco'),
          '800i'  => esc_html__('Extra Bold 800 Italic', 'plumco'),
          '900'   => esc_html__('Black 900', 'plumco'),
          '900i'  => esc_html__('Black 900 Italic', 'plumco'),
        ),
        'attributes'         => array(
          'data-placeholder' => esc_html__('Font Weight', 'plumco'),
          'multiple'         => 'multiple',
          'style'            => 'width: 200px;'
        ),
        'default'             => array( '400' ),
      ),

      // Custom Fonts Upload
      array(
        'id'                 => 'font_family',
        'type'               => 'group',
        'title'              => esc_html__('Upload Custom Fonts', 'plumco'),
        'button_title'       => esc_html__('Add New Custom Font', 'plumco'),
        'accordion_title'    => esc_html__('Adding New Font', 'plumco'),
        'accordion'          => true,
        'desc'               => esc_html__('It is simple. Only add your custom fonts and click to save. After you can check "Font Family" selector. Do not forget to Save!', 'plumco'),
        'fields'             => array(

          array(
            'id'             => 'name',
            'type'           => 'text',
            'title'          => esc_html__('Font-Family Name', 'plumco'),
            'attributes'     => array(
              'placeholder'  => esc_html__('for eg. Arial', 'plumco')
            ),
          ),

          array(
            'id'             => 'ttf',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .ttf <small><i>(optional)</i></small>', 'plumco'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'plumco'),
              'button_title' => wp_kses(__('Upload <i>.ttf</i>', 'plumco'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'eot',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .eot <small><i>(optional)</i></small>', 'plumco'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'plumco'),
              'button_title' => wp_kses(__('Upload <i>.eot</i>', 'plumco'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'otf',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .otf <small><i>(optional)</i></small>', 'plumco'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'plumco'),
              'button_title' => wp_kses(__('Upload <i>.otf</i>', 'plumco'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'woff',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .woff <small><i>(optional)</i></small>', 'plumco'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'plumco'),
              'button_title' =>wp_kses(__('Upload <i>.woff</i>', 'plumco'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'css',
            'type'           => 'textarea',
            'title'          => wp_kses(__('Extra CSS Style <small><i>(optional)</i></small>', 'plumco'), array( 'small' => array(), 'i' => array() )),
            'attributes'     => array(
              'placeholder'  => esc_html__('for eg. font-weight: normal;', 'plumco'),
            ),
          ),

        ),
      ),
      // End All field

    ),
  );

  // ------------------------------
  // Pages
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_pages',
    'title'  => esc_html__('Custom Pages', 'plumco'),
    'icon'   => 'fa fa-folder-open-o'
  );


  // ------------------------------
  // Service Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'service_section',
    'title'    => esc_html__('Service', 'plumco'),
    'icon'     => 'fa fa-clone',
    'fields' => array(

      // service name change
      array(
        'type'    => 'notice',
        'class'   => 'info cs-tmx-heading',
        'content' => esc_html__('Name Change', 'plumco')
      ),
      array(
        'id'      => 'theme_service_name',
        'type'    => 'text',
        'title'   => esc_html__('Service Name', 'plumco'),
        'attributes'     => array(
          'placeholder'  => 'Service'
        ),
      ),
      array(
        'id'      => 'theme_service_slug',
        'type'    => 'text',
        'title'   => esc_html__('Service Slug', 'plumco'),
        'attributes'     => array(
          'placeholder'  => 'service-item'
        ),
      ),
      array(
        'id'      => 'theme_service_cat_slug',
        'type'    => 'text',
        'title'   => esc_html__('Service Category Slug', 'plumco'),
        'attributes'     => array(
          'placeholder'  => 'service-category'
        ),
      ),
      array(
        'type'    => 'notice',
        'class'   => 'danger',
        'content' => __('<strong>Important</strong>: Please do not set service slug and page slug as same. It\'ll not work.', 'plumco')
      ),
      // Service Start
      array(
        'type'    => 'notice',
        'class'   => 'info cs-plumco-heading',
        'content' => esc_html__('Service Single', 'plumco')
      ),
      array(
          'id'             => 'service_sidebar_position',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Position', 'plumco'),
          'options'        => array(
            'sidebar-right' => esc_html__('Right', 'plumco'),
            'sidebar-left' => esc_html__('Left', 'plumco'),
            'sidebar-hide' => esc_html__('Hide', 'plumco'),
          ),
          'default_option' => 'Select sidebar position',
          'info'          => esc_html__('Default option : Right', 'plumco'),
        ),
        array(
          'id'             => 'single_service_widget',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Widget', 'plumco'),
          'options'        => plumco_registered_sidebars(),
          'default_option' => esc_html__('Select Widget', 'plumco'),
          'dependency'     => array('service_sidebar_position', '!=', 'sidebar-hide'),
          'info'          => esc_html__('Default option : Main Widget Area', 'plumco'),
        ),
        array(
          'id'    => 'service_comment_form',
          'type'  => 'switcher',
          'title' => esc_html__('Comment Area/Form', 'plumco'),
          'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this OFF.', 'plumco'),
          'default' => true,
        ),
    ),
  );

  
  // ------------------------------
  // Project Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'project_section',
    'title'    => esc_html__('Project', 'plumco'),
    'icon'     => 'fa fa-medkit',
    'fields' => array(

      // project name change
      array(
        'type'    => 'notice',
        'class'   => 'info cs-tmx-heading',
        'content' => esc_html__('Name Change', 'plumco')
      ),
      array(
        'id'      => 'theme_project_name',
        'type'    => 'text',
        'title'   => esc_html__('Project Name', 'plumco'),
        'attributes'     => array(
          'placeholder'  => 'Project'
        ),
      ),
      array(
        'id'      => 'theme_project_slug',
        'type'    => 'text',
        'title'   => esc_html__('Project Slug', 'plumco'),
        'attributes'     => array(
          'placeholder'  => 'project-item'
        ),
      ),
      array(
        'id'      => 'theme_project_cat_slug',
        'type'    => 'text',
        'title'   => esc_html__('Project Category Slug', 'plumco'),
        'attributes'     => array(
          'placeholder'  => 'project-category'
        ),
      ),
      array(
        'type'    => 'notice',
        'class'   => 'danger',
        'content' => __('<strong>Important</strong>: Please do not set project slug and page slug as same. It\'ll not work.', 'plumco')
      ),

      // Project Start
      array(
        'type'    => 'notice',
        'class'   => 'info cs-plumco-heading',
        'content' => esc_html__('Project Single', 'plumco')
      ),
      array(
          'id'             => 'project_sidebar_position',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Position', 'plumco'),
          'options'        => array(
            'sidebar-right' => esc_html__('Right', 'plumco'),
            'sidebar-left' => esc_html__('Left', 'plumco'),
            'sidebar-hide' => esc_html__('Hide', 'plumco'),
          ),
          'default_option' => 'Select sidebar position',
          'info'          => esc_html__('Default option : Right', 'plumco'),
        ),
        array(
          'id'             => 'single_project_widget',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Widget', 'plumco'),
          'options'        => plumco_registered_sidebars(),
          'default_option' => esc_html__('Select Widget', 'plumco'),
          'dependency'     => array('project_sidebar_position', '!=', 'sidebar-hide'),
          'info'          => esc_html__('Default option : Main Widget Area', 'plumco'),
        ),
        array(
          'id'    => 'project_comment_form',
          'type'  => 'switcher',
          'title' => esc_html__('Comment Area/Form', 'plumco'),
          'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this OFF.', 'plumco'),
          'default' => true,
        ),
    ),
  );

  // ------------------------------
  // Blog Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'blog_section',
    'title'    => esc_html__('Blog Settings', 'plumco'),
    'icon'     => 'fa fa-newspaper-o',
    'sections' => array(

      // blog general section
      array(
        'name'     => 'blog_general_tab',
        'title'    => esc_html__('General', 'plumco'),
        'icon'     => 'fa fa-cog',
        'fields'   => array(

          // Layout
          array(
            'type'    => 'notice',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('Layout', 'plumco')
          ),
          array(
            'id'             => 'blog_sidebar_position',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Position', 'plumco'),
            'options'        => array(
              'sidebar-right' => esc_html__('Right', 'plumco'),
              'sidebar-left' => esc_html__('Left', 'plumco'),
              'sidebar-hide' => esc_html__('Hide', 'plumco'),
            ),
            'default_option' => 'Select sidebar position',
            'help'          => esc_html__('This style will apply, default blog pages - Like : Archive, Category, Tags, Search & Author.', 'plumco'),
            'info'          => esc_html__('Default option : Right', 'plumco'),
          ),
          array(
            'id'             => 'blog_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'plumco'),
            'options'        => plumco_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'plumco'),
            'dependency'     => array('blog_sidebar_position', '!=', 'sidebar-hide'),
            'info'          => esc_html__('Default option : Main Widget Area', 'plumco'),
          ),
          // Layout
          // Global Options
          array(
            'type'    => 'notice',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('Global Options', 'plumco')
          ),
          array(
            'id'         => 'theme_exclude_categories',
            'type'       => 'checkbox',
            'title'      => esc_html__('Exclude Categories', 'plumco'),
            'info'      => esc_html__('Select categories you want to exclude from blog page.', 'plumco'),
            'options'    => 'categories',
          ),
          array(
            'id'      => 'theme_blog_excerpt',
            'type'    => 'text',
            'title'   => esc_html__('Excerpt Length', 'plumco'),
            'info'   => esc_html__('Blog short content length, in blog listing pages.', 'plumco'),
            'default' => '55',
          ),
          array(
            'id'      => 'theme_metas_hide',
            'type'    => 'checkbox',
            'title'   => esc_html__('Meta\'s to hide', 'plumco'),
            'info'    => esc_html__('Check items you want to hide from blog/post meta field.', 'plumco'),
            'class'      => 'horizontal',
            'options'    => array(
              'category'   => esc_html__('Category', 'plumco'),
              'date'    => esc_html__('Date', 'plumco'),
              'author'     => esc_html__('Author', 'plumco'),
              'comments'      => esc_html__('Comments', 'plumco'),
              'Tag'      => esc_html__('Tag', 'plumco'),
            ),
            // 'default' => '30',
          ),
          // End fields

        )
      ),

      // blog single section
      array(
        'name'     => 'blog_single_tab',
        'title'    => esc_html__('Single', 'plumco'),
        'icon'     => 'fa fa-sticky-note',
        'fields'   => array(

          // Start fields
          array(
            'type'    => 'notice',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('Enable / Disable', 'plumco')
          ),
          array(
            'id'    => 'single_featured_image',
            'type'  => 'switcher',
            'title' => esc_html__('Featured Image', 'plumco'),
            'info' => esc_html__('If need to hide featured image from single blog post page, please turn this OFF.', 'plumco'),
            'default' => true,
          ),
           array(
            'id'    => 'single_author_info',
            'type'  => 'switcher',
            'title' => esc_html__('Author Info', 'plumco'),
            'info' => esc_html__('If need to hide author info on single blog page, please turn this On.', 'plumco'),
            'default' => false,
          ),
          array(
            'id'    => 'single_share_option',
            'type'  => 'switcher',
            'title' => esc_html__('Share Option', 'plumco'),
            'info' => esc_html__('If need to hide share option on single blog page, please turn this OFF.', 'plumco'),
            'default' => true,
          ),
          array(
            'id'    => 'single_comment_form',
            'type'  => 'switcher',
            'title' => esc_html__('Comment Area/Form ?', 'plumco'),
            'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this On.', 'plumco'),
            'default' => false,
          ),
          array(
            'type'    => 'notice',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('Sidebar', 'plumco')
          ),
          array(
            'id'             => 'single_sidebar_position',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Position', 'plumco'),
            'options'        => array(
              'sidebar-right' => esc_html__('Right', 'plumco'),
              'sidebar-left' => esc_html__('Left', 'plumco'),
              'sidebar-hide' => esc_html__('Hide', 'plumco'),
            ),
            'default_option' => 'Select sidebar position',
            'info'          => esc_html__('Default option : Right', 'plumco'),
          ),
          array(
            'id'             => 'single_blog_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'plumco'),
            'options'        => plumco_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'plumco'),
            'dependency'     => array('single_sidebar_position', '!=', 'sidebar-hide'),
            'info'          => esc_html__('Default option : Main Widget Area', 'plumco'),
          ),
          // End fields

        )
      ),

    ),
  );

if (class_exists( 'WooCommerce' )){
  // ------------------------------
  // WooCommerce Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'woocommerce_section',
    'title'    => esc_html__('WooCommerce', 'plumco'),
    'icon'     => 'fa fa-shopping-basket',
    'fields' => array(

      // Start fields
      array(
        'type'    => 'notice',
        'class'   => 'info cs-plumco-heading',
        'content' => esc_html__('Layout', 'plumco')
      ),
     array(
        'id'             => 'woo_product_columns',
        'type'           => 'select',
        'title'          => esc_html__('Product Column', 'plumco'),
        'options'        => array(
          2 => esc_html__('Two Column', 'plumco'),
          3 => esc_html__('Three Column', 'plumco'),
          4 => esc_html__('Four Column', 'plumco'),
        ),
        'default_option' => esc_html__('Select Product Columns', 'plumco'),
        'help'          => esc_html__('This style will apply, default woocommerce shop and archive pages.', 'plumco'),
      ),
      array(
        'id'             => 'woo_sidebar_position',
        'type'           => 'select',
        'title'          => esc_html__('Sidebar Position', 'plumco'),
        'options'        => array(
          'right-sidebar' => esc_html__('Right', 'plumco'),
          'left-sidebar' => esc_html__('Left', 'plumco'),
          'sidebar-hide' => esc_html__('Hide', 'plumco'),
        ),
        'default_option' => esc_html__('Select sidebar position', 'plumco'),
        'info'          => esc_html__('Default option : Right', 'plumco'),
      ),
      array(
        'id'             => 'woo_widget',
        'type'           => 'select',
        'title'          => esc_html__('Sidebar Widget', 'plumco'),
        'options'        => plumco_registered_sidebars(),
        'default_option' => esc_html__('Select Widget', 'plumco'),
        'dependency'     => array('woo_sidebar_position', '!=', 'sidebar-hide'),
        'info'          => esc_html__('Default option : Shop Page', 'plumco'),
      ),

      array(
        'type'    => 'notice',
        'class'   => 'info cs-plumco-heading',
        'content' => esc_html__('Listing', 'plumco')
      ),
      array(
        'id'      => 'theme_woo_limit',
        'type'    => 'text',
        'title'   => esc_html__('Product Limit', 'plumco'),
        'info'   => esc_html__('Enter the number value for per page products limit.', 'plumco'),
      ),
      // End fields

      // Start fields
      array(
        'type'    => 'notice',
        'class'   => 'info cs-plumco-heading',
        'content' => esc_html__('Single Product', 'plumco')
      ),
      array(
        'id'             => 'woo_related_limit',
        'type'           => 'text',
        'title'          => esc_html__('Related Products Limit', 'plumco'),
      ),
      array(
        'id'    => 'woo_single_upsell',
        'type'  => 'switcher',
        'title' => esc_html__('You May Also Like', 'plumco'),
        'info' => esc_html__('If you don\'t want \'You May Also Like\' products in single product page, please turn this ON.', 'plumco'),
        'default' => false,
      ),
      array(
        'id'    => 'woo_single_related',
        'type'  => 'switcher',
        'title' => esc_html__('Related Products', 'plumco'),
        'info' => esc_html__('If you don\'t want \'Related Products\' in single product page, please turn this ON.', 'plumco'),
        'default' => false,
      ),
      // End fields

    ),
  );
}

  // ------------------------------
  // Extra Pages
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_extra_pages',
    'title'    => esc_html__('404 & Maintenance', 'plumco'),
    'icon'     => 'fa fa-cogs',
    'sections' => array(

      // error 404 page
      array(
        'name'     => 'error_page_section',
        'title'    => esc_html__('404 Page', 'plumco'),
        'icon'     => 'fa fa-exclamation-triangle',
        'fields'   => array(

          // Start 404 Page
          array(
            'id'    => 'error_heading',
            'type'  => 'text',
            'title' => esc_html__('404 Page Heading', 'plumco'),
            'info'  => esc_html__('Enter 404 page heading.', 'plumco'),
          ),
          array(
            'id'    => 'error_subheading',
            'type'  => 'textarea',
            'title' => esc_html__('404 Page Sub Heading', 'plumco'),
            'info'  => esc_html__('Enter 404 page Sub heading.', 'plumco'),
          ),
          array(
            'id'    => 'error_page_content',
            'type'  => 'textarea',
            'title' => esc_html__('404 Page Content', 'plumco'),
            'info'  => esc_html__('Enter 404 page content.', 'plumco'),
            'shortcode' => true,
          ),
          array(
            'id'    => 'error_btn_text',
            'type'  => 'text',
            'title' => esc_html__('Button Text', 'plumco'),
            'info'  => esc_html__('Enter BACK TO HOME button text. If you want to change it.', 'plumco'),
          ),
          // End 404 Page

        ) // end: fields
      ), // end: fields section

      // maintenance mode page
      array(
        'name'     => 'maintenance_mode_section',
        'title'    => esc_html__('Maintenance Mode', 'plumco'),
        'icon'     => 'fa fa-hourglass-half',
        'fields'   => array(

          // Start Maintenance Mode
          array(
            'type'    => 'notice',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('If you turn this ON : Only Logged in users will see your pages. All other visiters will see, selected page of : <strong>Maintenance Mode Page</strong>', 'plumco')
          ),
          array(
            'id'             => 'enable_maintenance_mode',
            'type'           => 'switcher',
            'title'          => esc_html__('Maintenance Mode', 'plumco'),
            'default'        => false,
          ),
          array(
            'id'             => 'maintenance_mode_page',
            'type'           => 'select',
            'title'          => esc_html__('Maintenance Mode Page', 'plumco'),
            'options'        => 'pages',
            'default_option' => esc_html__('Select a page', 'plumco'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          array(
            'id'             => 'maintenance_mode_title',
            'type'           => 'text',
            'title'          => esc_html__('Maintenance Mode Text', 'plumco'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          array(
            'id'             => 'maintenance_mode_text',
            'type'           => 'textarea',
            'title'          => esc_html__('Maintenance Mode Text', 'plumco'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          array(
            'id'             => 'maintenance_mode_bg',
            'type'           => 'background',
            'title'          => esc_html__('Page Background', 'plumco'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          // End Maintenance Mode

        ) // end: fields
      ), // end: fields section

    )
  );

  // ------------------------------
  // Advanced
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_advanced',
    'title'  => esc_html__('Advanced Settings', 'plumco'),
    'icon'   => 'fa fa-cogs'
  );

  // ------------------------------
  // Misc Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'misc_section',
    'title'    => esc_html__('Multisystem', 'plumco'),
    'icon'     => 'fa fa-hourglass-half',
    'sections' => array(

      // custom sidebar section
      array(
        'name'     => 'custom_sidebar_section',
        'title'    => esc_html__('Custom Sidebar', 'plumco'),
        'icon'     => 'fa fa-reorder',
        'fields'   => array(

          // start fields
          array(
            'id'              => 'custom_sidebar',
            'title'           => esc_html__('Sidebars', 'plumco'),
            'desc'            => esc_html__('Go to Appearance -> Widgets after create sidebars', 'plumco'),
            'type'            => 'group',
            'fields'          => array(
              array(
                'id'          => 'sidebar_name',
                'type'        => 'text',
                'title'       => esc_html__('Sidebar Name', 'plumco'),
              ),
              array(
                'id'          => 'sidebar_desc',
                'type'        => 'text',
                'title'       => esc_html__('Custom Description', 'plumco'),
              )
            ),
            'accordion'       => true,
            'button_title'    => esc_html__('Add New Sidebar', 'plumco'),
            'accordion_title' => esc_html__('New Sidebar', 'plumco'),
          ),
          // end fields

        )
      ),
      // custom sidebar section

      // Custom CSS/JS
      array(
        'name'        => 'custom_css_js_section',
        'title'       => esc_html__('Custom Codes', 'plumco'),
        'icon'        => 'fa fa-code',

        // begin: fields
        'fields'      => array(
          // Start Custom CSS/JS
          array(
            'type'    => 'notice',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('Custom JS', 'plumco')
          ),
          array(
            'id'             => 'theme_custom_js',
            'type'           => 'textarea',
            'attributes' => array(
              'rows'     => 10,
              'placeholder'     => esc_html__('Enter your JS code here...', 'plumco'),
            ),
          ),
          // End Custom CSS/JS

        ) // end: fields
      ),

      // Translation
      array(
        'name'        => 'theme_translation_section',
        'title'       => esc_html__('Translation', 'plumco'),
        'icon'        => 'fa fa-language',

        // begin: fields
        'fields'      => array(

          // Start Translation
          array(
            'type'    => 'notice',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('Common Texts', 'plumco')
          ),
          array(
            'id'          => 'read_more_text',
            'type'        => 'text',
            'title'       => esc_html__('Read More Text', 'plumco'),
          ),
          array(
            'id'          => 'view_more_text',
            'type'        => 'text',
            'title'       => esc_html__('View More Text', 'plumco'),
          ),
          array(
            'id'          => 'share_text',
            'type'        => 'text',
            'title'       => esc_html__('Share Text', 'plumco'),
          ),
          array(
            'id'          => 'share_on_text',
            'type'        => 'text',
            'title'       => esc_html__('Share On Tooltip Text', 'plumco'),
          ),
          array(
            'id'          => 'author_text',
            'type'        => 'text',
            'title'       => esc_html__('Author Text', 'plumco'),
          ),
          array(
            'id'          => 'post_comment_text',
            'type'        => 'text',
            'title'       => esc_html__('Post Comment Text [Submit Button]', 'plumco'),
          ),
          array(
            'type'    => 'notice',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('WooCommerce', 'plumco')
          ),
          array(
            'id'          => 'add_to_cart_text',
            'type'        => 'text',
            'title'       => esc_html__('Add to Cart Text', 'plumco'),
          ),
          array(
            'id'          => 'details_text',
            'type'        => 'text',
            'title'       => esc_html__('Details Text', 'plumco'),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('Pagination', 'plumco')
          ),
          array(
            'id'          => 'older_post',
            'type'        => 'text',
            'title'       => esc_html__('Older Posts Text', 'plumco'),
          ),
          array(
            'id'          => 'newer_post',
            'type'        => 'text',
            'title'       => esc_html__('Newer Posts Text', 'plumco'),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-plumco-heading',
            'content' => esc_html__('Single Portfolio Pagination', 'plumco')
          ),
          array(
            'id'          => 'prev_port',
            'type'        => 'text',
            'title'       => esc_html__('Prev Case Text', 'plumco'),
          ),
          array(
            'id'          => 'next_port',
            'type'        => 'text',
            'title'       => esc_html__('Next Case Text', 'plumco'),
          ),
          // End Translation

        ) // end: fields
      ),

    ),
  );

  
  // ------------------------------
  // backup                       -
  // ------------------------------
  $options[]   = array(
    'name'     => 'backup_section',
    'title'    => 'Backup',
    'icon'     => 'fa fa-shield',
    'fields'   => array(

      array(
        'type'    => 'notice',
        'class'   => 'warning',
        'content' => esc_html__('You can save your current options. Download a Backup and Import.', 'plumco'),
      ),

      array(
        'type'    => 'backup',
      ),

    )
  );

  return $options;

}
add_filter( 'cs_framework_options', 'plumco_options' );