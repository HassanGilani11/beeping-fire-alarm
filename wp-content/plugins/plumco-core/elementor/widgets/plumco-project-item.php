<?php
/*
 * Elementor Follio ProjectItem Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Follio_ProjectItem extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-follio_projectitem';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Project Item', 'follio-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-kit-details';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Follio ProjectItem widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	/*
	public function get_script_depends() {
		return ['wpo-follio_projectitem'];
	}
	*/
	
	/**
	 * Register Follio ProjectItem widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_ProjectItem',
			[
				'label' => esc_html__( 'ProjectItem Options', 'follio-core' ),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'single_feature_title',
			[
				'label' => esc_html__( 'Title Text', 'follio-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title Text', 'follio-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'follio-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'single_feature_content',
			[
				'label' => esc_html__( 'Content', 'follio-core' ),
				'default' => esc_html__( 'your content text', 'follio-core' ),
				'placeholder' => esc_html__( 'Type your content here', 'follio-core' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'single_featureItems_groups',
			[
				'label' => esc_html__( 'Feature Icons', 'follio-core' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'single_feature_title' => esc_html__( 'Feature', 'follio-core' ),
					],
					
				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ single_feature_title }}}',
			]
		);
		$this->end_controls_section();// end: Section

			// Title
		$this->start_controls_section(
			'single_service_section_title_style',
			[
				'label' => esc_html__( 'Title', 'follio-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'follio-core' ),
				'name' => 'sasban_title_typography',
				'selector' => '{{WRAPPER}} .wpo-project-details-text h2',
			]
		);
		$this->add_control(
			'single_service_title_color',
			[
				'label' => esc_html__( 'Color', 'follio-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-project-details-text h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'single_service_title_padding',
			[
				'label' => __( 'Title Padding', 'follio-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-project-details-text h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

			// Content
		$this->start_controls_section(
			'single_service_item_content_style',
			[
				'label' => esc_html__( 'Item', 'follio-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'single_project_bg_color',
			[
				'label' => esc_html__( 'BG Color', 'follio-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-project-details-text' => 'background-color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .wpo-project-details-text h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-project-details-text h2' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .wpo-project-details-text h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

			// Content
		$this->start_controls_section(
			'single_service_section_content_style',
			[
				'label' => esc_html__( 'Content', 'follio-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'follio-core' ),
				'name' => 'single_service_content_typography',
				'selector' => '{{WRAPPER}} .wpo-project-details-text span',
			]
		);
		$this->add_control(
			'single_service_content_color',
			[
				'label' => esc_html__( 'Color', 'follio-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-project-details-text span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'single_service_content_padding',
			[
				'label' => __( 'Title Padding', 'follio-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-project-details-text span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

	}

	/**
	 * Render ProjectItem widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$single_featureItems_groups = !empty( $settings['single_featureItems_groups'] ) ? $settings['single_featureItems_groups'] : [];

// Turn output buffer on
		ob_start(); ?>
		<div class="wpo-project-details-list">
			<div class="row">
	    	 <?php 
		  		// Group Param Output
					if( is_array( $single_featureItems_groups ) && !empty( $single_featureItems_groups ) ){
					foreach ( $single_featureItems_groups as $each_item ) { 

					$single_feature_title = !empty( $each_item['single_feature_title'] ) ? $each_item['single_feature_title'] : '';
					$single_feature_content = !empty( $each_item['single_feature_content'] ) ? $each_item['single_feature_content'] : '';
	
					?>
			    <div class="col co-l-lg-4 col-md-4 col-sm-6 col-12">
			        <div class="wpo-project-details-text">
			           <?php 
			            if( $single_feature_title ) { echo '<span>'.esc_html( $single_feature_title ).'</span>'; }
			            if( $single_feature_content ) { echo '<h2>'.esc_html( $single_feature_content ).'</h2>'; }
			           ?>
			        </div>
			    </div>
			   <?php }
			  } ?>
			</div>
		</div>
		<?php
		// Return outbut buffer
		echo ob_get_clean();
		
	}
	/**
	 * Render ProjectItem widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Follio_ProjectItem() );