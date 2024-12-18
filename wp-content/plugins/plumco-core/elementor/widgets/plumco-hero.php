<?php
/*
 * Elementor Plumco Hero Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Plumco_Hero extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-plumco_hero';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Hero', 'plumco-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'ti-panel';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Plumco Hero widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-plumco_hero'];
	}
	
	/**
	 * Register Plumco Hero widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_hero',
			[
				'label' => esc_html__( 'Hero Options', 'plumco-core' ),
			]
		);
		$this->add_control(
			'hero_style',
			[
				'label' => esc_html__( 'Hero Style', 'finco-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__( 'Style One', 'finco-core' ),
					'style-two' => esc_html__( 'Style Two', 'finco-core' ),
				],
				'default' => 'style-one',
				'description' => esc_html__( 'Select your hero style.', 'finco-core' ),
			]
		);
		$this->add_control(
			'hero_subtitle',
			[
				'label' => esc_html__( 'Sub Title Text', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Sub Title Text Here ', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type sub title text here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'hero_title',
			[
				'label' => esc_html__( 'Title Text', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title Text Here ', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'hero_content',
			[
				'label' => esc_html__( 'Content', 'plumco-core' ),
				'default' => esc_html__( 'your content text', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type your content here', 'plumco-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);
		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__( 'Button Text', 'plumco-core' ),
				'default' => esc_html__( 'button text', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type button Text here', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
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
		$this->add_control(
			'video_btn_link',
			[
				'label' => esc_html__( 'Video Link', 'plumco-core' ),
				'default' => esc_html__( 'video link', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type video link here', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'hero_style' => array('style-one'),
				],
				'label_block' => true,
			]
		);
		$this->add_control(
			'hero_image',
			[
				'label' => esc_html__( 'Hero Image', 'plumco-core' ),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'plumco-core'),
			]
		);
	 $this->end_controls_section();// end: Section

		
		// Hero BG Two
		$this->start_controls_section(
			'section_hero_bg_two_style',
			[
				'label' => esc_html__( 'Background', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'hero_style' => array('style-two'),
				],
			]
		);
		$this->add_control(
			'hero_bg_two_color',
			[
				'label' => esc_html__( 'background', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-hero-section-2:before' => 'background-color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .plumco-hero .wpo-hero-title h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plumco-hero .wpo-hero-title h2, .plumco-hero .wpo-hero-title h2 span
					' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .plumco-hero .wpo-hero-title h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .plumco-hero .wpo-hero-des p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plumco-hero .wpo-hero-des p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

	
		// Button
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
					'name' => 'button_one_typography',
					'label' => esc_html__( 'Typography', 'plumco-core' ),
					'selector' => '{{WRAPPER}} .plumco-hero .btns .theme-btn',
				]
			);
		$this->start_controls_tabs( 'button_one_style' );
			$this->start_controls_tab(
				'button_one_normal',
				[
					'label' => esc_html__( 'Normal', 'plumco-core' ),
				]
			);
			$this->add_control(
				'button_one_color',
				[
					'label' => esc_html__( 'Color', 'plumco-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .plumco-hero .btns .theme-btn' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_br_color',
				[
					'label' => esc_html__( 'Border Color', 'plumco-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .plumco-hero .btns .theme-btn' => 'border-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_one_bgcolor',
				[
					'label' => esc_html__( 'Background', 'plumco-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .plumco-hero .btns .theme-btn' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
			'button_padding',
				[
					'label' => esc_html__( 'Padding', 'plumco-core' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .plumco-hero .btns .theme-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_tab();  // end:Normal tab
			
			$this->start_controls_tab(
				'button_one_hover',
				[
					'label' => esc_html__( 'Hover', 'plumco-core' ),
				]
			);
			$this->add_control(
				'button_one_hover_color',
				[
					'label' => esc_html__( 'Color', 'plumco-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .plumco-hero .btns .theme-btn:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_one_hover_bg_color',
				[
					'label' => esc_html__( 'Hover Background', 'plumco-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .plumco-hero .btns .theme-btn:hover' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs
		
		$this->end_controls_section();// end: Section



		// Video Button
		$this->start_controls_section(
			'section_video_btn_style',
			[
				'label' => esc_html__( 'Video Button', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'hero_style' => array('style-one'),
				],
			]
		);
		$this->add_control(
			'video_btn_color',
			[
				'label' => esc_html__( 'Icon Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plumco-hero .right-vec .right-img .video-holder a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'video_btn_bg_color',
			[
				'label' => esc_html__( 'BG Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plumco-hero .right-vec .right-img .video-holder a' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

	}

	/**
	 * Render Hero widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$hero_style = !empty( $settings['hero_style'] ) ? $settings['hero_style'] : '';
		$hero_subtitle = !empty( $settings['hero_subtitle'] ) ? $settings['hero_subtitle'] : '';
		$hero_title = !empty( $settings['hero_title'] ) ? $settings['hero_title'] : '';
		$hero_content = !empty( $settings['hero_content'] ) ? $settings['hero_content'] : '';

		$bg_image = !empty( $settings['hero_image']['id'] ) ? $settings['hero_image']['id'] : '';	
		$video_btn_link = !empty( $settings['video_btn_link'] ) ? $settings['video_btn_link'] : '';	

		$button_text = !empty( $settings['btn_text'] ) ? $settings['btn_text'] : '';	
		$button_link = !empty( $settings['btn_link']['url'] ) ? $settings['btn_link']['url'] : '';
		$button_link_external = !empty( $settings['btn_link']['is_external'] ) ? 'target="_blank"' : '';
		$button_link_nofollow = !empty( $settings['btn_link']['nofollow'] ) ? 'rel="nofollow"' : '';
		$button_link_attr = !empty( $button_link ) ?  $button_link_external.' '.$button_link_nofollow : '';

		$video_btn_text = !empty( $settings['video_btn_text'] ) ? $settings['video_btn_text'] : '';	
		$video_btn_link = !empty( $settings['video_btn_link'] ) ? $settings['video_btn_link'] : '';	
  
		// Image
		$image_url = wp_get_attachment_url( $bg_image );
		$image_alt = get_post_meta( $settings['hero_image']['id'], '_wp_attachment_image_alt', true);

		$plumco_button = $button_link ? '<a href="'.esc_url($button_link).'" '.$button_link_attr.' class="btn theme-btn">'.esc_html( $button_text ).'</a>' : '';

		if ( $hero_style == 'style-one' ) {
			$hero_class = 'wpo-hero-section-1';
			$hero_col = 'col col-xl-4 col-lg-5 col-12';
		} else {
			$hero_class = 'wpo-hero-section-2';
			$hero_col = 'col col-xs-5 col-lg-5 offset-lg-7 col-12';
		}

		// Turn output buffer on
		ob_start(); ?>
		<div class="plumco-hero <?php echo esc_attr( $hero_class ); ?>">
	    <div class="container">
	        <div class="row">
	            <div class="<?php echo esc_attr( $hero_col ); ?>">
	                <div class="wpo-hero-section-text">
	                	<?php if ( $hero_subtitle ) { ?>
	                	<div class="wpo-hero-subtitle">
	                      <span><?php echo esc_html( $hero_subtitle ); ?></span>
	                  </div>
	                	 <?php } if ( $hero_title ) { ?>
	                    <div class="wpo-hero-title">
	                        <h2><?php echo wp_kses_post( $hero_title ); ?></h2>
	                    </div>
	                    <?php } if ( $hero_content ) { ?>
	                   	<div class="wpo-hero-des">
	                       <p><?php echo esc_html( $hero_content ); ?></p>
	                    </div>
	                     <?php } ?> 
	                    <div class="btns">
	                    	<?php echo $plumco_button; ?>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="right-vec">
	    		<?php 
	    			if ( $hero_style == 'style-two' ): 
	    				if ( $image_url ) {
							$bg_url = ' style="';
							$bg_url .= ( $image_url ) ? 'background-image: url( '. esc_url( $image_url ) .' );' : '';
							$bg_url .= '"';
						} else {
							$bg_url = '';
						}
	    		 endif
	    		?>
	        <div class="right-img" <?php if ( $hero_style == 'style-two' ) {
	        	echo $bg_url;
	        } ?>>
	        	<?php if ( $hero_style == 'style-one' ) { ?>
	        		<div class="r-img">
	                <?php if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_url( $image_alt ).'">'; }
	                if ( $video_btn_link ) { ?>
	                <div class="pop-up-video">
	                    <div class="video-holder">
	                        <a href="<?php echo esc_url( $video_btn_link ); ?>" class="video-btn" data-type="iframe"><i class="fi flaticon-play"></i></a>
	                    </div>
	                </div>
 								<?php } ?> 
	            </div>
	        	<?php } ?>
	        </div>
	    </div>
	</div>
		<?php  // Return outbut buffer
			echo ob_get_clean();	
		}
	/**
	 * Render Hero widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Plumco_Hero() );