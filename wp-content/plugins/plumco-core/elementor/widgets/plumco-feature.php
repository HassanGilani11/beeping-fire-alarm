<?php
/*
 * Elementor Plumco Feature Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Plumco_Feature extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-plumco_feature';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'How It Works', 'plumco-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-time-line';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Plumco Feature widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-plumco_feature'];
	}
	
	/**
	 * Register Plumco Feature widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_feature',
			[
				'label' => esc_html__( 'Feature Options', 'plumco-core' ),
			]
		);
		$this->add_control(
			'feature_style',
			[
				'label' => esc_html__( 'Feature Style', 'finco-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__( 'Style One', 'finco-core' ),
					'style-two' => esc_html__( 'Style Two', 'finco-core' ),
					'style-three' => esc_html__( 'Style Three', 'finco-core' ),
				],
				'default' => 'style-one',
				'description' => esc_html__( 'Select your feature style.', 'finco-core' ),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'feature_title',
			[
				'label' => esc_html__( 'Title Text', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '24/7 customer support.', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'feature_image',
			[
				'label' => esc_html__( 'Feature Image', 'plumco-core' ),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'plumco-core'),
			]
		);
		$repeater->add_control(
			'feature_arrow',
			[
				'label' => esc_html__( 'Feature Arrow', 'plumco-core' ),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'plumco-core'),
			]
		);
		$repeater->add_control(
			'feature_link',
			[
				'label' => esc_html__( 'link', 'plumco-core' ),
				'default' => esc_html__( '#', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type your link here', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_control(
			'featureItems_groups',
			[
				'label' => esc_html__( 'Feature Icons', 'plumco-core' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'feature_title' => esc_html__( 'Feature', 'plumco-core' ),
					],
					
				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ feature_title }}}',
			]
		);
		$this->end_controls_section();// end: Section
		

		$this->start_controls_section(
			'section_feature_section_style',
			[
				'label' => esc_html__( 'Feature BG', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'feature_item_bg_color',
			[
				'label' => esc_html__( 'BG Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-features-section .wpo-features-item, .wpo-features-section-s2 .wpo-features-item, .wpo-work-section .wpo-work-wrap .wpo-work-item' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'feature_item_active_bg_color',
			[
				'label' => esc_html__( 'Active BG Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-features-section .col:nth-child(2) .wpo-features-item, .wpo-features-section-s2 .col:nth-child(2) .wpo-features-item, .wpo-work-section .wpo-work-wrap .wpo-work-item:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section


		
		// Title
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'plumco-core' ),
				'name' => 'plumco_title_typography',
				'selector' => '{{WRAPPER}} .wpo-features-section .wpo-features-item .wpo-features-text h4, .wpo-features-section-s2 .wpo-features-item .wpo-features-text h4, .wpo-work-section .wpo-work-wrap .wpo-work-item .wpo-work-text h2 a',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-features-section .wpo-features-item .wpo-features-text h4 a, .wpo-features-section-s2 .wpo-features-item .wpo-features-text h4 a, .wpo-work-section .wpo-work-wrap .wpo-work-item .wpo-work-text h2 a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_active_color',
			[
				'label' => esc_html__( 'Active Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'feature_style' => array('style-one','style-two'),
				],
				'selectors' => [
					'{{WRAPPER}} .wpo-features-section .wpo-features-item.active .wpo-features-text h4 a, .wpo-features-section-s2 .wpo-features-item.active .wpo-features-text h4 a' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'title_padding',
			[
				'label' => __( 'Title Padding', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-features-section .wpo-features-item .wpo-features-text h4, .wpo-features-section-s2 .wpo-features-item .wpo-features-text h4, .wpo-work-section .wpo-work-wrap .wpo-work-item .wpo-work-text h2 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

	
	}

	/**
	 * Render Feature widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$featureItems_groups = !empty( $settings['featureItems_groups'] ) ? $settings['featureItems_groups'] : [];
		$feature_style = !empty( $settings['feature_style'] ) ? $settings['feature_style'] : '';
		// Turn output buffer on

		if ( $feature_style == 'style-one') {
			$feature_wrap = 'wpo-features-section';
		} elseif ( $feature_style == 'style-two') {
			$feature_wrap = 'wpo-features-section-s2';
		}	else {
			$feature_wrap = 'wpo-work-section';
		}

		ob_start(); ?>

	<?php if ( $feature_style == 'style-three' ) { ?>
	<div class="wpo-work-section">
	    <div class="container">
	        <div class="wpo-work-wrap">
	            <div class="row">
	            	<?php
					      	$id = 0;
			        		// Group Param Output
									if( is_array( $featureItems_groups ) && !empty( $featureItems_groups ) ){
									foreach ( $featureItems_groups as $each_item ) { 	
									$id++;
									
									$feature_title = !empty( $each_item['feature_title'] ) ? $each_item['feature_title'] : '';
									$feature_link = !empty( $each_item['feature_link'] ) ? $each_item['feature_link'] : '';
									
									$bg_image = !empty( $each_item['feature_image']['id'] ) ? $each_item['feature_image']['id'] : '';
									$bg_arrow = !empty( $each_item['feature_arrow']['id'] ) ? $each_item['feature_arrow']['id'] : '';
									// Image
									$image_url = wp_get_attachment_url( $bg_image );
									$image_alt = get_post_meta( $bg_image, '_wp_attachment_image_alt', true);

									// Image
									$arrow_url = wp_get_attachment_url( $bg_arrow );
									$arrow_alt = get_post_meta( $bg_arrow, '_wp_attachment_image_alt', true);

									if ( $feature_link ) {
							      $link_o = '<a href="'. $feature_link .'" class="more">';
							      $link_c = '</a>';
							    } else {
							      $link_o = '';
							      $link_c = '';
							    }
						    
						    	if ( $id == '2') {
						    		$active_class = 'active';
						    	} else {
						    		$active_class = 'not-active';
						    	}

								?>
	                <div class="col col-lg-6 col-md-6 col-12">
	                    <div class="wpo-work-item">
	                        <div class="wpo-work-icon">
	                          <?php if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_url( $image_alt ).'">'; }  ?>
	                        </div>
	                        <div class="wpo-work-text">
	                        	<?php if( $feature_title ) { echo '<h2>'.$link_o.''.esc_html( $feature_title ).''.$link_c.'</h2>'; } ?>
	                        </div>
	                    </div>
	                </div>
	              <?php }
								} ?>
	            </div>
	        </div>
	    </div>
	</div>
	<?php } else { ?>
	<div class="<?php echo esc_attr( $feature_wrap ); ?>">
	  <div class="container">
      <div class="wpo-features-wrap">
          <div class="row align-items-center justify-content-between">
              <?php
			      	$id = 0;
	        		// Group Param Output
							if( is_array( $featureItems_groups ) && !empty( $featureItems_groups ) ){
							foreach ( $featureItems_groups as $each_item ) { 	
							$id++;
							
							$feature_title = !empty( $each_item['feature_title'] ) ? $each_item['feature_title'] : '';
							$feature_link = !empty( $each_item['feature_link'] ) ? $each_item['feature_link'] : '';
							
							$bg_image = !empty( $each_item['feature_image']['id'] ) ? $each_item['feature_image']['id'] : '';
							$bg_arrow = !empty( $each_item['feature_arrow']['id'] ) ? $each_item['feature_arrow']['id'] : '';
							// Image
							$image_url = wp_get_attachment_url( $bg_image );
							$image_alt = get_post_meta( $bg_image, '_wp_attachment_image_alt', true);

							// Image
							$arrow_url = wp_get_attachment_url( $bg_arrow );
							$arrow_alt = get_post_meta( $bg_arrow, '_wp_attachment_image_alt', true);

							if ( $feature_link ) {
					      $link_o = '<a href="'. $feature_link .'" class="more">';
					      $link_c = '</a>';
					    } else {
					      $link_o = '';
					      $link_c = '';
					    }
				    
				    	if ( $id == '2') {
				    		$active_class = 'active';
				    	} else {
				    		$active_class = 'not-active';
				    	}

				    	if ( $id == '3' ) {
				    		$col_class = 'col-12';
				    	} else {
				    		$col_class = 'col-6';
				    	}

						?>
            <div class="col col-lg-4 col-md-4 col-sm-4 <?php echo esc_attr( $col_class ); ?>">
                <div class="wpo-features-item <?php echo esc_attr( $active_class ); ?>">
                    <div class="wpo-features-icon">
                      <?php if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_url( $image_alt ).'">'; }  ?>
                    </div>
                    <div class="wpo-features-text">
                       <?php if( $feature_title ) { echo '<h4>'.$link_o.''.esc_html( $feature_title ).''.$link_c.'</h4>'; } ?>
                    </div>
                </div>
              
              <?php if ( $id == '1' ) { ?>
			    		 <div class="angle">
              	 <?php if( $arrow_url ) { echo '<img src="'.esc_url( $arrow_url ).'" alt="'.esc_url( $arrow_alt ).'">'; }  ?>
              </div> 
				    	<?php } elseif( $id == '2' ) {?>
				    		<div class="angle">
              	 <?php if( $arrow_url ) { echo '<img src="'.esc_url( $arrow_url ).'" alt="'.esc_url( $arrow_alt ).'">'; }  ?>
              </div> 
            	<?php } else {

            	} ?>
            </div>
						<?php }
						} ?>
          </div>
      </div>
  </div>
</div>
		<?php } 
			// Return outbut buffer
			echo ob_get_clean();	
		}
	/**
	 * Render Feature widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Plumco_Feature() );