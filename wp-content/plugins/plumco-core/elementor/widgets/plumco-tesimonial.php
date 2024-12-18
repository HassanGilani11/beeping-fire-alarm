<?php
/*
 * Elementor Plumco Testimonial Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Plumco_Testimonial extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-plumco_testimonial';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Testimonial', 'plumco-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-blockquote';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Plumco Testimonial widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-plumco_testimonial'];
	}
	
	/**
	 * Register Plumco Testimonial widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_testimonial',
			[
				'label' => esc_html__( 'Testimonial Options', 'plumco-core' ),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'testimonial_title',
			[
				'label' => esc_html__( 'Testimonial Title Text', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title Text', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'testimonial_subtitle',
			[
				'label' => esc_html__( 'Testimonial Sub Title', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Testimonial Sub Title', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type testimonial Sub title here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'testimonial_content',
			[
				'label' => esc_html__( 'Testimonial Content', 'plumco-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Testimonial Content', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type testimonial Content here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'bg_image',
			[
				'label' => esc_html__( 'Testimonial Image', 'plumco-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'testimonialItems_groups',
			[
				'label' => esc_html__( 'Testimonial Items', 'plumco-core' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'testimonial_title' => esc_html__( 'Testimonial', 'plumco-core' ),
					],
					
				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ testimonial_title }}}',
			]
		);
		$this->end_controls_section();// end: Section
		

		// Testimonial Content Style 
		$this->start_controls_section(
			'testimonials_section_content_style',
			[
				'label' => esc_html__( 'Testimonial', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'testimonials_quote_color',
			[
				'label' => esc_html__( 'Quote Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonials-section .testimonials-wrapper .testimonials-item .testimonials-item-top:after' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'testimonials_bg_color',
			[
				'label' => esc_html__( 'BG Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonials-section .testimonials-wrapper .testimonials-item .testimonials-item-top' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		
		// Testimonial Name Style 
		$this->start_controls_section(
			'testimonials_section_name_style',
			[
				'label' => esc_html__( 'Testimonial Name', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'plumco-core' ),
				'name' => 'testimonials_plumco_name_typography',
				'selector' => '{{WRAPPER}} .wpo-testimonials-section .testimonials-wrapper .testimonials-item .testimonials-item-bottom .testimonials-item-bottom-author-text h3',
			]
		);
		$this->add_control(
			'testimonials_name_color',
			[
				'label' => esc_html__( 'Name Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonials-section .testimonials-wrapper .testimonials-item .testimonials-item-bottom .testimonials-item-bottom-author-text h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
		
		// Testimonial Title Style 
		$this->start_controls_section(
			'testimonials_section_title_style',
			[
				'label' => esc_html__( 'Testimonial Title', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'plumco-core' ),
				'name' => 'testimonials_plumco_title_typography',
				'selector' => '{{WRAPPER}} .wpo-testimonials-section .testimonials-wrapper .testimonials-item .testimonials-item-bottom .testimonials-item-bottom-author-text span',
			]
		);
		$this->add_control(
			'testimonials_title_color',
			[
				'label' => esc_html__( 'Name Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonials-section .testimonials-wrapper .testimonials-item .testimonials-item-bottom .testimonials-item-bottom-author-text span' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .wpo-testimonials-section .testimonials-wrapper .testimonials-item .testimonials-item-top p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonials-section .testimonials-wrapper .testimonials-item .testimonials-item-top p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
	
		
	}

	/**
	 * Render Testimonial widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$testimonialItems_groups = !empty( $settings['testimonialItems_groups'] ) ? $settings['testimonialItems_groups'] : [];

		// Turn output buffer on
		ob_start(); ?>

		<div class="wpo-testimonials-section">
	    <div class="container">
	        <div class="row align-items-center">
	            <div class="col-xl-12 col-lg-12">
	                <div class="testimonials-wrapper owl-carousel">
	                    <?php 	// Group Param Output
												if( is_array( $testimonialItems_groups ) && !empty( $testimonialItems_groups ) ){
												foreach ( $testimonialItems_groups as $each_items ) { 

												$testimonial_title = !empty( $each_items['testimonial_title'] ) ? $each_items['testimonial_title'] : '';
												$testimonial_subtitle = !empty( $each_items['testimonial_subtitle'] ) ? $each_items['testimonial_subtitle'] : '';
												$testimonial_content = !empty( $each_items['testimonial_content'] ) ? $each_items['testimonial_content'] : '';

												$bg_image = !empty( $each_items['bg_image']['id'] ) ? $each_items['bg_image']['id'] : '';	
		
												// Image
												$image_url = wp_get_attachment_url( $bg_image );
												$image_alt = get_post_meta( $bg_image, '_wp_attachment_image_alt', true);

												?>
	                    <div class="testimonials-item">
	                        <div class="testimonials-item-top">
	                            <?php if( $testimonial_content ) { echo '<p>'.esc_html( $testimonial_content ).'</p>'; } ?>
	                        </div>
	                        <div class="testimonials-item-bottom">
	                            <div class="testimonials-item-bottom-author">
	                              <?php if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_url( $image_alt ).'">'; }  ?>
	                            </div>
	                            <div class="testimonials-item-bottom-author-text">
	                            	<?php 
																if( $testimonial_title ) { echo '<h3>'.esc_html( $testimonial_title ).'</h3>'; } 
					                			if( $testimonial_subtitle ) { echo '<span>'.esc_html( $testimonial_subtitle ).'</span>'; }
					                     ?>
	                            </div>
	                        </div>
	                    </div>
	                  <?php }
										} ?>
	                </div>
	            </div>
	        </div> <!-- end row -->
	    </div>
	</div>
		<?php 
			// Return outbut buffer
			echo ob_get_clean();	
		}
	/**
	 * Render Testimonial widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Plumco_Testimonial() );