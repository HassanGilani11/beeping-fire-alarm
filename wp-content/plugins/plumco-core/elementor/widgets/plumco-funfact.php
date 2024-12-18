<?php
/*
 * Elementor Plumco Funfact Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Plumco_Funfact extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-plumco_funfact';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Funfact', 'plumco-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-counter';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Plumco Funfact widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-plumco_funfact'];
	}
	
	/**
	 * Register Plumco Funfact widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_funfact',
			[
				'label' => esc_html__( 'Funfact Options', 'plumco-core' ),
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
			'section_number',
			[
				'label' => esc_html__( 'Number Text', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '89K', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type Number text here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'review_title',
			[
				'label' => esc_html__( 'Review Text', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Customer Review', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type Review text here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'review_image',
			[
				'label' => esc_html__( 'Review Image', 'plumco-core' ),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'plumco-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'funfact_title',
			[
				'label' => esc_html__( 'Title Text', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title Text', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'funfact_number',
			[
				'label' => esc_html__( 'Funfact Number', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '250', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type funfact Number here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'funfact_plus',
			[
				'label' => esc_html__( 'Funfact Plus', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '+', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type funfact + here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'funfact_image',
			[
				'label' => esc_html__( 'Funfact Image', 'plumco-core' ),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'plumco-core'),
			]
		);
		$this->add_control(
			'funfactItems_groups',
			[
				'label' => esc_html__( 'Funfact Items', 'plumco-core' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'funfact_title' => esc_html__( 'Funfact', 'plumco-core' ),
					],
					
				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ funfact_title }}}',
			]
		);
		$this->end_controls_section();// end: Section
		

		// Funfact BG
		$this->start_controls_section(
			'funfact_bg_style',
			[
				'label' => esc_html__( 'BG', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'funfact_item_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-fun-fact-section' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'bg_padding',
			[
				'label' => esc_html__( 'Padding', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-fun-fact-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .wpo-fun-fact-section .wpo-funfacts-text h3',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-fun-fact-section .wpo-funfacts-text h3' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .wpo-fun-fact-section .wpo-funfacts-text h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// Section Number
		$this->start_controls_section(
			'section_title_number_style',
			[
				'label' => esc_html__( 'Title Number', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'plumco-core' ),
				'name' => 'plumco_title_number_typography',
				'selector' => '{{WRAPPER}} .wpo-fun-fact-section .wpo-funfacts-text .customer-review h2',
			]
		);
		$this->add_control(
			'title_number_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-fun-fact-section .wpo-funfacts-text .customer-review h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_number_padding',
			[
				'label' => esc_html__( 'Title Padding', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-fun-fact-section .wpo-funfacts-text .customer-review h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// Funfact Number
		$this->start_controls_section(
			'funfact_number_style',
			[
				'label' => esc_html__( 'Number', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'plumco-core' ),
				'name' => 'plumco_number_typography',
				'selector' => '{{WRAPPER}} .wpo-fun-fact-section .grid h3',
			]
		);
		$this->add_control(
			'funfact_item_number_color',
			[
				'label' => esc_html__( 'Number Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-fun-fact-section .grid h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'number_padding',
			[
				'label' => __( 'Number Padding', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-fun-fact-section .grid h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// Funfact Title
		$this->start_controls_section(
			'funfact_title_style',
			[
				'label' => esc_html__( 'Funfact Title', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'plumco-core' ),
				'name' => 'ntrsvt_funfact_title_typography',
				'selector' => '{{WRAPPER}} .wpo-fun-fact-section .grid h3+p',
			]
		);
		$this->add_control(
			'funfact_title',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-fun-fact-section .grid h3+p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'funfact_title_padding',
			[
				'label' => __( 'Number Padding', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-fun-fact-section .grid h3+p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		
	}

	/**
	 * Render Funfact widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$funfactItems_groups = !empty( $settings['funfactItems_groups'] ) ? $settings['funfactItems_groups'] : [];
		$section_title = !empty( $settings['section_title'] ) ? $settings['section_title'] : '';
		$section_number = !empty( $settings['section_number'] ) ? $settings['section_number'] : '';
		$review_title = !empty( $settings['review_title'] ) ? $settings['review_title'] : '';
		$bg_image = !empty( $settings['review_image']['id'] ) ? $settings['review_image']['id'] : '';	

		// Image
		$image_url = wp_get_attachment_url( $bg_image );
		$image_alt = get_post_meta( $bg_image, '_wp_attachment_image_alt', true);

	
		// Turn output buffer on
		ob_start(); ?>
		<div class="wpo-fun-fact-section section-padding">
	    <div class="container">
	        <div class="row align-items-center">
	            <div class="col-lg-5">
	                <div class="wpo-funfacts-text">
	                     <?php if( $section_title ) { echo '<h3>'.esc_html( $section_title ).'</h3>'; } ?>
	                    <div class="customer-review">
	                         <?php if( $section_number ) { echo '<h2>'.esc_html( $section_number ).'</h2>'; } ?>
	                        <div class="reviews">
	                        <div class="review-imag">
	                        <?php if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_url( $image_alt ).'">'; }  ?>
	                        </div>
	                           <?php if( $review_title ) { echo '<span>'.esc_html( $review_title ).'</span>'; } ?>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col col-lg-6 offset-lg-1">
	                <div class="wpo-fun-fact-grids clearfix">
	                    <?php 	// Group Param Output
											if( is_array( $funfactItems_groups ) && !empty( $funfactItems_groups ) ){
											foreach ( $funfactItems_groups as $each_item ) { 
											$funfact_title = !empty( $each_item['funfact_title'] ) ? $each_item['funfact_title'] : '';
											$funfact_number = !empty( $each_item['funfact_number'] ) ? $each_item['funfact_number'] : '';
											$funfact_plus = !empty( $each_item['funfact_plus'] ) ? $each_item['funfact_plus'] : '';
											$bg_image = !empty( $each_item['funfact_image']['id'] ) ? $each_item['funfact_image']['id'] : '';
											// Image
											$image_url = wp_get_attachment_url( $bg_image );
											$image_alt = get_post_meta( $bg_image, '_wp_attachment_image_alt', true);
											?>
	                    <div class="grid">
	                        <div class="icon">
	                           <?php if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_url( $image_alt ).'">'; }  ?>
	                        </div>
	                        <div class="info">
	                          <?php 
							            		if( $funfact_number ) { echo '<h3><span class="odometer" data-count="'.esc_attr( $funfact_number ).'">'.esc_html__( '00','plumco-core' ).'</span>'.esc_html( $funfact_plus ).'</h3>'; } 
							            		 if( $funfact_title ) { echo '<p>'.esc_html__( $funfact_title ).'</p>'; }
							            	?>
	                        </div>
	                    </div>
	                  <?php }
										} ?>
	                </div>
	            </div>
	        </div>
	    </div> <!-- end container -->
		</div>
		<?php 
			// Return outbut buffer
			echo ob_get_clean();	
		}
	/**
	 * Render Funfact widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Plumco_Funfact() );