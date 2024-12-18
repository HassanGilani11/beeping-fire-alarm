<?php
/*
 * Elementor Plumco Case Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Plumco_Case extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-plumco_case';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Project Filter', 'plumco-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-user-preferences';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Plumco Case widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo_plumco_case_filter'];
	}
	
	/**
	 * Register Plumco Case widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){


		$posts = get_posts( 'post_type="project"&numberposts=-1' );
    $PostID = array();
    if ( $posts ) {
      foreach ( $posts as $post ) {
        $PostID[ $post->ID ] = $post->ID;
      }
    } else {
      $PostID[ __( 'No ID\'s found', 'plumco' ) ] = 0;
    }
		
		
		$this->start_controls_section(
			'section_case',
			[
				'label' => esc_html__( 'Project Options', 'plumco-core' ),
			]
		);
		$this->add_control(
			'case_filter',
			[
				'label' => esc_html__( 'Project Filter', 'plumco-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'plumco-core' ),
				'label_off' => esc_html__( 'Hide', 'plumco-core' ),
				'return_value' => 'true',
				'default' => 'true',
			]
		);	
		$this->end_controls_section();// end: Section
		

		$this->start_controls_section(
			'section_case_listing',
			[
				'label' => esc_html__( 'Listing Options', 'plumco-core' ),
			]
		);
		$this->add_control(
			'case_limit',
			[
				'label' => esc_html__( 'Project Limit', 'plumco-core' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
				'description' => esc_html__( 'Enter the number of items to show.', 'plumco-core' ),
			]
		);
		$this->add_control(
			'case_order',
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
			'case_orderby',
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
			'case_show_category',
			[
				'label' => __( 'Certain Categories?', 'plumco-core' ),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => Controls_Helper_Output::get_terms_names( 'project_category'),
				'multiple' => true,
			]
		);
		$this->add_control(
			'case_show_id',
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
			'all_case',
			[
				'label' => esc_html__( 'All case Text', 'plumco-core' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Type your all case text here', 'plumco-core' ),
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
				'selector' => '{{WRAPPER}} .wpo-projects .grid .details h3 a',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-projects .grid .details h3 a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_bg_color',
			[
				'label' => esc_html__( 'BG Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-projects .grid .details h3 a' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .wpo-projects .grid .details h3 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// Details
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'Overly', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_overly_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-projects .grid .project-inner .hover-content' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section


		// Navigation
		$this->start_controls_section(
			'section_nav_style',
			[
				'label' => esc_html__( 'Navigation', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'nav_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-case-section .case-menu li a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'nav_br_color',
			[
				'label' => esc_html__( 'Border Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-case-section .case-menu' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// Navigation Active
		$this->start_controls_section(
			'section_nav_active_style',
			[
				'label' => esc_html__( 'Navigation Active', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'nav_active_color',
			[
				'label' => esc_html__( 'Navigation Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-case-section .case-menu li a.current' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'nav_active_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-case-section .case-menu li a.current' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

	}

	/**
	 * Render Case widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$case_style = !empty( $settings['case_style'] ) ? $settings['case_style'] : '';
		$case_column = !empty( $settings['case_column'] ) ? $settings['case_column'] : '';

		$case_limit = !empty( $settings['case_limit'] ) ? $settings['case_limit'] : '';
		$case_order = !empty( $settings['case_order'] ) ? $settings['case_order'] : '';
		$case_orderby = !empty( $settings['case_orderby'] ) ? $settings['case_orderby'] : '';
		$case_show_category = !empty( $settings['case_show_category'] ) ? $settings['case_show_category'] : [];
		$case_show_id = !empty( $settings['case_show_id'] ) ? $settings['case_show_id'] : [];
		$all_case = !empty( $settings['all_case'] ) ? $settings['all_case'] : '';

		$case_filter  = ( isset( $settings['case_filter'] ) && ( 'true' == $settings['case_filter'] ) ) ? true : false;
	
		$all_case = $all_case ? $all_case : esc_html__( 'All', 'plumco-core' );

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

    if ($case_show_id) {
			$case_show_id = json_encode( $case_show_id );
			$case_show_id = str_replace(array( '[', ']' ), '', $case_show_id);
			$case_show_id = str_replace(array( '"', '"' ), '', $case_show_id);
      $case_show_id = explode(',',$case_show_id);
    } else {
      $case_show_id = '';
    }

		$args = array(
		  // other query params here,
		  'paged' => $my_page,
		  'post_type' => 'project',
		  'posts_per_page' => (int)$case_limit,
		  'category_name' => implode(',', $case_show_category),
		  'orderby' => $case_orderby,
		  'order' => $case_order,
      'post__in' => $case_show_id,
		);

		$plumco_case = new \WP_Query( $args );

		if ( $plumco_case->have_posts() ) :
     $terms = get_terms( 'project_category' ); ?>
     <div class="wpo-projects">
    		<div class="container">
        	<div class="row">
            <div class="col col-xs-12 sortable-gallery">
                <div class="gallery-filters projects-menu">
            		<?php if ( $case_filter ) { ?>
              	<ul>
                  <li><a data-filter="*" href="#" class="current"><?php echo esc_html( $all_case ) ?></a></li>
                   <?php foreach( $terms as $term ):  ?>
                     <li><a data-filter=".<?php echo esc_attr( $term->slug ); ?>" href="#"><?php echo esc_html(  $term->name ); ?></a></li>
                   <?php  endforeach; ?>
              	</ul>
              	<?php } ?> 
              	</div>
        		<div class="projects-grids gallery-container clearfix">
		 			<?php 
						while ( $plumco_case->have_posts()) : $plumco_case->the_post();
						
						$project_options = get_post_meta( get_the_ID(), 'project_options', true );
	          $project_title = isset( $project_options['project_title']) ? $project_options['project_title'] : '';
	          $project_subtitle = isset( $project_options['project_subtitle']) ? $project_options['project_subtitle'] : '';
	          $project_image = isset( $project_options['project_image']) ? $project_options['project_image'] : '';

	          global $post;
	          $image_url = wp_get_attachment_url( $project_image );
	          $image_alt = get_post_meta( $project_image , '_wp_attachment_image_alt', true);

	          $terms = wp_get_post_terms( get_the_ID(), 'project_category');

	          foreach ($terms as $term) {
	            $cat_class = $term->slug;
	          }
	          $count = count($terms);
	          $i=0;
	          $cat_class = '';
	          if ($count > 0) {
	            foreach ($terms as $term) {
	              $i++;
	              $cat_class .= $term->slug .' ';
	              if ($count != $i) {
	                $cat_class .= '';
	              } else {
	                $cat_class .= '';
	              }
	            }
	          }

						?>
	          <div class="grid <?php echo esc_attr( $cat_class ); ?>">
                <div class="project-inner">
                    <div class="img-holder">
                      <?php if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_attr( $image_alt ).'">'; } ?>
                    </div>
                    <div class="hover-content">
                        <div class="details">
                            <?php 
							            		if( $project_title ) { echo '<h3>
							            		<a href="'.esc_url( get_permalink() ).'">'.esc_html( $project_title ).'</a></h3>'; }
							            		if( $project_subtitle ) { echo '<p class="cat">'.esc_html( $project_subtitle ).'</p>'; }
							            	?>
                        </div>
                    </div>
                </div>
            </div>
			       <?php endwhile;
	          	wp_reset_postdata(); ?>
							</div>
						</div>
					</div>
				</div> <!-- end container -->
			</div>
			<?php endif;
			// Return outbut buffer
			echo ob_get_clean();	
		}
	/**
	 * Render Case widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Plumco_Case() );