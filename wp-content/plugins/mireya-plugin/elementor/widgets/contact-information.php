<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Mireya Contact Information Widget.
 *
 * @since 1.0
 */
class Mireya_Contact_Info_Widget extends Widget_Base {

	public function get_name() {
		return 'mireya-contact-info';
	}

	public function get_title() {
		return esc_html__( 'Contact Information', 'mireya-plugin' );
	}

	public function get_icon() {
		return 'far fa-list-alt';
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

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'num', [
				'label'       => esc_html__( 'Num', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter num', 'mireya-plugin' ),
				'default'	=> esc_html__( '01', 'mireya-plugin' ),
			]
		);

		$repeater->add_control(
			'subtitle', [
				'label'       => esc_html__( 'Subtitle', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter subtitle', 'mireya-plugin' ),
				'default'	=> esc_html__( 'Subtitle', 'mireya-plugin' ),
			]
		);

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

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Contact Information Items', 'mireya-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
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
			'item_num_color',
			[
				'label'     => esc_html__( 'Num Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-contact-item .mry-numbering .mry-border-text' => '-webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_num_typography',
				'label'     => esc_html__( 'Num Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-contact-item .mry-numbering .mry-border-text',
			]
		);

		$this->add_control(
			'item_subtitle_color',
			[
				'label'     => esc_html__( 'Subtitle Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-contact-item .mry-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_subtitle_typography',
				'label'     => esc_html__( 'Subtitle Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-contact-item .mry-subtitle',
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label'     => esc_html__( 'Title Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-contact-item h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'label'     => esc_html__( 'Title Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-contact-item h4',
			]
		);

		$this->add_control(
			'item_desc_color',
			[
				'label'     => esc_html__( 'Text Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-contact-item .mry-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_desc_typography',
				'label'     => esc_html__( 'Text Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-contact-item .mry-text',
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

		?>

		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-12">
					<?php if ( $settings['items'] ) : ?>
					<div class="row">
						<?php foreach ( $settings['items'] as $index => $item ) :
						$item_num = $this->get_repeater_setting_key( 'num', 'items', $index );
						$this->add_inline_editing_attributes( $item_num, 'none' );

						$item_subtitle = $this->get_repeater_setting_key( 'subtitle', 'items', $index );
						$this->add_inline_editing_attributes( $item_subtitle, 'basic' );

						$item_name = $this->get_repeater_setting_key( 'name', 'items', $index );
						$this->add_inline_editing_attributes( $item_name, 'basic' );

						$item_desc = $this->get_repeater_setting_key( 'desc', 'items', $index );
						$this->add_inline_editing_attributes( $item_desc, 'advanced' );
						?>
						<div class="col-lg-4">

							<div class="mry-mb-100 mry-text-center mry-contact-item">
								<?php if ( $item['num'] || $item['subtitle'] ) : ?>
								<div class="mry-numbering mry-fo">
									<?php if ( $item['num'] ) : ?>
									<div class="mry-border-text">
										<span <?php echo $this->get_render_attribute_string( $item_num ); ?>>
				        					<?php echo wp_kses_post( $item['num'] ); ?>
				        				</span>
									</div>
									<?php endif; ?>
									<?php if ( $item['subtitle'] ) : ?>
									<div class="mry-subtitle">
										<span <?php echo $this->get_render_attribute_string( $item_subtitle ); ?>>
				        					<?php echo wp_kses_post( $item['subtitle'] ); ?>
				        				</span>
									</div>
									<?php endif; ?>
								</div>
								<?php endif; ?>
								<?php if ( $item['name'] || $item['desc'] ) : ?>
								<div class="mry-fade-object mry-mb-100">
									<?php if ( $item['name'] ) : ?>
									<h4 class="mry-mb-20 mry-fo">
										<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
				        					<?php echo wp_kses_post( $item['name'] ); ?>
				        				</span>
									</h4>
									<?php endif; ?>
									<?php if ( $item['desc'] ) : ?>
									<div class="mry-text mry-mb-20 mry-fo">
										<div <?php echo $this->get_render_attribute_string( $item_desc ); ?>>
				        					<?php echo wp_kses_post( $item['desc'] ); ?>
				        				</div>
									</div>
									<?php endif; ?>
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

		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<# if ( settings.items ) { #>
					<div class="row">
						<# _.each( settings.items, function( item, index ) {
						var item_num = view.getRepeaterSettingKey( 'num', 'items', index );
				  		view.addInlineEditingAttributes( item_num, 'none' );

						var item_subtitle = view.getRepeaterSettingKey( 'subtitle', 'items', index );
				  		view.addInlineEditingAttributes( item_subtitle, 'basic' );

						var item_name = view.getRepeaterSettingKey( 'name', 'items', index );
				  		view.addInlineEditingAttributes( item_name, 'basic' );

						var item_desc = view.getRepeaterSettingKey( 'desc', 'items', index );
				  		view.addInlineEditingAttributes( item_desc, 'advanced' );
						#>
						<div class="col-lg-6">

							<div class="mry-mb-100 mry-text-center mry-contact-item">
								<# if ( item.num || item.subtitle ) { #>
								<div class="mry-numbering mry-fo">
									<# if ( item.num ) { #>
									<div class="mry-border-text">
										<span {{{ view.getRenderAttributeString( item_num ) }}}>
											{{{ item.num }}}
										</span>
									</div>
									<# } #>
									<# if ( item.subtitle ) { #>
									<div class="mry-subtitle">
										<span {{{ view.getRenderAttributeString( item_subtitle ) }}}>
											{{{ item.subtitle }}}
										</span>
									</div>
									<# } #>
								</div>
								<# } #>
								<# if ( item.name || item.desc ) { #>
								<div class="mry-fade-object mry-mb-100">
									<# if ( item.name ) { #>
									<h4 class="mry-mb-20 mry-fo">
										<span {{{ view.getRenderAttributeString( item_name ) }}}>
											{{{ item.name }}}
										</span>
									</h4>
									<# } #>
									<# if ( item.desc ) { #>
									<div class="mry-text mry-mb-20 mry-fo">
										<div {{{ view.getRenderAttributeString( item_desc ) }}}>
											{{{ item.desc }}}
										</div>
									</div>
									<# } #>
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

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Mireya_Contact_Info_Widget() );
