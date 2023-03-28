<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Mireya Heading Widget.
 *
 * @since 1.0
 */
class Mireya_Heading_Widget extends Widget_Base {

	public function get_name() {
		return 'mireya-heading';
	}

	public function get_title() {
		return esc_html__( 'Heading', 'mireya-plugin' );
	}

	public function get_icon() {
		return 'fa fa-header';
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
			'title_styling',
			[
				'label'     => esc_html__( 'Title', 'mireya-plugin' ),
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
		$this->add_inline_editing_attributes( 'num', 'none' );

		?>

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
					</div>
				</div>
				<?php endif; ?>
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
		view.addInlineEditingAttributes( 'num', 'none' );
		#>

		<div class="container">
			<div class="row justify-content-center">
				<# if ( settings.title || settings.subtitle || settings.num ) { #>
				<div class="col-lg-12">
					<div class="mry-main-title mry-title-center mry-p-0-40">
						<# if ( settings.subtitle || settings.num ) { #>
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
						<{{{ settings.title_tag }}} class="mry-fo mry-title--h">
							<span {{{ view.getRenderAttributeString( 'title' ) }}}>
				          		{{{ settings.title }}}
				         	</span>
						</{{{ settings.title_tag }}}>
						<# } #>
					</div>
				</div>
				<# } #>
			</div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Mireya_Heading_Widget() );
