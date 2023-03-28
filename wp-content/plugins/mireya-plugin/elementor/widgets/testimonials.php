<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Mireya Testimonials Widget.
 *
 * @since 1.0
 */
class Mireya_Testimonials_Widget extends Widget_Base {

	public function get_name() {
		return 'mireya-testimonials';
	}

	public function get_title() {
		return esc_html__( 'Testimonials', 'mireya-plugin' );
	}

	public function get_icon() {
		return 'far fa-comments';
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

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image', [
				'label' => esc_html__( 'Image', 'mireya-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'name', [
				'label'       => esc_html__( 'Name', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter name', 'mireya-plugin' ),
				'default'	=> esc_html__( 'Enter name', 'mireya-plugin' ),
			]
		);

		$repeater->add_control(
			'subname', [
				'label'       => esc_html__( 'Subname', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter subname', 'mireya-plugin' ),
				'default'	=> esc_html__( 'Enter subname', 'mireya-plugin' ),
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
			'rating', [
				'label'       => esc_html__( 'Rating', 'mireya-plugin' ),
				'type'        => Controls_Manager::NUMBER,
				'placeholder' => esc_html__( 'Enter rating', 'mireya-plugin' ),
				'default'	=> 5,
				'min' => 0,
				'max' => 5,
				'step' => 1,
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Testimonials Items', 'mireya-plugin' ),
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

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-revs .mry-title--h' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'     => esc_html__( 'Title Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-revs .mry-title--h',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => esc_html__( 'Subtitle Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-revs .mry-numbering .mry-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'     => esc_html__( 'Subtitle Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-revs .mry-numbering .mry-subtitle',
			]
		);

		$this->add_control(
			'num_color',
			[
				'label'     => esc_html__( 'Num Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-revs .mry-numbering .mry-border-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'num_typography',
				'label'     => esc_html__( 'Num Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-revs .mry-numbering .mry-border-text',
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
			'item_name_color',
			[
				'label'     => esc_html__( 'Name Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-revs .mry-revs-content h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_name_typography',
				'label'     => esc_html__( 'Name Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-revs .mry-revs-content h4',
			]
		);

		$this->add_control(
			'item_subname_color',
			[
				'label'     => esc_html__( 'Subname Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-revs .mry-revs-content .mry-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_subname_typography',
				'label'     => esc_html__( 'Subname Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-revs .mry-revs-content .mry-subtitle',
			]
		);

		$this->add_control(
			'item_desc_color',
			[
				'label'     => esc_html__( 'Description Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-revs .mry-revs-content .mry-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_desc_typography',
				'label'     => esc_html__( 'Description Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-about-revs .mry-revs-content .mry-text',
			]
		);

		$this->add_control(
			'item_rating_color',
			[
				'label'     => esc_html__( 'Rating Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-revs .mry-revs-content .mry-star-rate li i' => 'color: {{VALUE}};',
				],
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

		?>

		<div class="mry-about mry-about-revs">
			<div class="container">
				<div class="row justify-content-center">
					<?php if ( $settings['num'] && $settings['subtitle'] && $settings['title'] ) : ?>
					<div class="col-lg-12">
						<div class="mry-main-title mry-title-center mry-p-0-40">
							<?php if ( $settings['num'] && $settings['subtitle'] ) : ?>
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
							<h2 class="mry-fo mry-title--h">
								<span <?php echo $this->get_render_attribute_string( 'title' ); ?>>
					          		<?php echo wp_kses_post( $settings['title'] ); ?>
					         	</span>
							</h2>
							<?php endif; ?>
							<div class="mry-arrows">
								<div class="mry-sl-nav mry-fo">
									<div class="mry-prev mry-button-testimonials-prev mry-magnetic-link"><span class="mry-magnetic-object"><i class="fas fa-arrow-left"></i></span></div>
									<div class="mry-next mry-button-testimonials-next mry-magnetic-link"><span class="mry-magnetic-object"><i class="fas fa-arrow-right"></i></span></div>
								</div>
								<div class="mry-label mry-fo"><?php echo esc_html__( 'Slider Navigation', 'mireya-plugin' ); ?></div>
							</div>
						</div>
					</div>
					<?php endif; ?>

					<?php if ( $settings['items'] ) : ?>
					<div class="col-lg-8">

						<div class="swiper-container mry-testimonials-slider">
							<div class="swiper-wrapper">
								<?php foreach ( $settings['items'] as $index => $item ) :
								    $item_name = $this->get_repeater_setting_key( 'name', 'items', $index );
								    $this->add_inline_editing_attributes( $item_name, 'basic' );

								    $item_subname = $this->get_repeater_setting_key( 'subname', 'items', $index );
								    $this->add_inline_editing_attributes( $item_subname, 'basic' );

								    $item_desc = $this->get_repeater_setting_key( 'desc', 'items', $index );
								    $this->add_inline_editing_attributes( $item_desc, 'advanced' );
								?>
								<div class="swiper-slide">
									<div class="mry-title-center mry-revs-content">
										<?php if ( $item['image'] ) : $image = wp_get_attachment_image_url( $item['image']['id'], 'mireya_140x140' ); ?>
										<img src="<?php echo esc_url( $image ); ?>" alt="" class="mry-reviewer mry-mb-20 mry-fo">
										<?php endif; ?>
										<?php if ( $item['name'] ) : ?>
										<h4 class="mry-mb-20 mry-fo">
											<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
												<?php echo wp_kses_post( $item['name'] ); ?>
											</span>
										</h4>
										<?php endif; ?>
										<?php if ( $item['subname'] ) : ?>
										<div class="mry-subtitle mry-mb-20 mry-fo">
											<span <?php echo $this->get_render_attribute_string( $item_subname ); ?>>
												<?php echo wp_kses_post( $item['subname'] ); ?>
											</span>
										</div>
										<?php endif; ?>
										<?php if ( $item['desc'] ) : ?>
										<div class="mry-text mry-fo">
											<div <?php echo $this->get_render_attribute_string( $item_desc ); ?>>
												<?php echo wp_kses_post( $item['desc'] ); ?>
											</div>
										</div>
										<?php endif; ?>
										<?php if ( $item['rating'] ) : ?>
										<ul class="mry-star-rate mry-fo">
											<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
							                  <?php if ( $item['rating'] >= $i ) : ?>
							                  <li><i class="fas fa-star"></i></li>
							                  <?php else : ?>
							                  <li class="mry-empty"><i class="fas fa-star"></i></li>
							              	  <?php endif; ?>
							                <?php endfor; ?>
										</ul>
										<?php endif; ?>
									</div>
								</div>
								<?php endforeach; ?>
							</div>
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
		view.addInlineEditingAttributes( 'subtitle', 'basic' );
		view.addInlineEditingAttributes( 'num', 'basic' );
		#>

		<div class="mry-about mry-about-revs">
			<div class="container">
				<div class="row justify-content-center">
					<# if ( settings.num || settings.subtitle || settings.title ) { #>
					<div class="col-lg-12">
						<div class="mry-main-title mry-title-center mry-p-0-40">
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
							<{{{ settings.title_tag }}} class="mry-fo mry-title--h">
								<span {{{ view.getRenderAttributeString( 'title' ) }}}>
					          		{{{ settings.title }}}
					        	</span>
							</{{{ settings.title_tag }}}>
							<# } #>
							<div class="mry-arrows">
								<div class="mry-sl-nav mry-fo">
									<div class="mry-prev mry-button-testimonials-prev mry-magnetic-link"><span class="mry-magnetic-object"><i class="fas fa-arrow-left"></i></span></div>
									<div class="mry-next mry-button-testimonials-next mry-magnetic-link"><span class="mry-magnetic-object"><i class="fas fa-arrow-right"></i></span></div>
								</div>
								<div class="mry-label mry-fo">Slider Navigation</div>
							</div>
						</div>
					</div>
					<# } #>

					<# if ( settings.items ) { #>
					<div class="col-lg-8">

						<div class="swiper-container mry-testimonials-slider">
							<div class="swiper-wrapper">
								<# _.each( settings.items, function( item, index ) {
								    var item_name = view.getRepeaterSettingKey( 'name', 'items', index );
								    view.addInlineEditingAttributes( item_name, 'basic' );

								    var item_subname = view.getRepeaterSettingKey( 'subname', 'items', index );
								    view.addInlineEditingAttributes( item_subname, 'basic' );

								    var item_desc = view.getRepeaterSettingKey( 'desc', 'items', index );
								    view.addInlineEditingAttributes( item_desc, 'basic' );
								#>
								<div class="swiper-slide">
									<div class="mry-title-center mry-revs-content">
										<# if ( item.image ) { #>
										<img src="{{{ item.image.url }}}" alt="" class="mry-reviewer mry-mb-20 mry-fo">
										<# } #>
										<# if ( item.name ) { #>
										<h4 class="mry-mb-20 mry-fo">
											<span {{{ view.getRenderAttributeString( item_name ) }}}>
												{{{ item.name }}}
											</span>
										</h4>
										<# } #>
										<# if ( item.subname ) { #>
										<div class="mry-subtitle mry-mb-20 mry-fo">
											<span {{{ view.getRenderAttributeString( item_subname ) }}}>
												{{{ item.subname }}}
											</span>
										</div>
										<# } #>
										<# if ( item.desc ) { #>
										<div class="mry-text mry-fo">
											<div {{{ view.getRenderAttributeString( item_desc ) }}}>
												{{{ item.desc }}}
											</div>
										</div>
										<# } #>
										<# if ( item.rating ) { #>
										<ul class="mry-star-rate mry-fo">
											<# for ( var i = 0; i < 5; i++ ) { #>
							                  <# if ( item.rating >= i ) { #>
							                  <li><i class="fas fa-star"></i></li>
							                  <# } else { #>
							                  <li class="mry-empty"><i class="fas fa-star"></i></li>
							              	  <# } #>
							                <# } #>
										</ul>
										<# } #>
									</div>
								</div>
								<# }); #>
							</div>
						</div>
					</div>
					<# } #>
				</div>
			</div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Mireya_Testimonials_Widget() );
