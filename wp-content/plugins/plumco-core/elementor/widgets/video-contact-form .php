<?php
/*
 * Elementor Plumco Video Form 7 Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Plumco_Video_Form extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-plumco_video_form';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Video Form', 'plumco-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Plumco Video Form widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	/*
	public function get_script_depends() {
		return ['wpo-plumco_video_form'];
	}
	 */
	
	/**
	 * Register Plumco Video Form widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_video_form',
			[
				'label' => esc_html__( 'Form Options', 'plumco-core' ),
			]
		);
		$this->add_control(
			'section_title',
			[
				'label' => esc_html__( 'Title Text', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title Text', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'section_content',
			[
				'label' => esc_html__( 'Content Text', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Content Text', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type Content text here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'video_link',
			[
				'label' => esc_html__( 'Video Link', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type video link here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'form_image',
			[
				'label' => esc_html__( 'Form Image', 'plumco-core' ),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'plumco-core'),
			]
		);
		$this->add_control(
			'form_shape',
			[
				'label' => esc_html__( 'Form Shape', 'plumco-core' ),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'plumco-core'),
			]
		);
		$this->add_control(
			'form_id',
			[
				'label' => esc_html__( 'Select video form', 'plumco-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => Controls_Helper_Output::get_posts('wpcf7_contact_form'),
			]
		);
		$this->end_controls_section();// end: Section


		// Title 
		$this->start_controls_section(
			'section_title_shape_style',
			[
				'label' => esc_html__( 'Form', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'form_area_color',
			[
				'label' => esc_html__( 'Background', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-section' => 'background-color: {{VALUE}};',
				],
			]
		);	
		$this->end_controls_section();// end: Section

		// Title Style
		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' => esc_html__( 'Sub Title', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'plumco_subtitle_typography',
				'selector' => '{{WRAPPER}} .wpo-contact-section .wpo-section-title-s2 span',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-section .wpo-section-title-s2 span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_pad',
			[
				'label' => esc_html__( 'Padding', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-section .wpo-section-title-s2 span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// Title Style
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
				'name' => 'plumco_title_typography',
				'selector' => '{{WRAPPER}} .wpo-contact-section .wpo-section-title-s2 h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-section .wpo-section-title-s2 h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_pad',
			[
				'label' => esc_html__( 'Padding', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-section .wpo-section-title-s2 h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

	
	// form style
		$this->start_controls_section(
			'section_form_style',
			[
				'label' => esc_html__( 'Form', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'form_typography',
				'selector' => '{{WRAPPER}} .wpo-contact-form-area .form-area input[type="text"], 
				{{WRAPPER}} .wpo-contact-form-area .form-area input[type="email"], 
				{{WRAPPER}} .wpo-contact-form-area .form-area input[type="date"], 
				{{WRAPPER}} .wpo-contact-form-area .form-area input[type="time"], 
				{{WRAPPER}} .wpo-contact-form-area .form-area input[type="number"], 
				{{WRAPPER}} .wpo-contact-form-area .form-area textarea, 
				{{WRAPPER}} .wpo-contact-form-area .form-area select, 
				{{WRAPPER}} .wpo-contact-form-area .form-area .form-control, 
				{{WRAPPER}} .track-video .track-trace select, 
				{{WRAPPER}} .track-video .track-trace input',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'form_border',
				'label' => esc_html__( 'Border', 'plumco-core' ),
				'selector' => '{{WRAPPER}} .wpo-contact-form-area .form-area input[type="text"], 
				{{WRAPPER}} .wpo-contact-form-area .form-area input[type="email"], 
				{{WRAPPER}} .wpo-contact-form-area .form-areainput[type="date"], 
				{{WRAPPER}} .wpo-contact-form-area .form-area input[type="time"], 
				{{WRAPPER}} .wpo-contact-form-area .form-area input[type="number"], 
				{{WRAPPER}} .wpo-contact-form-area .form-area textarea, 
				{{WRAPPER}} .wpo-contact-form-area .form-area select, 
				{{WRAPPER}} .wpo-contact-form-area .form-area .form-control, 
				{{WRAPPER}} .wpo-contact-form-area .form-area .nice-select,
				{{WRAPPER}} .track-video .track-trace select, 
				{{WRAPPER}} .track-video .track-trace input',

			]
		);
		$this->add_control(
			'placeholder_text_color',
			[
				'label' => __( 'Placeholder Text Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-form-area .form-area input:not([type="submit"])::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-contact-form-area .form-area input:not([type="submit"])::-moz-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-contact-form-area .form-area input:not([type="submit"])::-ms-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-contact-form-area .form-area input:not([type="submit"])::-o-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-contact-form-area .form-area textarea::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-contact-form-area .form-area textarea::-moz-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-contact-form-area .form-area textarea::-ms-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-contact-form-area .form-area textarea::-o-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .track-video .track-trace input::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .track-video .track-trace select::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_control(
			'label_color',
			[
				'label' => __( 'Label Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-form-area .form-area label' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-form-area .form-area input[type="text"], 
					{{WRAPPER}} .wpo-contact-form-area .form-area input[type="email"], 
					{{WRAPPER}} .wpo-contact-form-area .form-area input[type="date"], 
					{{WRAPPER}} .wpo-contact-form-area .form-area input[type="time"], 
					{{WRAPPER}} .wpo-contact-form-area .form-area input[type="number"], 
					{{WRAPPER}} .wpo-contact-form-area .form-area textarea, 
					{{WRAPPER}} .wpo-contact-form-area .form-area select, 
					{{WRAPPER}} .wpo-contact-form-area .form-area .form-control, 
					{{WRAPPER}} .track-video .track-trace input, 
					{{WRAPPER}} .wpo-contact-form-area .form-area .nice-select' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_control(
			'text_bg_color',
			[
				'label' => __( 'BG Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-form-area .form-area input[type="text"], 
					{{WRAPPER}} .wpo-contact-form-area .form-area input[type="email"], 
					{{WRAPPER}} .wpo-contact-form-area .form-area input[type="date"], 
					{{WRAPPER}} .wpo-contact-form-area .form-area input[type="time"], 
					{{WRAPPER}} .wpo-contact-form-area .form-area input[type="number"], 
					{{WRAPPER}} .wpo-contact-form-area .form-area textarea, 
					{{WRAPPER}} .wpo-contact-form-area .form-area select, 
					{{WRAPPER}} .wpo-contact-form-area .form-area .form-control, 
					{{WRAPPER}} .track-video .track-trace input, 
					{{WRAPPER}} .wpo-contact-form-area .form-area .nice-select' => 'background-color: {{VALUE}} !important;',
				],
			]
		);
		$this->end_controls_section();// end: Section
		
		
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__( 'Button', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit',
			]
		);
		$this->add_responsive_control(
			'btn_width',
			[
				'label' => esc_html__( 'Width', 'plumco-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'btn_margin',
			[
				'label' => __( 'Margin', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'button_style' );
			$this->start_controls_tab(
				'button_normal',
				[
					'label' => esc_html__( 'Normal', 'plumco-core' ),
				]
			);
			$this->add_control(
				'button_color',
				[
					'label' => esc_html__( 'Color', 'plumco-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'plumco-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'button_border',
					'label' => esc_html__( 'Border', 'plumco-core' ),
					'selector' => '{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit',
				]
			);
			$this->end_controls_tab();  // end:Normal tab
			
			$this->start_controls_tab(
				'button_hover',
				[
					'label' => esc_html__( 'Hover', 'plumco-core' ),
				]
			);
			$this->add_control(
				'button_hover_color',
				[
					'label' => esc_html__( 'Color', 'plumco-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_bg_hover_color',
				[
					'label' => esc_html__( 'Background Color', 'plumco-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit:hover' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'button_hover_border',
					'label' => esc_html__( 'Border', 'plumco-core' ),
					'selector' => '{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit:hover',
				]
			);
			$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs
		
		$this->end_controls_section();// end: Section

	}

	/**
	 * Render Video Form widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
	
		$form_id = !empty( $settings['form_id'] ) ? $settings['form_id'] : '';
		$section_title = !empty( $settings['section_title'] ) ? $settings['section_title'] : '';
		$section_content = !empty( $settings['section_content'] ) ? $settings['section_content'] : '';
		$video_link = !empty( $settings['video_link'] ) ? $settings['video_link'] : '';

		$bg_image = !empty( $settings['form_image']['id'] ) ? $settings['form_image']['id'] : '';	
		$shape_image = !empty( $settings['form_shape']['id'] ) ? $settings['form_shape']['id'] : '';	
		
		// Image
		$image_url = wp_get_attachment_url( $bg_image );
		$image_alt = get_post_meta( $bg_image, '_wp_attachment_image_alt', true);
		// Image
		$shape_url = wp_get_attachment_url( $shape_image );
		$shape_alt = get_post_meta( $shape_image, '_wp_attachment_image_alt', true);


		// Turn output buffer on
		ob_start(); ?>
		<div class="wpo-contact-section section-padding">
	    <div class="wpo-contact-img">
	        <?php
	         if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_url( $image_alt ).'">'; }
	         if ( $video_link ) { ?>
	         <a href="<?php echo esc_url( $video_link ) ?>" class="video-btn" data-type="iframe">
	            <i class="fi flaticon-play"></i>
	        </a>
	        <?php } ?>
	    </div>
	    <div class="wpo-contact-img-s2">
	        <?php if( $shape_url ) { echo '<img src="'.esc_url( $shape_url ).'" alt="'.esc_url( $shape_alt ).'">'; } ?>
	    </div>
	    <div class="container">
	        <div class="wpo-contact-section-wrapper">
	            <div class="row align-items-center">
	                <div class="col-lg-6 col-md-12 col-12">
	                    <div class="wpo-contact-form-area">
	                        <div class="wpo-section-title-s2">
	                          <?php 
	                           if( $section_title ) { echo '<span>'.esc_html( $section_title ).'</span>'; }
	                           if( $section_content ) { echo '<h2>'.esc_html( $section_content ).'</h2>'; }
	                          ?>
	                        </div>
	                        <div class="form-area">
	                            <?php echo do_shortcode( '[contact-form-7 id="'. $form_id .'"]' ); ?>
	                        </div>
	                        <div class="border-style"></div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
		</div>
		<?php
		// Return outbut buffer
		echo ob_get_clean();
		
		} 
		


	/**
	 * Render Video Form widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Plumco_Video_Form() );