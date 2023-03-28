<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Mireya Blog Carousel Widget.
 *
 * @since 1.0
 */
class Mireya_Blog_Carousel_Widget extends Widget_Base {

	public function get_name() {
		return 'mireya-blog-carousel';
	}

	public function get_title() {
		return esc_html__( 'Blog (Carousel)', 'mireya-plugin' );
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
			'heading_tab',
			[
				'label' => esc_html__( 'Title', 'mireya-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'mireya-plugin' ),
				'default'     => esc_html__( 'Title', 'mireya-plugin' ),
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'       => esc_html__( 'Title Tag', 'mireya-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1'  => __( 'H1', 'mireya-plugin' ),
					'h2' => __( 'H2', 'mireya-plugin' ),
					'h3' => __( 'H3', 'mireya-plugin' ),
					'h4' => __( 'H4', 'mireya-plugin' ),
					'div' => __( 'DIV', 'mireya-plugin' ),
				],
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label'       => esc_html__( 'Subtitle', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter subtitle', 'mireya-plugin' ),
				'default'     => esc_html__( 'Subtitle', 'mireya-plugin' ),
			]
		);

		$this->add_control(
			'num',
			[
				'label'       => esc_html__( 'Num', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter num', 'mireya-plugin' ),
				'default'     => esc_html__( '01', 'mireya-plugin' ),
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
			'heading_styling',
			[
				'label'     => esc_html__( 'Heading', 'mireya-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-main-title .mry-title--h' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'     => esc_html__( 'Title Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-main-title .mry-title--h',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => esc_html__( 'Subtitle Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-main-title .mry-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'     => esc_html__( 'Subtitle Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-main-title .mry-subtitle',
			]
		);

		$this->add_control(
			'num_color',
			[
				'label'     => esc_html__( 'Num Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-main-title .mry-numbering .mry-border-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'num_typography',
				'label'     => esc_html__( 'Num Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-main-title .mry-numbering .mry-border-text',
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

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_inline_editing_attributes( 'subtitle', 'none' );
		$this->add_inline_editing_attributes( 'num', 'none' );


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
			'paged' 			=> 1
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

		<div class="mry-about mry-about-blog mry-p-100-0">
			<div class="container">
				<div class="row justify-content-center">
					<?php if ( $settings['title'] || $settings['subtitle'] || $settings['num'] ) : ?>
					<div class="col-lg-12">
						<div class="mry-main-title mry-title-center mry-p-0-40">
							<?php if ( $settings['subtitle'] || $settings['num'] ) : ?>
							<div class="mry-numbering mry-fo">
								<?php if ( $settings['num'] ) : ?>
								<div class="mry-border-text">
									<span <?php echo $this->get_render_attribute_string( 'num' ); ?>>
						          		<?php echo wp_kses_post( $settings['num'] ); ?>
						         	</span>
								</div>
								<?php endif; ?>
								<?php if ( $settings['subtitle'] ) : ?>
								<div class="mry-subtitle">
									<span <?php echo $this->get_render_attribute_string( 'subtitle' ); ?>>
						          		<?php echo wp_kses_post( $settings['subtitle'] ); ?>
						         	</span>
								</div>
								<?php endif; ?>
							</div>
							<?php endif; ?>
							<?php if ( $settings['title'] ) : ?>
							<<?php echo esc_attr( $settings['title_tag'] ); ?> class="mry-fo mry-title--h">
								<span <?php echo $this->get_render_attribute_string( 'title' ); ?>>
					          		<?php echo wp_kses_post( $settings['title'] ); ?>
					         	</span>
							</<?php echo esc_attr( $settings['title_tag'] ); ?>>
							<?php endif; ?>

							<div class="mry-arrows mry-fo">
								<div class="mry-sl-nav">
									<div class="mry-prev mry-button-blog-prev mry-magnetic-link"><span class="mry-magnetic-object"><i class="fas fa-arrow-left"></i></span></div>
									<div class="mry-next mry-button-blog-next mry-magnetic-link"><span class="mry-magnetic-object"><i class="fas fa-arrow-right"></i></span></div>
								</div>
								<div class="mry-label mry-fo"><?php echo esc_html__( 'Slider Navigation', 'mireya-plugin' ); ?></div>
							</div>
						</div>
					</div>
					<?php endif; ?>
					<?php if ( $q->have_posts() ) : ?>
					<div class="col-lg-12">
						<div class="swiper-container mry-blog-slider">
							<div class="swiper-wrapper">
								<?php while ( $q->have_posts() ) : $q->the_post(); ?>
									<?php get_template_part( 'template-parts/content-carousel' ); ?>
								<?php endwhile; ?>
							</div>
						</div>
					</div>
					<?php endif; wp_reset_postdata(); ?>
				</div>
			</div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Mireya_Blog_Carousel_Widget() );
