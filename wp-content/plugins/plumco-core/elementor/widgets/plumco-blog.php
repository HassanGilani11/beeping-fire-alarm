<?php
/*
 * Elementor Plumco Blog Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Plumco_Blog extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-plumco_blog';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Blog', 'plumco-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-post-list';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Plumco Blog widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-plumco_blog'];
	}
	
	/**
	 * Register Plumco Blog widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){

		$posts = get_posts( 'post_type="post"&numberposts=-1' );
    $PostID = array();
    if ( $posts ) {
      foreach ( $posts as $post ) {
        $PostID[ $post->ID ] = $post->ID;
      }
    } else {
      $PostID[ __( 'No ID\'s found', 'plumco' ) ] = 0;
    }
		
		
		$this->start_controls_section(
			'section_blog_metas',
			[
				'label' => esc_html__( 'Meta\'s Options', 'plumco-core' ),
			]
		);
		$this->add_control(
			'blog_image',
			[
				'label' => esc_html__( 'Image', 'plumco-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'plumco-core' ),
				'label_off' => esc_html__( 'Hide', 'plumco-core' ),
				'return_value' => 'true',
				'default' => 'true',
			]
		);
		$this->add_control(
			'blog_date',
			[
				'label' => esc_html__( 'Date', 'plumco-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'plumco-core' ),
				'label_off' => esc_html__( 'Hide', 'plumco-core' ),
				'return_value' => 'true',
				'default' => 'true',
			]
		);
		$this->add_control(
			'blog_tags',
			[
				'label' => esc_html__( 'Tags', 'plumco-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'plumco-core' ),
				'label_off' => esc_html__( 'Hide', 'plumco-core' ),
				'return_value' => 'true',
				'default' => 'true',
			]
		);
		$this->end_controls_section();// end: Section


		$this->start_controls_section(
			'section_blog_listing',
			[
				'label' => esc_html__( 'Listing Options', 'plumco-core' ),
			]
		);
		$this->add_control(
			'blog_limit',
			[
				'label' => esc_html__( 'Blog Limit', 'plumco-core' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
				'description' => esc_html__( 'Enter the number of items to show.', 'plumco-core' ),
			]
		);
		$this->add_control(
			'blog_order',
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
			'blog_orderby',
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
			'blog_show_category',
			[
				'label' => __( 'Certain Categories?', 'plumco-core' ),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => Controls_Helper_Output::get_terms_names( 'category'),
				'multiple' => true,
			]
		);
		$this->add_control(
			'blog_show_id',
			[
				'label' => __( 'Certain ID\'s?', 'plumco-core' ),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => $PostID,
				'multiple' => true,
			]
		);
		$this->add_control(
			'blog_pagination',
			[
				'label' => esc_html__( 'Pagination', 'plumco-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'plumco-core' ),
				'label_off' => esc_html__( 'Hide', 'plumco-core' ),
				'return_value' => 'true',
				'default' => 'true',
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
				'selector' => '{{WRAPPER}} .wpo-blog-section .wpo-blog-item .wpo-blog-content h2 a',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-blog-section .wpo-blog-item .wpo-blog-content h2 a' => 'color: {{VALUE}};'
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
					'{{WRAPPER}} .wpo-blog-section .wpo-blog-item .wpo-blog-content h2 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// User
		$this->start_controls_section(
			'section_user_title_style',
			[
				'label' => esc_html__( 'User', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'plumco-core' ),
				'name' => 'plumco_user_title_typography',
				'selector' => '{{WRAPPER}} .wpo-blog-section .wpo-blog-item .wpo-blog-content ul li ',
			]
		);
		$this->add_control(
			'user_title_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-blog-section .wpo-blog-item .wpo-blog-content ul li' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'user_title_padding',
			[
				'label' => esc_html__( 'Title Padding', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-blog-section .wpo-blog-item .wpo-blog-content ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// Tags
		$this->start_controls_section(
			'section_blog_tags_style',
			[
				'label' => esc_html__( 'Date', 'plumco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'plumco-core' ),
				'name' => 'plumco_blog_tags_typography',
				'selector' => '{{WRAPPER}} .wpo-blog-section .wpo-blog-item .wpo-blog-content .date',
			]
		);
		$this->add_control(
			'blog_tags_color',
			[
				'label' => esc_html__( 'Color', 'plumco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-blog-section .wpo-blog-item .wpo-blog-content .date' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'blog_tags_padding',
			[
				'label' => esc_html__( 'Title Padding', 'plumco-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-blog-section .wpo-blog-item .wpo-blog-content .date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		
	}

	/**
	 * Render Blog widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();

		$blog_limit = !empty( $settings['blog_limit'] ) ? $settings['blog_limit'] : '';
		$blog_image  = ( isset( $settings['blog_image'] ) && ( 'true' == $settings['blog_image'] ) ) ? true : false;
		$blog_date  = ( isset( $settings['blog_date'] ) && ( 'true' == $settings['blog_date'] ) ) ? true : false;
		$blog_tags  = ( isset( $settings['blog_tags'] ) && ( 'true' == $settings['blog_tags'] ) ) ? true : false;

		$blog_order = !empty( $settings['blog_order'] ) ? $settings['blog_order'] : '';
		$blog_orderby = !empty( $settings['blog_orderby'] ) ? $settings['blog_orderby'] : '';
		$blog_show_category = !empty( $settings['blog_show_category'] ) ? $settings['blog_show_category'] : [];
		$blog_show_id = !empty( $settings['blog_show_id'] ) ? $settings['blog_show_id'] : [];
		$blog_pagination  = ( isset( $settings['blog_pagination'] ) && ( 'true' == $settings['blog_pagination'] ) ) ? true : false;

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

    if ($blog_show_id) {
			$blog_show_id = json_encode( $blog_show_id );
			$blog_show_id = str_replace(array( '[', ']' ), '', $blog_show_id);
			$blog_show_id = str_replace(array( '"', '"' ), '', $blog_show_id);
      $blog_show_id = explode(',',$blog_show_id);
    } else {
      $blog_show_id = '';
    }

		$args = array(
		  // other query params here,
		  'paged' => $my_page,
		  'post_type' => 'post',
		  'posts_per_page' => (int)$blog_limit,
		  'category_name' => implode(',', $blog_show_category),
		  'orderby' => $blog_orderby,
		  'order' => $blog_order,
      'post__in' => $blog_show_id,
		);

		$plumco_post = new \WP_Query( $args ); ?>
		<div class="wpo-blog-section">
	    <div class="container">
	        <div class="wpo-blog-items">
	            <div class="row">
	               <?php 
								  if ($plumco_post->have_posts()) : while ($plumco_post->have_posts()) : $plumco_post->the_post();
								  $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
								  $large_alt = get_post_meta( get_post_thumbnail_id(get_the_ID()) , '_wp_attachment_image_alt', true); 
								  $large_image = $large_image[0];  

								  $post_options = get_post_meta( get_the_ID(), 'post_options', true );
									$grid_image = isset( $post_options['grid_image'] ) ? $post_options['grid_image'] : '';
									$image_url = wp_get_attachment_url( $grid_image );
				          $image_alt = get_post_meta( $grid_image , '_wp_attachment_image_alt', true); 

				          ?>
	                <div class="col col-lg-4 col-md-6 col-12">
	                    <div class="wpo-blog-item">
	                        <div class="wpo-blog-img">
	                        <?php if ( $image_url ) { ?>
				                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr( $image_alt); ?>">
				                  <?php } ?>
	                        </div>
	                        <div class="wpo-blog-content">
	                        		<?php if ( $blog_date ) { ?>
				                      <i class="ti-timer"></i><span class="date"><?php echo esc_html( get_the_date('d F, Y') );  ?></span>
				                      <?php }?>
	                           <h2>
					                	 	<a href="<?php echo esc_url( get_permalink() ); ?>">
					                	 		<?php echo esc_html(get_the_title()); ?>
					                	 	</a>
					                	 </h2>
	                            <ul>
                                <li><i class="fi flaticon-user author"></i>
                                	<?php echo get_the_author_meta('display_name', get_the_author_meta( 'ID' ) ); ?></li>
                                <li><i class="fi ti-comment-alt"></i>
																 <a class="plumco-comment" href="<?php echo esc_url( get_comments_link() ); ?>">
											              <?php printf( esc_html( _nx( 'Comment (%1$s)', 'Comments (%1$s)', get_comments_number(), 'comments title', 'plumco' ) ), '<span class="comment">'.number_format_i18n( get_comments_number() ).'</span>','<span>' . get_the_title() . '</span>' ); ?>
											          </a>
								              </li>
	                            </ul>
	                        </div>
	                    </div>
	                </div>
	                <?php 
								 	endwhile;
								  endif;
								  wp_reset_postdata();
									if ( $blog_pagination ) { ?>
									  <div class="page-pagination-wrap">
									  <?php 	echo '<div class="paginations">';
											$big = 999999999;
											echo paginate_links( array(
				                'base'      => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
				                'format'    => '?paged=%#%',
				                'total'     => $plumco_post->max_num_pages,
				                'show_all'  => false,
				                'current'   => max( 1, $my_page ),
												'prev_text'    => '<div class="fi flaticon-back"></div>',
												'next_text'    => '<div class="fi flaticon-next"></div>',
				                'mid_size'  => 1,
				                'type'      => 'list'
				              ) );
					        	echo '</div>'; ?>
									<?php } ?>
	            </div>
	        </div>
	    </div> <!-- end container -->
		</div>
		<?php
			// Return outbut buffer
			echo ob_get_clean();	
		}
	/**
	 * Render Blog widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Plumco_Blog() );