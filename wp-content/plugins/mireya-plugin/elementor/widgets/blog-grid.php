<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Mireya Blog Grid Widget.
 *
 * @since 1.0
 */
class Mireya_Blog_Grid_Widget extends Widget_Base {

	public function get_name() {
		return 'mireya-blog-grid';
	}

	public function get_title() {
		return esc_html__( 'Blog (Grid)', 'mireya-plugin' );
	}

	public function get_icon() {
		return 'far fa-newspaper';
	}

	public function get_categories() {
		return [ 'mireya-category' ];
	}

	/**
	 * Register widget controls.
	 *
	 * @since 1.0
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'items_tab',
			[
				'label' => esc_html__( 'Items', 'mireya-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'source',
			[
				'label'       => esc_html__( 'Source', 'mireya-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all'  => __( 'All', 'mireya-plugin' ),
					'categories' => __( 'Categories', 'mireya-plugin' ),
				],
			]
		);

		$this->add_control(
			'source_categories',
			[
				'label'       => esc_html__( 'Source', 'mireya-plugin' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $this->get_blog_categories(),
				'condition' => [
		            'source' => 'categories'
		        ],
			]
		);

		$this->add_control(
			'limit',
			[
				'label'       => esc_html__( 'Number of Items', 'mireya-plugin' ),
				'type'        => Controls_Manager::NUMBER,
				'placeholder' => 6,
				'default'     => 6,
			]
		);

		$this->add_control(
			'sort',
			[
				'label'       => esc_html__( 'Sorting By', 'mireya-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date'  => __( 'Date', 'mireya-plugin' ),
					'title' => __( 'Title', 'mireya-plugin' ),
					'rand' => __( 'Random', 'mireya-plugin' ),
					'menu_order' => __( 'Order', 'mireya-plugin' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'       => esc_html__( 'Order', 'mireya-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc'  => __( 'ASC', 'mireya-plugin' ),
					'desc' => __( 'DESC', 'mireya-plugin' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'pagination_tab',
			[
				'label' => esc_html__( 'Pagination', 'mireya-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'pagination',
			[
				'label'       => esc_html__( 'Pagination Type', 'mireya-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'pages',
				'options' => [
					'pages' => __( 'Pages', 'mireya-plugin' ),
					'button' => __( 'Button', 'mireya-plugin' ),
					'no' => __( 'No', 'mireya-plugin' ),
				],
			]
		);

		$this->add_control(
			'more_btn_txt',
			[
				'label'       => esc_html__( 'Button (title)', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter button', 'mireya-plugin' ),
				'default'     => esc_html__( 'All Posts', 'mireya-plugin' ),
				'condition' => [
		            'pagination' => 'button'
		        ],
			]
		);

		$this->add_control(
			'more_btn_link',
			[
				'label'       => esc_html__( 'Button (link)', 'mireya-plugin' ),
				'type'        => Controls_Manager::URL,
				'show_external' => true,
				'condition' => [
		            'pagination' => 'button'
		        ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'settings_tab',
			[
				'label' => esc_html__( 'Settings', 'mireya-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'       => esc_html__( 'Layout', 'mireya-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'column-3',
				'options' => [
					'column-1'  => __( '1 Columns', 'mireya-plugin' ),
					'column-2'  => __( '2 Columns', 'mireya-plugin' ),
					'column-3' => __( '3 Columns', 'mireya-plugin' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'items_styling',
			[
				'label'     => esc_html__( 'Items', 'mireya-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_date_color',
			[
				'label'     => esc_html__( 'Date Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-card-item .mry-card-cover-frame .mry-badge' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_date_typography',
				'label'     => esc_html__( 'Date Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-card-item .mry-card-cover-frame .mry-badge',
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label'     => esc_html__( 'Title Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-item-descr h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'label'     => esc_html__( 'Title Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-item-descr h4',
			]
		);

		$this->add_control(
			'item_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-item-descr .mry-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_text_typography',
				'label'     => esc_html__( 'Text Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-item-descr .mry-text',
			]
		);

		$this->add_control(
			'item_more_color',
			[
				'label'     => esc_html__( 'Readmore Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-item-descr .mry-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_more_typography',
				'label'     => esc_html__( 'Readmore Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-item-descr .mry-link',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'pagination_styling',
			[
				'label'     => esc_html__( 'Pagination', 'mireya-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label'     => esc_html__( 'Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-pagination a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pagination_typography',
				'selector' => '{{WRAPPER}} .mry-pagination',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render Categories List.
	 *
	 * @since 1.0
	 */
	protected function get_blog_categories() {
		$categories = [];

		$args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'DESC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'category',
			'pad_counts'	=> false
		);

