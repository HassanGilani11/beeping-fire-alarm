<?php
/*
 * Elementor Plumco Service Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Plumco_Service extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-plumco_service';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Service', 'plumco-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-icon-box';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Plumco Service widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-plumco_service'];
	}
	
	/**
	 * Register Plumco Service widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){


		$posts = get_posts( 'post_type="service"&numberposts=-1' );
    $PostID = array();
    if ( $posts ) {
      foreach ( $posts as $post ) {
        $PostID[ $post->ID ] = $post->ID;
      }
    } else {
      $PostID[ __( 'No ID\'s found', 'plumco' ) ] = 0;
    }
		
	
		$this->start_controls_section(
			'section_service_listing',
			[
				'label' => esc_html__( 'Listing Options', 'plumco-core' ),
			]
		);
		$this->add_control(
			'service_style',
			[
				'label' => esc_html__( 'Service Style', 'finco-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__( 'Style One', 'finco-core' ),
					'style-two' => esc_html__( 'Style Two', 'finco-core' ),
				],
				'default' => 'style-one',
				'description' => esc_html__( 'Select your service style.', 'finco-core' ),
			]
		);
		$this->add_control(
			'service_limit',
			[
				'label' => esc_html__( 'Service Limit', 'plumco-core' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
				'description' => esc_html__( 'Enter the number of items to show.', 'plumco-core' ),
			]
		);
		$this->add_control(
			'service_order',
			[
				'label' => __( 'Order', 'plumco-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ASC' => esc_html__( 'Asending', 'plumco-core' ),
					'DESC' => esc_html__( 'Desending', 'plumco-core' ),
				],
				'default' => 'DESC',
			]
		);
		$this->add_control(
			'service_orderby',
			[
				'label' => __( 'Order By', 'plumco-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'None', 'plumco-core' ),
					'ID' => esc_html__( 'ID', 'plumco-core' ),
					'author' => esc_html__( 'Author', 'plumco-core' ),
					'title' => esc_html__( 'Title', 'plumco-core' ),
					'date' => esc_html__( 'Date', 'plumco-core' ),
				],
				'default' => 'date',
			]
		);
		$this->add_control(
			'service_show_category',
			[
				'label' => __( 'Certain Categories?', 'plumco-core' ),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => Controls_Helper_Output::get_terms_names( 'service_category'),
				'multiple' => true,
			]
		);
		$this->add_control(
			'service_show_id',
			[
				'label' => __( 'Certain ID\'s?', 'plumco-core' ),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => $PostID,
				'multiple' => true,
			]
		);
		$this->add_control(
			'short_content',
			[
				'label' => esc_html__( 'Excerpt Length', 'plumco-core' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
				'default' => 16,
				'description' => esc_html__( 'How many words you want in short content paragraph.', 'plumco-core' ),
			]
		);
		$this->add_control(
			'read_more_txt',
			[
				'label' => esc_html__( 'Read More Text', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Type your Read More text here', 'plumco-core' ),
			]
		);
		$this->end_controls_section();// end: Section

		
		
	
		// Service Item
		$this->start_controls_section(
			'section_service_item_style',
			[
				'label' => esc_html__( 'Service Box ', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'service_box_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .wpo-service-item' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

	
		// Title
		$this->start_controls_section(
			'service_section_title_style',
			[
				'label' => esc_html__( 'Title', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'plumco-core' ),
				'name' => 'service_plumco_title_typography',
				'selector' => '{{WRAPPER}} .wpo-service-section .wpo-service-item .wpo-service-text h2 a, .wpo-service-section-s2 .wpo-service-item .wpo-service-text h2 a',
			]
		);
		$this->add_control(
			'service_section_title_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .wpo-service-item .wpo-service-text h2 a, .wpo-service-section-s2 .wpo-service-item .wpo-service-text h2 a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_section_title_padding',
			[
				'label' => esc_html__( 'Title Padding', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .wpo-service-item .wpo-service-text h2, .wpo-service-section-s2 .wpo-service-item .wpo-service-text h2 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .wpo-service-section .wpo-service-item .wpo-service-text p, .wpo-service-section-s2 .wpo-service-item .wpo-service-text p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .wpo-service-item .wpo-service-text p, .wpo-service-section-s2 .wpo-service-item .wpo-service-text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// Read More
		$this->start_controls_section(
			'service_section_readmore_style',
			[
				'label' => esc_html__( 'Read More', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'service_read_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .wpo-service-item .wpo-service-text a.readmore' => 'color:  {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_readmore_icon_color',
			[
				'label' => esc_html__( 'Active Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .wpo-service-item .wpo-service-text a i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		

		
	}

	/**
	 * Render Service widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();

		$service_style = !empty( $settings['service_style'] ) ? $settings['service_style'] : '';
		$service_limit = !empty( $settings['service_limit'] ) ? $settings['service_limit'] : '';
		$service_order = !empty( $settings['service_order'] ) ? $settings['service_order'] : '';
		$service_orderby = !empty( $settings['service_orderby'] ) ? $settings['service_orderby'] : '';
		$service_show_category = !empty( $settings['service_show_category'] ) ? $settings['service_show_category'] : [];
		$service_show_id = !empty( $settings['service_show_id'] ) ? $settings['service_show_id'] : [];
		$short_content = !empty( $settings['short_content'] ) ? $settings['short_content'] : '';
		$excerpt_length = $short_content ? $short_content : '16';
		$read_more_txt = !empty( $settings['read_more_txt'] ) ? $settings['read_more_txt'] : '';
		$read_more_txt = $read_more_txt ? $read_more_txt : esc_html__( 'Read More', 'jhair-core' );

		if ( $service_style == 'style-two' ) {
			$service_wrapper = 'wpo-service-section-s2';
		}	else {
			$service_wrapper = 'wpo-service-section';
		}

		// Turn output buffer on
		ob_start();

		// Pagination
		global $paged;
		if( get_query_var( 'paged' ) )
		  $my_page = get_query_var( 'paged' );
		else {
		  if( get_query_var( 'page' ) )
			$my_page = get_query_var( 'page' );
		  else
			$my_page = 1;
		  set_query_var( 'paged', $my_page );
		  $paged = $my_page;
		}

    if ($service_show_id) {
			$service_show_id = json_encode( $service_show_id );
			$service_show_id = str_replace(array( '[', ']' ), '', $service_show_id);
			$service_show_id = str_replace(array( '"', '"' ), '', $service_show_id);
      $service_show_id = explode(',',$service_show_id);
    } else {
      $service_show_id = '';
    }

		$args = array(
		  // other query params here,
		  'paged' => $my_page,
		  'post_type' => 'service',
		  'posts_per_page' => (int)$service_limit,
		  'service_category' => implode(',', $service_show_category),
		  'orderby' => $service_orderby,
		  'order' => $service_order,
      'post__in' => $service_show_id,
		);

		$plumco_service = new \WP_Query( $args ); 
		if ( $plumco_service->have_posts()) :

		?>

		<div class="<?php echo esc_attr( $service_wrapper ); ?>">
		    <div class="container">
		        <div class="row">
		        	<?php 
								while ( $plumco_service->have_posts()) : $plumco_service->the_post();
								
								$service_options = get_post_meta( get_the_ID(), 'service_options', true );
				        $service_title = isset($service_options['service_title']) ? $service_options['service_title'] : '';
				        $service_excerpt = isset($service_options['service_excerpt']) ? $service_options['service_excerpt'] : '';
				        $service_icon = isset($service_options['service_icon']) ? $service_options['service_icon'] : '';
				        $service_thumb = isset($service_options['service_thumb']) ? $service_options['service_thumb'] : '';
			  				global $post;
			  				// service
			          $icon_url = wp_get_attachment_url( $service_icon );
			          $icon_alt = get_post_meta( $service_icon , '_wp_attachment_image_alt', true);

			  				// service
			          $image_url = wp_get_attachment_url( $service_thumb );
			          $image_alt = get_post_meta( $service_thumb , '_wp_attachment_image_alt', true);



			          ?>
		            <div class="col-lg-4 col-md-6 col-12">
		                <div class="wpo-service-item">
		                    <div class="wpo-service-img">
		                    <?php 
		                      if (  $service_style == 'style-one' ) {
		                     	 	if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_url( $image_alt ).'">'; } 
		                      } else {
		                      	if( $icon_url ) { echo '<img src="'.esc_url( $icon_url ).'" alt="'.esc_url( $icon_alt ).'">'; } 
		                      }
		                    ?>
		                    </div>
		                    <div class="wpo-service-text">
		                        <h2>
		                        	<a href="<?php echo esc_url( get_permalink() ); ?>">
		                        		<?php echo esc_html( $service_title ); ?>
		                        	</a>
		                        </h2>
		                        <p><?php echo esc_html( $service_excerpt ); ?></p>
		                        <?php if ( $service_style == 'style-one' ) {  ?>
															<a class="readmore" href="<?php echo esc_url( get_permalink() ); ?>">
			                        	<?php echo esc_html( $read_more_txt ); ?>
			                        	<i class="fa fa-angle-double-right" aria-hidden="true"></i>
			                        </a>
		                        <?php } ?>
		                    </div>
		                </div>
		            </div>
		            <?php 
							  endwhile;
							  wp_reset_postdata(); 
							  ?>
		        </div>
		    </div>
		</div>
			<?php
			endif;
			// Return outbut buffer
			echo ob_get_clean();	
		}
	/**
	 * Render Service widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Plumco_Service() );