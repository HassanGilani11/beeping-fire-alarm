<?php
/*
 * Elementor Plumco About Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Plumco_About extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-plumco_about';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'About', 'plumco-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-site-identity';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Plumco About widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-plumco_about'];
	}
	
	/**
	 * Register Plumco About widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_about',
			[
				'label' => esc_html__( 'About Options', 'plumco-core' ),
			]
		);
		$this->add_control(
			'about_subtitle',
			[
				'label' => esc_html__( 'Sub Title Text', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Subtitle', 'plumco-core' ),
				'placeholder' => esc_html__( 'Sub Type title text here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'about_title',
			[
				'label' => esc_html__( 'Title Text', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title Text', 'plumco-core' ),
				'placeholder' => esc_html__( 'Sub Type title text here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'about_content',
			[
				'label' => esc_html__( 'Content', 'plumco-core' ),
				'default' => esc_html__( 'your content text', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type your content here', 'plumco-core' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);
		$this->add_control(
			'about_image',
			[
				'label' => esc_html__( 'About Image', 'plumco-core' ),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'plumco-core'),
			]
		);
		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__( 'Button/Link Text', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Button Text', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type btn text here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'btn_link',
			[
				'label' => esc_html__( 'Button Link', 'plumco-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'default' => [
					'url' => '',
				],
				'label_block' => true,
			]
		);
	 $this->end_controls_section();// end: Section

		// Sub Title
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
				'selector' => '{{WRAPPER}} .wpo-about-section .wpo-about-text > span',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text > span' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'subtitle_line_color',
			[
				'label' => esc_html__( 'Line Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text > span:before, .wpo-about-section .wpo-about-text > span:after' => 'background-color: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'subtitle_padding',
			[
				'label' => __( 'Title Padding', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,				
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .wpo-about-section .wpo-about-text h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_heighlight_color',
			[
				'label' => esc_html__( 'Heilight Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text h2 span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label' => esc_html__( 'Title Padding', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// Content
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'Content', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'plumco-core' ),
				'name' => 'section_content_typography',
				'selector' => '{{WRAPPER}} .wpo-about-section .about-content p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .about-content p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_padding',
			[
				'label' => esc_html__( 'Content Padding', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .about-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		
		// Button
		$this->start_controls_section(
			'section_bout_btn_style',
			[
				'label' => esc_html__( 'Button', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .theme-btn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_color',
				'label' => esc_html__( 'Background', 'plumco-core' ),
				'description' => esc_html__( 'Button Color', 'plumco-core' ),
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .wpo-about-section .theme-btn',
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .theme-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_hover_bg_color',
				'label' => esc_html__( 'Hover Background', 'plumco-core' ),
				'description' => esc_html__( 'Button Color', 'plumco-core' ),
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .wpo-about-section .theme-btn:hover',
			]
		);
		$this->add_control(
			'about_btn_padding',
			[
				'label' => esc_html__( 'Title Padding', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .theme-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section


	}

	/**
	 * Render About widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$about_title = !empty( $settings['about_title'] ) ? $settings['about_title'] : '';
		$about_subtitle = !empty( $settings['about_subtitle'] ) ? $settings['about_subtitle'] : '';
		$about_content = !empty( $settings['about_content'] ) ? $settings['about_content'] : '';
		$bg_image = !empty( $settings['about_image']['id'] ) ? $settings['about_image']['id'] : '';	
		
		// Image
		$image_url = wp_get_attachment_url( $bg_image );
		$image_alt = get_post_meta( $settings['about_image']['id'], '_wp_attachment_image_alt', true);

		$btn_text = !empty( $settings['btn_text'] ) ? $settings['btn_text'] : '';
		$btn_paragraph = !empty( $settings['btn_paragraph'] ) ? $settings['btn_paragraph'] : '';
		$btn_icon = !empty( $settings['btn_icon'] ) ? $settings['btn_icon'] : '';

		$btn_link = !empty( $settings['btn_link']['url'] ) ? $settings['btn_link']['url'] : '';
		$btn_external = !empty( $settings['btn_link']['is_external'] ) ? 'target="_blank"' : '';
		$btn_nofollow = !empty( $settings['btn_link']['nofollow'] ) ? 'rel="nofollow"' : '';
		$btn_link_attr = !empty( $btn_link ) ?  $btn_external.' '.$btn_nofollow : '';

		$button = $btn_link ? '<a href="'.esc_url($btn_link).'" '.esc_attr( $btn_link_attr ).' class="theme-btn" >'.esc_html( $btn_text ).'</a>' : '';


		// Turn output buffer on
		ob_start(); ?>
	<div class="wpo-about-section about-section-s3">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
                <div class="about-thumnail">
                	<?php if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_url( $image_alt ).'">'; }  ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                  <div class="wpo-about-text">
                   <?php 
				            	if( $about_subtitle ) { echo '<span>'.wp_kses_post( $about_subtitle ).'</span>'; }
				            	if( $about_title ) { echo '<h2>'.wp_kses_post( $about_title ).'</h2>'; }
				             ?>
				            <div class="about-content">
				             	<?php 
				            	if( $about_content ) { echo wp_kses_post( $about_content ); }
				             ?>
				            </div>
                    <div class="about-button">
                    		<?php echo $button; ?>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
	<?php
			echo ob_get_clean();	
		}
	/**
	 * Render About widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Plumco_About() );