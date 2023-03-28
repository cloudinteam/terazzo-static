<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Mireya Section Description Widget.
 *
 * @since 1.0
 */
class Mireya_Section_Description_Widget extends Widget_Base {

	public function get_name() {
		return 'mireya-section-description';
	}

	public function get_title() {
		return esc_html__( 'Section Description', 'mireya-plugin' );
	}

	public function get_icon() {
		return 'fa fa-font';
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
			'title_tag',
			[
				'label'       => esc_html__( 'Title Tag', 'mireya-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'h3',
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
				'placeholder' => esc_html__( 'Enter number', 'mireya-plugin' ),
				'default'     => esc_html__( '01', 'mireya-plugin' ),
			]
		);

		$this->add_control(
			'description',
			[
				'label'       => esc_html__( 'Description', 'mireya-plugin' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter your description', 'mireya-plugin' ),
				'default'     => esc_html__( 'Type your description here', 'mireya-plugin' ),
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

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'oblo-plugin' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'oblo-plugin' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'oblo-plugin' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'oblo-plugin' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'default'	=> 'left',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-text .mry-title--h' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'     => esc_html__( 'Title Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-text .mry-title--h',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => esc_html__( 'Subtitle Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-text .mry-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'     => esc_html__( 'Subtitle Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-text .mry-subtitle',
			]
		);

		$this->add_control(
			'num_color',
			[
				'label'     => esc_html__( 'Num Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-text .mry-numbering .mry-border-text' => '-webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'num_typography',
				'label'     => esc_html__( 'Num Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-text .mry-numbering .mry-border-text',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Description Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-text .mry-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'     => esc_html__( 'Description Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-text .mry-text',
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
		$this->add_inline_editing_attributes( 'num', 'basic' );
		$this->add_inline_editing_attributes( 'description', 'advanced' );

		?>

		<div class="mry-about mry-about-text">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-8">

						<div class="mry-mb-100">
							<?php if ( $settings['num'] || $settings['subtitle'] ) : ?>
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
							<<?php echo esc_attr( $settings['title_tag'] ); ?> class="mry-mb-40 mry-fo mry-title--h">
								<span <?php echo $this->get_render_attribute_string( 'title' ); ?>>
				          			<?php echo wp_kses_post( $settings['title'] ); ?>
				         		</span>
							</<?php echo esc_attr( $settings['title_tag'] ); ?>>
							<?php endif; ?>
							<?php if ( $settings['description'] ) : ?>
							<div class="mry-text mry-fo">
								<div <?php echo $this->get_render_attribute_string( 'description' ); ?>>
				          			<?php echo wp_kses_post( $settings['description'] ); ?>
				         		</div>
							</div>
							<?php endif; ?>
						</div>

					</div>
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
		view.addInlineEditingAttributes( 'subtitle', 'basic' );
		view.addInlineEditingAttributes( 'num', 'basic' );
		view.addInlineEditingAttributes( 'description', 'advanced' );
		#>

		<div class="mry-about mry-about-text">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-8">

						<div class="mry-mb-100">
							<# if ( settings.num || settings.subtitle ) { #>
							<div class="mry-numbering mry-fo">
								<# if ( settings.num ) { #>
								<div class="mry-border-text">
									<span {{{ view.getRenderAttributeString( 'num' ) }}}>
					          			{{{ settings.num }}}
					         		</span>
								</div>
								<# } #>
								<# if ( settings.subtitle ) { #>
								<div class="mry-subtitle">
									<span {{{ view.getRenderAttributeString( 'subtitle' ) }}}>
					          			{{{ settings.subtitle }}}
					         		</span>
								</div>
								<# } #>
							</div>
							<# } #>
							<# if ( settings.title ) { #>
							<{{{ settings.title_tag }}} class="mry-mb-40 mry-fo mry-title--h">
								<span {{{ view.getRenderAttributeString( 'title' ) }}}>
				          			{{{ settings.title }}}
				         		</span>
							</{{{ settings.title_tag }}}>
							<# } #>
							<# if ( settings.description ) { #>
							<div class="mry-text mry-fo">
								<div {{{ view.getRenderAttributeString( 'description' ) }}}>
				          			{{{ settings.description }}}
				         		</div>
							</div>
							<# } #>
						</div>

					</div>
				</div>
			</div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Mireya_Section_Description_Widget() );
