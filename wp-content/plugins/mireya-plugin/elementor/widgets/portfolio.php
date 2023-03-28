<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Mireya Portfolio Widget.
 *
 * @since 1.0
 */
class Mireya_Portfolio_Widget extends Widget_Base {

	public function get_name() {
		return 'mireya-portfolio';
	}

	public function get_title() {
		return esc_html__( 'Portfolio', 'mireya-plugin' );
	}

	public function get_icon() {
		return 'fas fa-suitcase';
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
			'filters_tab',
			[
				'label' => esc_html__( 'Filters', 'mireya-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'filters_note',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'Filters show only with pagination "Button" or "No"', 'mireya-plugin' ),
				'content_classes' => 'elementor-descriptor',
			]
		);

		$this->add_control(
			'filters',
			[
				'label' => esc_html__( 'Show Filters', 'mireya-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mireya-plugin' ),
				'label_off' => __( 'Hide', 'mireya-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

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
				'options' => $this->get_portfolio_categories(),
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
				'placeholder' => 8,
				'default'     => 8,
			]
		);

		$this->add_control(
			'sort',
			[
				'label'       => esc_html__( 'Sorting By', 'mireya-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'menu_order',
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
				'default' => 'asc',
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
				'label'       => esc_html__( 'Pagination', 'mireya-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no'  => __( 'No', 'mireya-plugin' ),
					'pages' => __( 'Pages', 'mireya-plugin' ),
					'button' => __( 'Button', 'mireya-plugin' ),
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
					'column-2'  => __( '2 Columns', 'mireya-plugin' ),
					'column-3' => __( '3 Columns', 'mireya-plugin' ),
				],
			]
		);

		$this->add_control(
			'masonry',
			[
				'label' => esc_html__( 'Masonry Grid', 'mireya-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Enable', 'mireya-plugin' ),
				'label_off' => __( 'Disable', 'mireya-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_item_details',
			[
				'label' => esc_html__( 'Show Item Details?', 'mireya-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mireya-plugin' ),
				'label_off' => __( 'Hide', 'mireya-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_item_name',
			[
				'label' => esc_html__( 'Show Item Name?', 'mireya-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mireya-plugin' ),
				'label_off' => __( 'Hide', 'mireya-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
		            'show_item_details' => 'yes'
		        ],
			]
		);

		$this->add_control(
			'show_item_desc',
			[
				'label' => esc_html__( 'Show Item Description?', 'mireya-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mireya-plugin' ),
				'label_off' => __( 'Hide', 'mireya-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
		            'show_item_details' => 'yes'
		        ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'filters_styling',
			[
				'label'     => esc_html__( 'Filters', 'mireya-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'filters_color',
			[
				'label'     => esc_html__( 'Link Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-filter .mry-card-category' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'filters_active_color',
			[
				'label'     => esc_html__( 'Link Active Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-filter .mry-card-category.mry-current' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'filters_typography',
				'selector' => '{{WRAPPER}} .mry-filter .mry-card-category',
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
			'item_category_color',
			[
				'label'     => esc_html__( 'Category Color', 'mireya-plugin' ),
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
				'name'     => 'item_category_typography',
				'label'     => esc_html__( 'Category Typography', 'mireya-plugin' ),
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
				'label'     => esc_html__( 'Title Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-item-descr .mry-text',
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
	protected function get_portfolio_categories() {
		$categories = [];

		$args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'      => 'name',
			'order'        => 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'portfolio_categories',
			'pad_counts'	=> false
		);

		$portfolio_categories = get_categories( $args );

		foreach ( $portfolio_categories as $category ) {
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
			'taxonomy'		=> 'portfolio_categories',
			'pad_counts'	=> false,
			'include'		=> $cat_ids
		);

		$pf_categories = get_categories( $cat_args );

		$args = array(
			'post_type'			=> 'portfolio',
			'post_status'		=> 'publish',
			'orderby'			=> $settings['sort'],
			'order'				=> $settings['order'],
			'posts_per_page'	=> $settings['limit'],
			'paged' 			=> $paged
		);

		if( $settings['source'] == 'categories' ) {
			$tax_array = array(
				array(
					'taxonomy' => 'portfolio_categories',
					'field'    => 'id',
					'terms'    => $cat_ids
				)
			);

			$args += array('tax_query' => $tax_array);
		}

		$q = new \WP_Query( $args );

		?>

		<!-- portfolio -->
		<div class="mry-portfolio">
			<div class="container">
				<?php if ( $settings['filters'] && $pf_categories && $settings['pagination'] != 'pages' ) : ?>
				<div class="mry-filter mry-mb-40 mry-fo">
					<a href="#" data-filter="*" class="mry-card-category mry-default-link mry-current"><?php echo esc_html__( 'All Categories', 'mireya-plugin' ); ?></a>
					<?php foreach ( $pf_categories as $category ) : ?>
					<a href="#" data-filter=".category-<?php echo esc_attr( $category->slug ); ?>" class="mry-card-category mry-default-link"><?php echo esc_html( $category->name ); ?></a>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
				<?php if ( $q->have_posts() ) : ?>
				<div class="mry-portfolio-frame">
					<div class="mry-masonry-grid<?php if ( $settings['layout'] == 'column-3' ) : ?> mry-3-col<?php endif; ?><?php if ( $settings['layout'] == 'column-2' ) : ?> mry-2-col<?php endif; ?><?php if ( $settings['masonry'] == 'yes' ) : ?> mry-grid-masonry<?php endif; ?><?php if ( $settings['show_item_details'] != 'yes' ) : ?> mry-grid-hide-details<?php endif; ?><?php if ( $settings['show_item_name'] != 'yes' ) : ?> mry-grid-hide-name<?php endif; ?><?php if ( $settings['show_item_desc'] != 'yes' ) : ?> mry-grid-hide-desc<?php endif; ?>">
						<div class="mry-grid-sizer"></div>

						<?php while ( $q->have_posts() ) : $q->the_post(); ?>
		             		<?php
		             		set_query_var( 'layout', $settings['layout'] );
		             		set_query_var( 'masonry', $settings['masonry'] );
		             		get_template_part( 'template-parts/content', 'portfolio' ); ?>
		          	  	<?php endwhile; ?>

					</div>
				</div>
				<?php
	        	else :
					get_template_part( 'template-parts/content', 'none' );
				endif; wp_reset_postdata();
			  	?>

			  	<?php if ( $settings['pagination'] == 'pages' ) : ?>
		      	<div class="pagination mry-pagination mry-fo">
		    		<?php
					$big = 999999999; // need an unlikely integer

					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $q->max_num_pages,
						'prev_text' => esc_html__( 'Prev', 'mireya-plugin' ),
						'next_text' => esc_html__( 'Next', 'mireya-plugin' ),
					) ); ?>
			  	</div>
				<?php endif; ?>

				<?php if ( $settings['pagination'] == 'button' && $settings['more_btn_link'] ) : ?>
				  <div class="mry-bts text-center">
					<a class="mry-btn mry-btn-color mry-anima-link mry-default-link" href="<?php echo esc_url( $settings['more_btn_link']['url'] ); ?>"<?php if ( $settings['more_btn_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $settings['more_btn_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?>><span><?php echo esc_html( $settings['more_btn_txt'] ); ?></span></a>
				  </div>
				<?php endif; ?>

			</div>
		</div>
		<!-- portfolio end -->

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Mireya_Portfolio_Widget() );
