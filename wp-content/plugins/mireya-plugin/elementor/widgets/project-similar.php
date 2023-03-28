<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Mireya Project Similar Widget.
 *
 * @since 1.0
 */
class Mireya_Project_Similar_Widget extends Widget_Base {

	public function get_name() {
		return 'mireya-project-similar';
	}

	public function get_title() {
		return esc_html__( 'Project Similar', 'mireya-plugin' );
	}

	public function get_icon() {
		return 'fa fa-clone';
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
			'content_tab',
			[
				'label' => esc_html__( 'Content', 'mireya-plugin' ),
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
			'subtitle',
			[
				'label'       => esc_html__( 'Subtitle', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter subtitle', 'mireya-plugin' ),
				'default'     => esc_html__( 'Subtitle', 'mireya-plugin' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'heading_styling',
			[
				'label'     => esc_html__( 'Heading Styling', 'mireya-plugin' ),
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
	}


	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_inline_editing_attributes( 'subtitle', 'basic' );

		$item_id = get_the_ID();

		$not_posts = array();
		$not_posts[] = $item_id;

		$args = array(
			'post_type'			=> 'portfolio',
			'post_status'		=> 'publish',
			'orderby'			=> 'rand',
			'order'				=> 'asc',
			'post__not_in'		=> $not_posts,
			'posts_per_page'	=> 6,
			'paged' 			=> 1
		);

		$q = new \WP_Query( $args );

		?>

		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="mry-main-title mry-title-center mry-p-0-40">
						<?php if ( $settings['subtitle'] ) : ?>
						<div class="mry-subtitle mry-mb-20 mry-fo">
							<span <?php echo $this->get_render_attribute_string( 'subtitle' ); ?>>
			          			<?php echo wp_kses_post( $settings['subtitle'] ); ?>
			         		</span>
						</div>
						<?php endif; ?>
						<?php if ( $settings['title'] ) : ?>
						<h2 class="mry-fo">
							<span <?php echo $this->get_render_attribute_string( 'title' ); ?>>
			          			<?php echo wp_kses_post( $settings['title'] ); ?>
			         		</span>
						</h2>
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
				<?php if ( $q->have_posts() ) : ?>
				<div class="col-lg-12">
					<div class="swiper-container mry-blog-slider">
						<div class="swiper-wrapper">
							<?php while ( $q->have_posts() ) : $q->the_post(); ?>
							<div class="swiper-slide">
								<?php get_template_part( 'template-parts/content', 'portfolio-carousel' ); ?>
							</div>
							<?php endwhile; ?>
						</div>
					</div>

				</div>
				<?php endif; wp_reset_postdata(); ?>
			</div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Mireya_Project_Similar_Widget() );
