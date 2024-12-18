<?php
/*
 * Elementor Plumco Pricing Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Plumco_Pricing extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-plumco_pricing';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Pricing', 'plumco-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-price-table';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Plumco Pricing widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-plumco_pricing'];
	}
	
	/**
	 * Register Plumco Pricing widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_pricing',
			[
				'label' => esc_html__( 'Pricing Options', 'plumco-core' ),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'pricing_title',
			[
				'label' => esc_html__( 'Title Text', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Pricing Title.', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'pricing_amount',
			[
				'label' => esc_html__( 'Amount Text', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '250', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type Amount text here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'pricing_month',
			[
				'label' => esc_html__( 'Month Text', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Monthly.', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type Month text here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'pricing_content',
			[
				'label' => esc_html__( 'Content', 'plumco-core' ),
				'default' => esc_html__( 'your content text', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type your content here', 'plumco-core' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'plumco-core' ),
				'default' => esc_html__( 'Choose Plan', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type your button text here', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'pricing_link',
			[
				'label' => esc_html__( 'link', 'plumco-core' ),
				'default' => esc_html__( '#', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type your link here', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_control(
			'pricingItems_groups',
			[
				'label' => esc_html__( 'Pricing Icons', 'plumco-core' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'pricing_title' => esc_html__( 'Pricing', 'plumco-core' ),
					],
					
				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ pricing_title }}}',
			]
		);
		$this->end_controls_section();// end: Section
		
		// Pricing Icons
		$this->start_controls_section(
			'section_pricing_box_section_style',
			[
				'label' => esc_html__( 'Price', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'pricing_item_border_color',
			[
				'label' => esc_html__( 'Border Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .pricing-grids .grid' => 'border-color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .wpo-pricing-section .grid .type h5',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .grid .type h5' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_bg_color',
			[
				'label' => esc_html__( 'BG Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .grid .type' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .wpo-pricing-section .grid .type h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
		
		// Price
		$this->start_controls_section(
			'section_price_style',
			[
				'label' => esc_html__( 'Price', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'plumco-core' ),
				'name' => 'plumco_price_title_typography',
				'selector' => '{{WRAPPER}} .wpo-pricing-section .pricing-header h3',
			]
		);
		$this->add_control(
			'price_title_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .pricing-header h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'price_title_padding',
			[
				'label' => esc_html__( 'Title Padding', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .pricing-header h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// Price Month
		$this->start_controls_section(
			'section_price_month_style',
			[
				'label' => esc_html__( 'Price', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'plumco-core' ),
				'name' => 'plumco_month_title_typography',
				'selector' => '{{WRAPPER}} .wpo-pricing-section .pricing-header p',
			]
		);
		$this->add_control(
			'month_title_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .pricing-header p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'month_title_padding',
			[
				'label' => esc_html__( 'Title Padding', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .pricing-header p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .wpo-pricing-section .pricing-body ul li',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .pricing-body ul li' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .wpo-pricing-section .pricing-body ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

	// button
		$this->start_controls_section(
			'section_button_style',
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
					'{{WRAPPER}} .wpo-pricing-section .grid .get-started' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_br_color',
			[
				'label' => esc_html__( 'Border Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .grid .get-started' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_bg_color',
			[
				'label' => esc_html__( 'BG Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .grid .get-started' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .grid .get-started:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_hover_br_color',
			[
				'label' => esc_html__( 'Hover Border Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .grid .get-started:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_bg_hover_color',
			[
				'label' => esc_html__( 'Hover BG Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .grid .get-started:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

	// Active
		$this->start_controls_section(
			'section_pricing_active_style',
			[
				'label' => esc_html__( 'Active', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'active_box_bg_color',
			[
				'label' => esc_html__( 'BG Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .pricing-grids>.grid:nth-child(2):before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'active_title_bg_color',
			[
				'label' => esc_html__( 'Title BG Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .pricing-grids>.grid:nth-child(2) .type' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'active_price_bg_color',
			[
				'label' => esc_html__( 'Price BG Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .pricing-grids>.grid:nth-child(2) .pricing-header' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'active_item_color',
			[
				'label' => esc_html__( 'list Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .pricing-grids>.grid:nth-child(2) ul li' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'active_item_btn_color',
			[
				'label' => esc_html__( 'Button Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .pricing-grids>.grid:nth-child(2) .get-started' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'active_item_btn_br_color',
			[
				'label' => esc_html__( 'Button Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .pricing-grids>.grid:nth-child(2) .get-started' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'active_item_btn_bg_color',
			[
				'label' => esc_html__( 'Button BG Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .pricing-grids>.grid:nth-child(2) .get-started' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
		
	}

	/**
	 * Render Pricing widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$pricingItems_groups = !empty( $settings['pricingItems_groups'] ) ? $settings['pricingItems_groups'] : [];
		// Turn output buffer on

		ob_start(); ?>
		<div class="wpo-pricing-section">
	    <div class="container">
	        <div class="pricing-grids clearfix">
	        	<?php
	        		// Group Param Output
							if( is_array( $pricingItems_groups ) && !empty( $pricingItems_groups ) ){
							foreach ( $pricingItems_groups as $each_item ) { 	
					
							$pricing_title = !empty( $each_item['pricing_title'] ) ? $each_item['pricing_title'] : '';
							$pricing_amount = !empty( $each_item['pricing_amount'] ) ? $each_item['pricing_amount'] : '';
							$pricing_month = !empty( $each_item['pricing_month'] ) ? $each_item['pricing_month'] : '';
							$pricing_content = !empty( $each_item['pricing_content'] ) ? $each_item['pricing_content'] : '';
							$button_text = !empty( $each_item['button_text'] ) ? $each_item['button_text'] : '';
							$pricing_link = !empty( $each_item['pricing_link'] ) ? $each_item['pricing_link'] : '';
							
							?>
	            <div class="grid">
	                <div class="type">
	                	<?php if( $pricing_title ) { echo '<h5>'.esc_html( $pricing_title ).'</h5>'; } ?>
	                </div>
	                <div class="pricing-header">
	                    <div>
	                    	<?php 
	                    	if( $pricing_amount ) { echo '<h3 class="price">'.esc_html( $pricing_amount ).'</h3>'; }
	                    	if( $pricing_month ) { echo '<p>'.esc_html( $pricing_month ).'</p>'; }
	                    	?>
	                    </div>
	                </div>
	                <div class="pricing-body">
	                  <?php 
	                    if( $pricing_content ) { echo wp_kses_post( $pricing_content ); } 
                      if( $button_text ) { echo ' <a class="price-btn get-started" href="'.esc_url( $pricing_link ).'">'.esc_html( $button_text ).'</a>'; }
                     ?>
	                </div>
	            </div>
 						<?php }
						} ?>
	        </div>
	    </div> 
	</div>
		<?php
			// Return outbut buffer
			echo ob_get_clean();	
		}
	/**
	 * Render Pricing widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Plumco_Pricing() );