		$blog_categories = get_categories( $args );

		foreach ( $blog_categories as $category ) {
			$categories[$category->term_id] = $category->name;
		}

		return $categories;
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$page_id = get_the_ID();

		if ( $settings['source'] == 'all' ) {
			$cat_ids = '';
		} else {
			$cat_ids = $settings['source_categories'];
		}

		$cat_args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'DESC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'category',
			'pad_counts'	=> false,
			'include'		=> $cat_ids
		);

		$bp_categories = get_categories( $cat_args );

		$args = array(
			'post_type'			=> 'post',
			'post_status'		=> 'publish',
			'orderby'			=> $settings['sort'],
			'order'				=> $settings['order'],
			'posts_per_page'	=> $settings['limit'],
			'paged' 			=> $paged
		);

		if( $settings['source'] == 'categories' ) {
			$tax_array = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'id',
					'terms'    => $cat_ids
				)
			);

			$args += array('tax_query' => $tax_array);
		}

		$q = new \WP_Query( $args );

		?>

		<!-- blog -->
		<div class="mry-portfolio" id="mry-anchor">
			<div class="container">

				<?php if ( $q->have_posts() ) : ?>
				<div class="mry-portfolio-frame">
					<div class="mry-masonry-grid<?php if ( $settings['layout'] == 'column-3' ) : ?> mry-3-col<?php endif; ?><?php if ( $settings['layout'] == 'column-2' ) : ?> mry-2-col<?php endif; ?><?php if ( $settings['layout'] == 'column-1' ) : ?> mry-1-col<?php endif; ?>">
						<div class="mry-grid-sizer"></div>

						<?php while ( $q->have_posts() ) : $q->the_post(); ?>
						<div class="mry-masonry-grid-item<?php if ( $settings['layout'] == 'column-3' ) : ?> mry-masonry-grid-item-33<?php endif; ?><?php if ( $settings['layout'] == 'column-2' ) : ?> mry-masonry-grid-item-50<?php endif; ?><?php if ( $settings['layout'] == 'column-1' ) : ?> mry-masonry-grid-item-100<?php endif; ?>">
							<?php get_template_part( 'template-parts/content-grid' ); ?>
						</div>
						<?php endwhile; ?>
					</div>
				</div>
				<?php else : ?>
			  	<div class="col-lg-12">
			  		<?php get_template_part( 'template-parts/content', 'none' ); ?>
			  	</div>
			  	<?php endif; ?>

			  	<?php if ( $q->have_posts() ) : ?>
			  	<?php if ( $settings['pagination'] == 'pages' ) : ?>
				<div class="mry-pagination mry-fo">
					<?php
						$big = 999999999; // need an unlikely integer

						echo paginate_links( array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' => '?paged=%#%',
							'current' => max( 1, get_query_var('paged') ),
							'total' => $q->max_num_pages,
							'prev_text' => esc_html__( 'Prev', 'mireya-plugin' ),
							'next_text' => esc_html__( 'Next', 'mireya-plugin' ),
						) );
					?>
				</div>
				<?php endif; ?>

		    	<?php if ( $settings['pagination'] == 'button' && $settings['more_btn_link'] ) : ?>
				<div class="mry-bts text-center">
					<a class="mry-btn mry-btn-color mry-anima-link mry-default-link" href="<?php echo esc_url( $settings['more_btn_link']['url'] ); ?>"<?php if ( $settings['more_btn_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $settings['more_btn_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?>><span><?php echo esc_html( $settings['more_btn_txt'] ); ?></span></a>
				</div>
				<?php endif; ?>
				<?php endif; wp_reset_postdata(); ?>
			</div>
		</div>
		<!-- blog end -->

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Mireya_Blog_Grid_Widget() );
