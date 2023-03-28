<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Mireya CTA Widget.
 *
 * @since 1.0
 */
class Mireya_CTA_Widget extends Widget_Base {

	public function get_name() {
		return 'mireya-cta';
	}

	public function get_title() {
		return esc_html__( 'Call to Action', 'mireya-plugin' );
	}

	public function get_icon() {
		return 'fas fa-university';
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
			'title_b',
			[
				'label'       => esc_html__( 'Title (Border)', 'mireya-plugin' ),
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

		$this->add_control(
			'text',
			[
				'label'       => esc_html__( 'Text', 'mireya-plugin' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter text', 'mireya-plugin' ),
				'default'     => esc_html__( 'Text', 'mireya-plugin' ),
			]
		);

		$this->add_control(
			'button1',
			[
				'label'       => esc_html__( 'Button 1 (Text)', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter button text', 'mireya-plugin' ),
				'default'     => esc_html__( 'Button', 'mireya-plugin' ),
			]
		);

		$this->add_control(
			'link1',
			[
				'label'       => esc_html__( 'Button 1 (URL)', 'mireya-plugin' ),
				'type' => Controls_Manager::URL,
				'show_external' => true,
			]
		);

		$this->add_control(
			'button2',
			[
				'label'       => esc_html__( 'Button 2 (Text)', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter button text', 'mireya-plugin' ),
				'default'     => esc_html__( 'Button', 'mireya-plugin' ),
			]
		);

		$this->add_control(
			'link2',
			[
				'label'       => esc_html__( 'Button 2 (URL)', 'mireya-plugin' ),
				'type' => Controls_Manager::URL,
				'show_external' => true,
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
				'label'     => esc_html__( 'Title Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-cta .mry-title--h' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'     => esc_html__( 'Title Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-cta .mry-title--h',
			]
		);

		$this->add_control(
			'title_b_color',
			[
				'label'     => esc_html__( 'Title (Border) Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-cta .mry-title--h .mry-border-text' => '-webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_b_typography',
				'label'     => esc_html__( 'Title (Border) Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-cta .mry-title--h .mry-border-text',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => esc_html__( 'Subtitle Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-cta .mry-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'     => esc_html__( 'Subtitle Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-cta .mry-subtitle',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Text Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-cta .mry-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'     => esc_html__( 'Text Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-cta .mry-text',
			]
		);

		$this->add_control(
			'btn1_color',
			[
				'label'     => esc_html__( 'Button 1 Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-cta .mry-btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .mry-about-cta .mry-btn' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btn1_typography',
				'label'     => esc_html__( 'Button 1 Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-cta .mry-btn',
			]
		);

		$this->add_control(
			'btn2_color',
			[
				'label'     => esc_html__( 'Button 2 Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-cta .mry-btn-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btn2_typography',
				'label'     => esc_html__( 'Button 2 Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-cta .mry-btn-text',
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
		$this->add_inline_editing_attributes( 'title_b', 'none' );
		$this->add_inline_editing_attributes( 'subtitle', 'basic' );
		$this->add_inline_editing_attributes( 'text', 'advanced' );
		$this->add_inline_editing_attributes( 'button1', 'none' );
		$this->add_inline_editing_attributes( 'button2', 'none' );

		?>

		<div class="mry-about mry-about-cta">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="mry-main-title mry-title-center mry-p-100-100">
							<?php if ( $settings['subtitle'] ) : ?>
							<div class="mry-subtitle mry-mb-20 mry-fo">
								<span <?php echo $this->get_render_attribute_string( 'subtitle' ); ?>>
					          		<?php echo wp_kses_post( $settings['subtitle'] ); ?>
					        	</span>
							</div>
							<?php endif; ?>
							<?php if ( $settings['title'] || $settings['title_b'] ) : ?>
							<h2 class="mry-h1 mry-mb-20 mry-fo mry-title--h">
								<?php if ( $settings['title'] ) : ?>
								<span <?php echo $this->get_render_attribute_string( 'title' ); ?>>
					          		<?php echo wp_kses_post( $settings['title'] ); ?>
					        	</span>
					        	<?php endif; ?>
					        	<?php if ( $settings['title_b'] ) : ?>
								<span class="mry-border-text">
									<span <?php echo $this->get_render_attribute_string( 'title_b' ); ?>>
						          		<?php echo wp_kses_post( $settings['title_b'] ); ?>
						        	</span>
								</span>
								<?php endif; ?>
							</h2>
							<?php endif; ?>
							<?php if ( $settings['text'] ) : ?>
							<div class="mry-text mry-mb-30 mry-fo">
								<div <?php echo $this->get_render_attribute_string( 'text' ); ?>>
					          		<?php echo wp_kses_post( $settings['text'] ); ?>
					        	</div>
							</div>
							<?php endif; ?>

							<?php if ( $settings['button1'] || $settings['button2'] ) : ?>
							<div class="mry-fo">
								<?php if ( $settings['button1'] ) : ?>
								<a<?php if ( $settings['link1'] ) : ?><?php if ( $settings['link1']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $settings['link1']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $settings['link1']['url'] ); ?>"<?php endif; ?> class="mry-anima-link mry-btn mry-btn-color mry-default-link">
									<span <?php echo $this->get_render_attribute_string( 'button1' ); ?>>
						          		<?php echo wp_kses_post( $settings['button1'] ); ?>
						        	</span>
								</a>
								<?php endif; ?>
								<?php if ( $settings['button2'] ) : ?>
								<a<?php if ( $settings['link2'] ) : ?><?php if ( $settings['link2']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $settings['link2']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $settings['link2']['url'] ); ?>"<?php endif; ?> class="mry-anima-link mry-btn-text mry-default-link">
									<span <?php echo $this->get_render_attribute_string( 'button2' ); ?>>
						          		<?php echo wp_kses_post( $settings['button2'] ); ?>
						        	</span>
								</a>
								<?php endif; ?>
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
		view.addInlineEditingAttributes( 'title_b', 'none' );
		view.addInlineEditingAttributes( 'subtitle', 'basic' );
		view.addInlineEditingAttributes( 'text', 'advanced' );
		view.addInlineEditingAttributes( 'button1', 'none' );
		view.addInlineEditingAttributes( 'button2', 'none' );
		#>

		<div class="mry-about mry-about-cta">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="mry-main-title mry-title-center mry-p-100-100">
							<# if ( settings.subtitle ) { #>
							<div class="mry-subtitle mry-mb-20 mry-fo">
								<span {{{ view.getRenderAttributeString( 'subtitle' ) }}}>
					          		{{{ settings.subtitle }}}
					         	</span>
							</div>
							<# } #>
							<# if ( settings.title || settings.title_b ) { #>
							<h2 class="mry-h1 mry-mb-20 mry-fo mry-title--h">
								<# if ( settings.title ) { #>
								<span {{{ view.getRenderAttributeString( 'title' ) }}}>
					          		{{{ settings.title }}}
					         	</span>
					        	<# } #>
					        	<# if ( settings.title_b ) { #>
								<span class="mry-border-text">
									<span {{{ view.getRenderAttributeString( 'title_b' ) }}}>
						          		{{{ settings.title_b }}}
						         	</span>
								</span>
								<# } #>
							</h2>
							<# } #>
							<# if ( settings.text ) { #>
							<div class="mry-text mry-mb-30 mry-fo">
								<div {{{ view.getRenderAttributeString( 'text' ) }}}>
					          		{{{ settings.text }}}
					         	</div>
							</div>
							<# } #>

							<# if ( settings.button1 || settings.button2 ) { #>
							<div class="mry-fo">
								<# if ( settings.button1 ) { #>
								<a<# if ( settings.link1 ) { #><# if ( settings.link1.is_external ) { #> target="_blank"<# } #><# if ( settings.link1.nofollow ) { #> rel="nofollow"<# } #> href="{{{ settings.link1.url }}}"<# } #> class="mry-anima-link mry-btn mry-btn-color mry-default-link">
									<span {{{ view.getRenderAttributeString( 'button1' ) }}}>
						          		{{{ settings.button1 }}}
						         	</span>
								</a>
								<# } #>
								<# if ( settings.button2 ) { #>
								<a<# if ( settings.link2 ) { #><# if ( settings.link2.is_external ) { #> target="_blank"<# } #><# if ( settings.link2.nofollow ) { #> rel="nofollow"<# } #> href="{{{ settings.link2.url }}}"<# } #> class="mry-anima-link mry-btn-text mry-default-link">
									<span {{{ view.getRenderAttributeString( 'button2' ) }}}>
						          		{{{ settings.button2 }}}
						         	</span>
								</a>
								<# } #>
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

Plugin::instance()->widgets_manager->register( new Mireya_CTA_Widget() );
