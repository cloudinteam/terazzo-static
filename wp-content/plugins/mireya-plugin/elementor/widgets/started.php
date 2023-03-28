<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Mireya Started Widget.
 *
 * @since 1.0
 */
class Mireya_Started_Widget extends Widget_Base {

	public function get_name() {
		return 'mireya-started';
	}

	public function get_title() {
		return esc_html__( 'Started', 'mireya-plugin' );
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
			'heading_tab',
			[
				'label' => esc_html__( 'Heading', 'mireya-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'       => esc_html__( 'Title Tag', 'mireya-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => [
					'h1'  => __( 'H1', 'mireya-plugin' ),
					'h2' => __( 'H2', 'mireya-plugin' ),
					'h3' => __( 'H3', 'mireya-plugin' ),
					'div' => __( 'DIV', 'mireya-plugin' ),
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your title', 'mireya-plugin' ),
				'default'     => esc_html__( 'Title', 'mireya-plugin' ),
			]
		);

		$this->add_control(
			'title_b',
			[
				'label'       => esc_html__( 'Title (Border)', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your title', 'mireya-plugin' ),
				'default'     => esc_html__( 'Title', 'mireya-plugin' ),
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label'       => esc_html__( 'Subtitle', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your subtitle', 'mireya-plugin' ),
				'default'     => esc_html__( 'Subtitle', 'mireya-plugin' ),
			]
		);

		$this->add_control(
			'text',
			[
				'label'       => esc_html__( 'Text', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your text', 'mireya-plugin' ),
				'default'     => esc_html__( 'Text', 'mireya-plugin' ),
			]
		);

		$this->end_controls_section();

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
			'image_tab',
			[
				'label' => esc_html__( 'Background', 'mireya-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'bg_image',
			[
				'label'       => esc_html__( 'Background Image', 'mireya-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
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

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_inline_editing_attributes( 'title_b', 'basic' );
		$this->add_inline_editing_attributes( 'subtitle', 'basic' );
		$this->add_inline_editing_attributes( 'text', 'basic' );
		$this->add_inline_editing_attributes( 'scroll_text', 'none' );

		?>

		<?php if ( $settings['bg_image'] ) : $image = wp_get_attachment_image_url( $settings['bg_image']['id'], 'mireya_1920xAuto' ); ?>
		<div class="mry-head-bg">
			<img src="<?php echo esc_url( $image ); ?>" alt="">
			<div class="mry-bg-overlay"></div>
		</div>
		<?php endif; ?>

		<div class="mry-banner mry-p-140-0 mry-p-0-100">
			<div class="container">
				<div class="mry-main-title mry-title-center">
					<?php if ( $settings['subtitle'] ) : ?>
					<div class="mry-subtitle mry-mb-20 mry-fo">
						<span <?php echo $this->get_render_attribute_string( 'subtitle' ); ?>>
			          		<?php echo wp_kses_post( $settings['subtitle'] ); ?>
			          	</span>
					</div>
					<?php endif; ?>
					<?php if ( $settings['title'] ) : ?>
					<<?php echo esc_attr( $settings['title_tag'] ); ?> class="mry-mb-20 mry-fo mry-title--h">
						<span <?php echo $this->get_render_attribute_string( 'title' ); ?>>
			          		<?php echo wp_kses_post( $settings['title'] ); ?>
			          	</span><br>
						<span class="mry-border-text">
							<span <?php echo $this->get_render_attribute_string( 'title_b' ); ?>>
				          		<?php echo wp_kses_post( $settings['title_b'] ); ?>
				          	</span>
						</span>
						<span class="mry-animation-el"></span>
					</<?php echo esc_attr( $settings['title_tag'] ); ?>>
					<?php endif; ?>
					<?php if ( $settings['text'] ) : ?>
					<div class="mry-text mry-fo">
						<span <?php echo $this->get_render_attribute_string( 'text' ); ?>>
			          		<?php echo wp_kses_post( $settings['text'] ); ?>
			          	</span>
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

	/**
	 * Render widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() {
		?>

		<#
		view.addInlineEditingAttributes( 'title', 'basic' );
		view.addInlineEditingAttributes( 'title_b', 'basic' );
		view.addInlineEditingAttributes( 'subtitle', 'basic' );
		view.addInlineEditingAttributes( 'text', 'basic' );
		view.addInlineEditingAttributes( 'scroll_text', 'none' );
		#>

		<# if ( settings.bg_image ) { #>
		<div class="mry-head-bg">
			<img src="{{{ settings.bg_image.url }}}" alt="">
			<div class="mry-bg-overlay"></div>
		</div>
		<# } #>

		<div class="mry-banner mry-p-140-0 mry-p-0-100">
			<div class="container">
				<div class="mry-main-title mry-title-center">
					<# if ( settings.subtitle ) { #>
					<div class="mry-subtitle mry-mb-20 mry-fo">
						<span {{{ view.getRenderAttributeString( 'subtitle' ) }}}>
			          		{{{ settings.subtitle }}}
			          	</span>
					</div>
					<# } #>
					<# if ( settings.title ) { #>
					<{{{ settings.title_tag }}} class="mry-mb-20 mry-fo mry-title--h">
						<span {{{ view.getRenderAttributeString( 'title' ) }}}>
			          		{{{ settings.title }}}
			          	</span><br>
						<span class="mry-border-text">
							<span {{{ view.getRenderAttributeString( 'title_b' ) }}}>
				          		{{{ settings.title_b }}}
				          	</span>
						</span>
						<span class="mry-animation-el"></span>
					</{{{ settings.title_tag }}}>
					<# } #>
					<# if ( settings.text ) { #>
					<div class="mry-text mry-fo">
						<span {{{ view.getRenderAttributeString( 'text' ) }}}>
			          		{{{ settings.text }}}
			          	</span>
					</div>
					<# } #>
					<# if ( settings.scroll_button_show == 'yes' ) { #>
					<div class="mry-scroll-hint-frame">
						<a class="mry-scroll-hint mry-smooth-scroll mry-magnetic-link mry-fo" href="#mry-anchor">
							<span class="mry-magnetic-object"></span>
						</a>
						<div class="mry-label mry-fo">
							<span {{{ view.getRenderAttributeString( 'scroll_text' ) }}}>
				          		{{{ settings.scroll_text }}}
				          	</span>
						</div>
					</div>
					<# } #>
				</div>
			</div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Mireya_Started_Widget() );
