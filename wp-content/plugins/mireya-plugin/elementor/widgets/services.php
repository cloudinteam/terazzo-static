<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Mireya Services Widget.
 *
 * @since 1.0
 */
class Mireya_Services_Widget extends Widget_Base {

	public function get_name() {
		return 'mireya-services';
	}

	public function get_title() {
		return esc_html__( 'Services', 'mireya-plugin' );
	}

	public function get_icon() {
		return 'fas fa-concierge-bell';
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

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'name', [
				'label'       => esc_html__( 'Title', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'mireya-plugin' ),
				'default'	=> esc_html__( 'Enter title', 'mireya-plugin' ),
			]
		);

		$repeater->add_control(
			'desc', [
				'label'       => esc_html__( 'Description', 'mireya-plugin' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter description', 'mireya-plugin' ),
				'default'	=> esc_html__( 'Enter description', 'mireya-plugin' ),
			]
		);

		$repeater->add_control(
			'button', [
				'label'       => esc_html__( 'Button (title)', 'mireya-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button Label', 'mireya-plugin' ),
				'default'	=> esc_html__( 'Order a service', 'mireya-plugin' ),
			]
		);

		$repeater->add_control(
			'link', [
				'label'       => esc_html__( 'Button (link)', 'mireya-plugin' ),
				'type' => Controls_Manager::URL,
				'show_external' => true,
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Services Items', 'mireya-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
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
			'subtitle_color',
			[
				'label'     => esc_html__( 'Subtitle Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-services .mry-numbering .mry-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'     => esc_html__( 'Subtitle Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-services .mry-numbering .mry-subtitle',
			]
		);

		$this->add_control(
			'num_color',
			[
				'label'     => esc_html__( 'Num Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-services .mry-numbering .mry-border-text' => '-webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'num_typography',
				'label'     => esc_html__( 'Num Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-services .mry-numbering .mry-border-text',
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
			'item_title_color',
			[
				'label'     => esc_html__( 'Title Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-services .mry-services-item .mry-title--h' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'label'     => esc_html__( 'Title Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-services .mry-services-item .mry-title--h',
			]
		);

		$this->add_control(
			'item_desc_color',
			[
				'label'     => esc_html__( 'Description Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-services .mry-services-item .mry-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_desc_typography',
				'label'     => esc_html__( 'Description Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-services .mry-services-item .mry-title--h',
			]
		);

		$this->add_control(
			'item_link_color',
			[
				'label'     => esc_html__( 'Link Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-services .mry-services-item .mry-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_link_typography',
				'label'     => esc_html__( 'Link Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-services .mry-services-item .mry-link',
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

		$this->add_inline_editing_attributes( 'subtitle', 'basic' );
		$this->add_inline_editing_attributes( 'num', 'basic' );

		?>

		<div class="mry-about mry-about-services">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-8">
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

						<?php if ( $settings['items'] ) : ?>
						<div class="row">
							<?php foreach ( $settings['items'] as $index => $item ) :
							  $item_name = $this->get_repeater_setting_key( 'name', 'items', $index );
							  $this->add_inline_editing_attributes( $item_name, 'basic' );

							  $item_desc = $this->get_repeater_setting_key( 'desc', 'items', $index );
							  $this->add_inline_editing_attributes( $item_desc, 'advanced' );

							  $item_button = $this->get_repeater_setting_key( 'button', 'items', $index );
							  $this->add_inline_editing_attributes( $item_button, 'none' );
							?>
							<div class="col-lg-6 mry-services-item">

								<div class="mry-mb-100">
									<?php if ( $item['name'] ) : ?>
									<h4 class="mry-mb-20 mry-fo mry-title--h">
										<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
							        		<?php echo wp_kses_post( $item['name'] ); ?>
							          	</span>
									</h4>
									<?php endif; ?>
									<?php if ( $item['desc'] ) : ?>
									<div class="mry-text mry-fo">
										<div <?php echo $this->get_render_attribute_string( $item_desc ); ?>>
							        		<?php echo wp_kses_post( $item['desc'] ); ?>
							          	</div>
									</div>
									<?php endif; ?>
									<?php if ( $item['button'] ) : ?>
									<div class="mry-fo">
										<a<?php if ( $item['link'] ) : if ( $item['link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['link']['url'] ); ?>"<?php endif; ?> class="mry-link mry-default-link">
											<span <?php echo $this->get_render_attribute_string( $item_button ); ?>>
								        		<?php echo wp_kses_post( $item['button'] ); ?>
								          	</span>
										</a>
									</div>
									<?php endif; ?>
								</div>

							</div>
							<?php endforeach; ?>
						</div>
						<?php endif; ?>

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
		view.addInlineEditingAttributes( 'subtitle', 'basic' );
		view.addInlineEditingAttributes( 'num', 'basic' );
		#>

		<div class="mry-about mry-about-services">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-8">
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

						<# if ( settings.items ) { #>
						<div class="row">
							<# _.each( settings.items, function( item, index ) {

								var item_name = view.getRepeaterSettingKey( 'name', 'items', index );
								view.addInlineEditingAttributes( item_name, 'basic' );

								var item_desc = view.getRepeaterSettingKey( 'desc', 'items', index );
								view.addInlineEditingAttributes( item_desc, 'advanced' );

								var item_button = view.getRepeaterSettingKey( 'button', 'items', index );
								view.addInlineEditingAttributes( item_button, 'basic' );

							#>
							<div class="col-lg-6 mry-services-item">

								<div class="mry-text-center mry-mb-100">
									<# if ( item.name ) { #>
									<h4 class="mry-mb-20 mry-fo mry-title--h">
										<span {{{ view.getRenderAttributeString( item_name ) }}}>
											{{{ item.name }}}
										</span>
									</h4>
									<# } #>
									<# if ( item.desc ) { #>
									<div class="mry-text mry-fo">
										<div {{{ view.getRenderAttributeString( item_desc ) }}}>
											{{{ item.desc }}}
										</div>
									</div>
									<# } #>
									<# if ( item.button ) { #>
									<div class="mry-fo">
										<a<# if ( item.link ) { #><# if ( item.link.is_external ) { #> target="_blank"<# } #><# if ( item.link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ item.link.url }}}"<# } #> class="mry-link mry-default-link">
											<span {{{ view.getRenderAttributeString( item_button ) }}}>
												{{{ item.button }}}
											</span>
										</a>
									</div>
									<# } #>
								</div>

							</div>
							<# }); #>
						</div>
						<# } #>

					</div>

				</div>
			</div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Mireya_Services_Widget() );
