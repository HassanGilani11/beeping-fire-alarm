<?php
/*
 * Elementor Plumco Team Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Plumco_Team extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-plumco_team';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Team', 'plumco-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-person';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Plumco Team widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-plumco_team'];
	}
	
	/**
	 * Register Plumco Team widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_team',
			[
				'label' => esc_html__( 'Team Options', 'plumco-core' ),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'team_title',
			[
				'label' => esc_html__( 'Title Text', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title Text', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'team_subtitle',
			[
				'label' => esc_html__( 'Sub Title Text', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Sub Title Text', 'plumco-core' ),
				'placeholder' => esc_html__( 'Type sub title text here', 'plumco-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'bg_image',
			[
				'label' => esc_html__( 'Team Image', 'plumco-core' ),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'plumco-core'),
			]
		);
		$repeater->add_control(
			'facebook_icon',
			[
				'label' => esc_html__( 'Facebook', 'tmexco-core' ),
				'type' => Controls_Manager::ICON,
				'options' => Controls_Helper_Output::get_include_icons(),
				'frontend_available' => true,
				'default' => 'ti-facebook',
			]
		);
		$repeater->add_control(
			'facebook_link',
			[
				'label' => esc_html__( 'Facebook Link', 'tmexco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'tmexco-core' ),
				'placeholder' => esc_html__( 'Type facebook link here', 'tmexco-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'twitter_icon',
			[
				'label' => esc_html__( 'Twitter', 'tmexco-core' ),
				'type' => Controls_Manager::ICON,
				'options' => Controls_Helper_Output::get_include_icons(),
				'frontend_available' => true,
				'default' => 'ti-twitter-alt',
			]
		);
		$repeater->add_control(
			'twitter_link',
			[
				'label' => esc_html__( 'Twitter Link', 'tmexco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'tmexco-core' ),
				'placeholder' => esc_html__( 'Type twitter link here', 'tmexco-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'pinterest_icon',
			[
				'label' => esc_html__( 'Pinterest', 'tmexco-core' ),
				'type' => Controls_Manager::ICON,
				'options' => Controls_Helper_Output::get_include_icons(),
				'frontend_available' => true,
				'default' => 'ti-pinterest',
			]
		);
		$repeater->add_control(
			'pinterest_link',
			[
				'label' => esc_html__( 'Pinterest Link', 'tmexco-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'tmexco-core' ),
				'placeholder' => esc_html__( 'Type pinterest link here', 'tmexco-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'teamItems_groups',
			[
				'label' => esc_html__( 'Team Items', 'plumco-core' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'team_title' => esc_html__( 'Team', 'plumco-core' ),
					],
					
				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ team_title }}}',
			]
		);

		$this->end_controls_section();// end: Section
		

		// Title
		$this->start_controls_section(
			'section_team_style',
			[
				'label' => esc_html__( 'Item', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'team_bg_color',
			[
				'label' => esc_html__( 'BG Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'team_overly_bg_color',
			[
				'label' => esc_html__( 'Overly BG Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-img:before' => 'background-color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-text h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-text h2' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-text h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'label' => esc_html__( 'Typography', 'plumco-core' ),
				'name' => 'plumco_subtitle_typography',
				'selector' => '{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-text span',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-text span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_padding',
			[
				'label' => __( 'Title Padding', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-text span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
		
		// Icon
		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon Style', 'tmexco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'tmexco-core' ),
				'name' => 'tmexco_icon_typography',
				'selector' => '{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-img ul li a',
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'tmexco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-img ul li a i:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_bg_color',
			[
				'label' => esc_html__( 'BG Color', 'tmexco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-img ul li a' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
		
	}

	/**
	 * Render Team widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$teamItems_groups = !empty( $settings['teamItems_groups'] ) ? $settings['teamItems_groups'] : [];

		// Turn output buffer on
		ob_start();
		?>
		<div class="wpo-team-section">
		    <div class="container">
		        <div class="wpo-team-wrap">
		            <div class="row">
		              <?php 	// Group Param Output
									if( is_array( $teamItems_groups ) && !empty( $teamItems_groups ) ){
									foreach ( $teamItems_groups as $each_items) { 

										$team_title = !empty( $each_items['team_title'] ) ? $each_items['team_title'] : '';
										$team_subtitle = !empty( $each_items['team_subtitle'] ) ? $each_items['team_subtitle'] : '';
										$bg_image = !empty( $each_items['bg_image']['id'] ) ? $each_items['bg_image']['id'] : '';
										$image_url = wp_get_attachment_url( $each_items['bg_image']['id'] );
										$image_alt = get_post_meta( $each_items['bg_image']['id'], '_wp_attachment_image_alt', true);

										$facebook_icon = !empty( $each_items['facebook_icon'] ) ? $each_items['facebook_icon'] : '';
										$facebook_link = !empty( $each_items['facebook_link'] ) ? $each_items['facebook_link'] : '';

										$twitter_icon = !empty( $each_items['twitter_icon'] ) ? $each_items['twitter_icon'] : '';
										$twitter_link = !empty( $each_items['twitter_link'] ) ? $each_items['twitter_link'] : '';

										$pinterest_icon = !empty( $each_items['pinterest_icon'] ) ? $each_items['pinterest_icon'] : '';
										$pinterest_link = !empty( $each_items['pinterest_link'] ) ? $each_items['pinterest_link'] : '';
										?>
		                <div class="col col-lg-3 col-md-6 col-12">
		                    <div class="wpo-team-item">
		                        <div class="wpo-team-img">
		                            <?php if( $image_url ) { echo '<img class="img-responlsive" src="'.esc_url( $image_url ).'" alt="'.esc_attr( $image_alt ).'">'; } ?>
		                            <div class="social">
		                                <ul>
		                                    <?php 
												              	if( $facebook_icon ) { echo '<li><a href="'.esc_url( $facebook_link ).'"><i class="'.esc_attr( $facebook_icon ).'"></i></a></li>'; } 
												              	if( $twitter_icon ) { echo '<li><a href="'.esc_url( $twitter_link ).'"><i class="'.esc_attr( $twitter_icon ).'"></i></a></li>'; } 
												              	if( $pinterest_icon ) { echo '<li><a href="'.esc_url( $pinterest_link ).'"><i class="'.esc_attr( $pinterest_icon ).'"></i></a></li>'; } 
												              ?>
		                                </ul>
		                            </div>
		                        </div>
		                        <div class="wpo-team-text">
		                        <?php 
							              	if( $team_title ) { echo '<h2>'.esc_html( $team_title ).'</h2>'; } 
							              	if( $team_subtitle ) { echo '<span>'.esc_html( $team_subtitle ).'</span>'; }
							              ?>
		                        </div>
		                    </div>
		                </div>
		              <?php }
									} ?>
		            </div>
		        </div>
		    </div>
		</div>
		<?php
			// Return outbut buffer
			echo ob_get_clean();	
		}
	/**
	 * Render Team widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Plumco_Team() );