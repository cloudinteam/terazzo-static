<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Mireya Project Started Widget.
 *
 * @since 1.0
 */
class Mireya_Project_Started_Widget extends Widget_Base {

	public function get_name() {
		return 'mireya-project-started';
	}

	public function get_title() {
		return esc_html__( 'Project Started', 'mireya-plugin' );
	}

	public function get_icon() {
		return 'fas fa-chalkboard-teacher';
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
			'scroll_button_tab',
			[
				'label' => esc_html__( 'Scroll Button', 'mireya-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'scroll_button_show',
			[
				'label' => esc_html__( 'Scroll Button', 'mireya-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mireya-plugin' ),
				'label_off' => __( 'Hide', 'mireya-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'scroll_text',
			[
				'label'       => esc_html__( 'Scroll Text', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your text', 'mireya-plugin' ),
				'default'     => esc_html__( 'Scroll Down ', 'mireya-plugin' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_styling',
			[
				'label'     => esc_html__( 'Content Styling', 'mireya-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-banner .mry-title--h' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'     => esc_html__( 'Title Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-banner .mry-title--h',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => esc_html__( 'Subtitle Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-banner .mry-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'     => esc_html__( 'Subtitle Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-banner .mry-subtitle',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Text Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-banner .mry-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'     => esc_html__( 'Text Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-banner .mry-text',
			]
		);

		$this->add_control(
			'scroll_button_color',
			[
				'label'     => esc_html__( 'Scroll Button Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-banner .mry-scroll-hint-frame .mry-scroll-hint span' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .mry-banner .mry-scroll-hint-frame .mry-scroll-hint span:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .mry-banner .mry-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'scroll_button_typography',
				'label'     => esc_html__( 'Scroll Button Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-banner .mry-label',
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

		$this->add_inline_editing_attributes( 'scroll_text', 'none' );

		$item_id = get_the_ID();

		$bg_image = get_the_post_thumbnail_url( $item_id, 'mireya_1920xAuto' );
		$categories_list = get_the_terms( $item_id, 'portfolio_categories' );
		$short_description = get_field( 'short_description', $item_id );
		$title = get_the_title( $item_id );

		$title_array = explode( ' ', $title );
		$title_length = count( $title_array );
		$title_middle = ( int ) ( $title_length / 2 );

		$title_1 = '';
		$title_2 = '';

		for ( $i = 0; $i<$title_middle; $i++ ) {
			$title_1 .= $title_array[$i] . ' ';
		}
		for ( $i = $title_middle; $i<$title_length; $i++ ) {
			$title_2 .= $title_array[$i] . ' ';
		}

		?>

		<?php if ( $bg_image ) : ?>
		<div class="mry-head-bg">
			<img src="<?php echo esc_url( $bg_image ); ?>" alt="">
			<div class="mry-bg-overlay"></div>
		</div>
		<?php endif; ?>

		<div class="mry-banner mry-p-140-0 mry-p-0-100">
			<div class="container">
				<div class="mry-main-title mry-title-center">
					<?php if ( $categories_list ) : ?>
					<div class="mry-subtitle mry-mb-20 mry-fo">
						<?php
							$total = count( $categories_list );
							$i = 0;
							foreach ( $categories_list as $category ) { $i++;
								if ( $total != $i ) {
									echo esc_html( $category->name ) . ', ';
								} else {
									echo esc_html( $category->name );
								}
							}
						?>
					</div>
					<?php endif; ?>
					<?php if ( $title_1 ) : ?>
					<h1 class="mry-mb-20 mry-fo mry-title--h">
						<?php if ( $title_1 ) : ?>
							<?php echo wp_kses_post( $title_1 ); ?>
			          		<br>
			          	<?php endif; ?>
			          	<?php if ( $title_2 ) : ?>
						<span class="mry-border-text">
							<?php echo wp_kses_post( $title_2 ); ?>
						</span>
						<?php endif; ?>
						<span class="mry-animation-el"></span>
					</h1>
					<?php endif; ?>
					<?php if ( $short_description ) : ?>
					<div class="mry-text mry-fo">
						<?php echo wp_kses_post( $short_description ); ?>
					</div>
					<?php endif; ?>
					<?php if ( $settings['scroll_button_show'] == 'yes' ) : ?>
					<div class="mry-scroll-hint-frame">
						<a class="mry-scroll-hint mry-smooth-scroll mry-magnetic-link mry-fo" href="#mry-anchor">
							<span class="mry-magnetic-object"></span>
						</a>
						<div class="mry-label mry-fo">
							<span <?php echo $this->get_render_attribute_string( 'scroll_text' ); ?>>
				          		<?php echo wp_kses_post( $settings['scroll_text'] ); ?>
				          	</span>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Mireya_Project_Started_Widget() );
