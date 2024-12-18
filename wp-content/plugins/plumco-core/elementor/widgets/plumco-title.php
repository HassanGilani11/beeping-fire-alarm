<?php
/*
 * Elementor Plumco Title Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Plumco_Title extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-plumco_title';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Title', 'plumco-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-heading';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Plumco Title widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	/*
	public function get_script_depends() {
		return ['wpo-plumco_title'];
	}
	*/
	
	/**
	 * Register Plumco Title widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_Title',
			[
				'label' => esc_html__( 'Title Options', 'plumco-core' ),
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
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Content Text', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type Content text here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$this->add_responsive_control(
			'content_min_width',
			[
				'label' => esc_html__( 'Width', 'plumco-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 350,
						'max' => 750,
						'step' => 1,
					],
				],
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .section-title-s3 p' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'title_style' => array('style-one'),
				],
			]
		);
		$this->end_controls_section();// end: Section

	
		// Title Shape
		$this->start_controls_section(
			'section_title_shape_style',
			[
				'label' => esc_html__( 'Title Shape', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'title_shape_color',
			[
				'label' => esc_html__( 'Shape Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-section-title:before, .wpo-section-title-s2:before' => 'background-color: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'title_shape2_color',
			[
				'label' => esc_html__( 'Shape 2 Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-section-title:after, .wpo-section-title-s2:after' => 'background-color: {{VALUE}};',
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
				'name' => 'plumco_title_typography',
				'selector' => '{{WRAPPER}} .wpo-section-title h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-section-title h2' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'title_padding',
			[
				'label' => __( 'Title Padding', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,				
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-section-title h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .wpo-section-title p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-section-title p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
	
		
		
	}

	/**
	 * Render Title widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();

		$section_title = !empty( $settings['section_title'] ) ? $settings['section_title'] : '';
		$section_content = !empty( $settings['section_content'] ) ? $settings['section_content'] : '';

		$section_title = preg_replace('~\s*<br ?/?>\s*~'," <br/>",$section_title);
    $section_title = nl2br(	$section_title );

		// Turn output buffer on

		ob_start(); ?>
		<div class="section-title-area">
		  <div class="row align-items-center justify-content-center">
		      <div class="col-lg-7">
		          <div class="wpo-section-title">
		            <?php 
					      	if( $section_title ) { echo '<h2>'.esc_html( $section_title ).'</h2>'; }
					      	if( $section_content ) { echo '<p>'.esc_html( $section_content ).'</p>'; }
					      ?>
		          </div>
		      </div>
		  </div>
		</div>
		<?php 
		// Return outbut buffer
		echo ob_get_clean();
		
	}
	/**
	 * Render Title widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Plumco_Title() );