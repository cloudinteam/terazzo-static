<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Mireya Hero Slider Widget.
 *
 * @since 1.0
 */
class Mireya_Hero_Slider_Widget extends Widget_Base {

	public function get_name() {
		return 'mireya-hero-slider';
	}

	public function get_title() {
		return esc_html__( 'Hero Slider', 'mireya-plugin' );
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
			'items_tab',
			[
				'label' => esc_html__( 'Slides', 'mireya-plugin' ),
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
			'title', [
				'label'       => esc_html__( 'Title', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'mireya-plugin' ),
				'default'	=> esc_html__( 'Enter title', 'mireya-plugin' ),
			]
		);

		$repeater->add_control(
			'title_b', [
				'label'       => esc_html__( 'Title (Border)', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'mireya-plugin' ),
				'default'	=> esc_html__( 'Enter title', 'mireya-plugin' ),
			]
		);

		$repeater->add_control(
			'title_tag', [
				'label'	=> esc_html__( 'Title Tag', 'mireya-plugin' ),
				'type'	=> Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => [
					'h1'  => __( 'H1', 'mireya-plugin' ),
					'h2' => __( 'H2', 'mireya-plugin' ),
					'h3' => __( 'H3', 'mireya-plugin' ),
					'div' => __( 'DIV', 'mireya-plugin' ),
				],
			]
		);

		$repeater->add_control(
			'subtitle', [
				'label'       => esc_html__( 'Subtitle', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter subtitle', 'mireya-plugin' ),
				'default'	=> esc_html__( 'Enter subtitle', 'mireya-plugin' ),
			]
		);

		$repeater->add_control(
			'text', [
				'label'       => esc_html__( 'Text', 'mireya-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter text', 'mireya-plugin' ),
				'default'	=> esc_html__( 'Enter text', 'mireya-plugin' ),
			]
		);

		$repeater->add_control(
			'button1_show', [
				'label' => esc_html__( 'Show Button 1', 'mireya-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mireya-plugin' ),
				'label_off' => __( 'Hide', 'mireya-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$repeater->add_control(
			'button1', [
				'label'       => esc_html__( 'Button 1 (Label)', 'mireya-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button', 'mireya-plugin' ),
				'default'	=> esc_html__( 'Button', 'mireya-plugin' ),
				'condition' => [
		            'button1_show' => 'yes'
		        ],
			]
		);

		$repeater->add_control(
			'button1_link', [
				'label'       => esc_html__( 'Button 1 (URL)', 'mireya-plugin' ),
				'type' => Controls_Manager::URL,
				'show_external' => true,
				'condition' => [
		            'button1_show' => 'yes'
		        ],
			]
		);

		$repeater->add_control(
			'button2_show', [
				'label' => esc_html__( 'Show Button 2', 'mireya-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mireya-plugin' ),
				'label_off' => __( 'Hide', 'mireya-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$repeater->add_control(
			'button2', [
				'label'       => esc_html__( 'Button 2 (Label)', 'mireya-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button', 'mireya-plugin' ),
				'default'	=> esc_html__( 'Button', 'mireya-plugin' ),
				'condition' => [
		            'button2_show' => 'yes'
		        ],
			]
		);

		$repeater->add_control(
			'button2_link', [
				'label'       => esc_html__( 'Button 2 (URL)', 'mireya-plugin' ),
				'type' => Controls_Manager::URL,
				'show_external' => true,
				'condition' => [
		            'button2_show' => 'yes'
		        ],
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Items', 'mireya-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'settings_tab',
			[
				'label' => esc_html__( 'Settings', 'mireya-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'dots',
			[
				'label' => esc_html__( 'Show Dots Animation?', 'mireya-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mireya-plugin' ),
				'label_off' => __( 'Hide', 'mireya-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'overlay',
			[
				'label' => esc_html__( 'Content Overlay', 'mireya-plugin' ),
				'type'	=> Controls_Manager::SELECT,
				'default' => 'half',
				'options' => [
					'half'  => __( 'half background', 'mireya-plugin' ),
					'gradient' => __( 'full gradient', 'mireya-plugin' ),
				],
			]
		);

		$this->add_control(
			'mousewheel',
			[
				'label' => esc_html__( 'Mousewheel Scroll', 'mireya-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mireya-plugin' ),
				'label_off' => __( 'Hide', 'mireya-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
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
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-main-slider .mry-title--h' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'     => esc_html__( 'Title Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-main-slider .mry-title--h',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => esc_html__( 'Subtitle Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-main-slider .mry-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'     => esc_html__( 'Subtitle Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-main-slider .mry-subtitle',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Text Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-main-slider .mry-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'     => esc_html__( 'Text Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-main-slider .mry-text',
			]
		);

		$this->add_control(
			'button1_color',
			[
				'label'     => esc_html__( 'Button 1 Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-main-slider .mry-btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .mry-main-slider .mry-btn' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button1_typography',
				'label'     => esc_html__( 'Button 1 Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-main-slider .mry-btn',
			]
		);

		$this->add_control(
			'button2_color',
			[
				'label'     => esc_html__( 'Button 2 Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-main-slider .mry-btn-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button2_typography',
				'label'     => esc_html__( 'Button 2 Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .mry-main-slider .mry-btn-text',
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

		<div class="mry-body">

			<?php if ( $settings['dots'] == 'yes' ) : ?>
			<canvas class="mry-dots"></canvas>
			<?php endif; ?>

			<?php if ( $settings['items'] ) : ?>
			<div class="swiper-container mry-main-slider"<?php if ( $settings['mousewheel'] == 'yes' ) : ?> data-mousewheel="1"<?php else : ?> data-mousewheel="0"<?php endif; ?>>
				<div class="swiper-wrapper">

					<?php foreach ( $settings['items'] as $index => $item ) :
					    $item_title = $this->get_repeater_setting_key( 'title', 'items', $index );
					    $this->add_inline_editing_attributes( $item_title, 'basic' );

					    $item_title_b = $this->get_repeater_setting_key( 'title_b', 'items', $index );
					    $this->add_inline_editing_attributes( $item_title_b, 'basic' );

					    $item_subtitle = $this->get_repeater_setting_key( 'subtitle', 'items', $index );
					    $this->add_inline_editing_attributes( $item_subtitle, 'basic' );

					    $item_text = $this->get_repeater_setting_key( 'text', 'items', $index );
					    $this->add_inline_editing_attributes( $item_text, 'basic' );

					    $item_button1 = $this->get_repeater_setting_key( 'button1', 'items', $index );
					    $this->add_inline_editing_attributes( $item_button1, 'none' );

					    $item_button2 = $this->get_repeater_setting_key( 'button2', 'items', $index );
					    $this->add_inline_editing_attributes( $item_button1, 'none' );
					?>
					<div class="swiper-slide">

						<!-- project -->
						<div class="mry-project-slider-item">
							<div class="mry-project-frame<?php if ( $settings['overlay'] == 'half' ) : ?> mry-project-half<?php endif; ?>">
								<?php if ( $item['image'] ) : $image = wp_get_attachment_image_url( $item['image']['id'], 'mireya_1920xAuto' ); ?>
								<div class="mry-cover-frame">
									<img class="mry-project-cover mry-position-right" src="<?php echo esc_url( $image ); ?>" alt="" data-swiper-parallax="500"
										data-swiper-parallax-scale="1.4">
									<div class="mry-cover-overlay<?php if ( $settings['overlay'] == 'gradient' ) : ?> mry-gradient-overlay<?php endif; ?>"></div>
									<div class="mry-loading-curtain"></div>
								</div>
								<?php endif; ?>
								<div class="mry-main-title-frame">
									<div class="container">
										<div class="mry-main-title" data-swiper-parallax-x="30%" data-swiper-parallax-scale=".7" data-swiper-parallax-opacity="0"
											data-swiper-parallax-duration="1000">
											<?php if ( $item['subtitle'] ) : ?>
											<div class="mry-subtitle mry-mb-20">
												<span <?php echo $this->get_render_attribute_string( $item_subtitle ); ?>>
													<?php echo wp_kses_post( $item['subtitle'] ); ?>
												</span>
											</div>
											<?php endif; ?>
											<?php if ( $item['title'] ) : ?>
											<<?php echo esc_attr( $item['title_tag'] ); ?> class="mry-mb-30 mry-title--h">
												<span <?php echo $this->get_render_attribute_string( $item_title ); ?>>
													<?php echo wp_kses_post( $item['title'] ); ?>
												</span><br>
												<?php if ( $item['title_b'] ) : ?>
												<span class="mry-border-text">
													<span <?php echo $this->get_render_attribute_string( $item_title_b ); ?>>
														<?php echo wp_kses_post( $item['title_b'] ); ?>
													</span>
												</span>
												<?php endif; ?>
											</<?php echo esc_attr( $item['title_tag'] ); ?>>
											<?php endif; ?>
											<?php if ( $item['text'] ) : ?>
											<div class="mry-text mry-mb-30">
												<span <?php echo $this->get_render_attribute_string( $item_text ); ?>>
													<?php echo wp_kses_post( $item['text'] ); ?>
												</span>
											</div>
											<?php endif; ?>
											<?php if ( $item['button1'] && $item['button1_show'] == 'yes' ) : ?>
											<a<?php if ( $item['button1_link'] ) : if ( $item['button1_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['button1_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['button1_link']['url'] ); ?>"<?php endif; ?> class="mry-btn mry-default-link mry-anima-link">
												<span <?php echo $this->get_render_attribute_string( $item_button1 ); ?>>
													<?php echo wp_kses_post( $item['button1'] ); ?>
												</span>
											</a>
											<?php endif; ?>
											<?php if ( $item['button2'] && $item['button2_show'] == 'yes' ) : ?>
											<a<?php if ( $item['button2_link'] ) : if ( $item['button2_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['button2_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['button2_link']['url'] ); ?>"<?php endif; ?> class="mry-btn-text mry-default-link mry-anima-link">
												<span <?php echo $this->get_render_attribute_string( $item_button2 ); ?>>
													<?php echo wp_kses_post( $item['button2'] ); ?>
												</span>
											</a>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- project end -->

					</div>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="mry-slider-pagination-frame">
				<div class="mry-slider-pagination"></div>
			</div>

			<div class="mry-slider-nav-panel">
				<div class="container">
					<div class="mry-slider-progress-bar-frame">
						<div class="mry-slider-progress-bar">
							<div class="mry-progress"></div>
						</div>
					</div>
				</div>

				<div class="mry-slider-arrows">
					<div class="mry-label"><?php echo esc_html__( 'Slider Navigation', 'mireya-plugin' ); ?></div>
					<div class="mry-button-prev mry-magnetic-link"><span class="mry-magnetic-object"><i class="fas fa-arrow-left"></i></span></div>
					<div class="mry-button-next mry-magnetic-link"><span class="mry-magnetic-object"><i class="fas fa-arrow-right"></i></span></div>
				</div>
			</div>
			<?php endif; ?>
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

		<div class="mry-body">

			<# if ( settings.dots == 'yes' ) { #>
			<canvas class="mry-dots"></canvas>
			<# } #>

			<# if ( settings.items ) { #>
			<div class="swiper-container mry-main-slider">
				<div class="swiper-wrapper">
					<# _.each( settings.items, function( item, index ) {
					    var item_title = view.getRepeaterSettingKey( 'title', 'items', index );
					    view.addInlineEditingAttributes( item_title, 'basic' );

					    var item_title_b = view.getRepeaterSettingKey( 'title_b', 'items', index );
					    view.addInlineEditingAttributes( item_title_b, 'basic' );

					    var item_subtitle = view.getRepeaterSettingKey( 'subtitle', 'items', index );
					    view.addInlineEditingAttributes( item_subtitle, 'basic' );

					    var item_text = view.getRepeaterSettingKey( 'text', 'items', index );
					    view.addInlineEditingAttributes( item_text, 'basic' );

					    var item_button1 = view.getRepeaterSettingKey( 'button1', 'items', index );
					    view.addInlineEditingAttributes( item_button1, 'none' );

					    var item_button2 = view.getRepeaterSettingKey( 'button2', 'items', index );
					    view.addInlineEditingAttributes( item_button2, 'none' );
					#>
					<div class="swiper-slide">

						<!-- project -->
						<div class="mry-project-slider-item">
							<div class="mry-project-frame<# if ( settings.overlay == 'half' ) { #> mry-project-half<# } #>">
								<# if ( item.image ) { #>
								<div class="mry-cover-frame">
									<img class="mry-project-cover mry-position-right" src="{{{ item.image.url }}}" alt="" data-swiper-parallax="500"
										data-swiper-parallax-scale="1.4">
									<div class="mry-cover-overlay<# if ( settings.overlay == 'gradient' ) { #> mry-gradient-overlay<# } #>"></div>
									<div class="mry-loading-curtain"></div>
								</div>
								<# } #>
								<div class="mry-main-title-frame">
									<div class="container">
										<div class="mry-main-title" data-swiper-parallax-x="30%" data-swiper-parallax-scale=".7" data-swiper-parallax-opacity="0"
											data-swiper-parallax-duration="1000">
											<# if ( item.subtitle ) { #>
											<div class="mry-subtitle mry-mb-20">
												<span {{{ view.getRenderAttributeString( 'item_subtitle' ) }}}>
									          		{{{ item.subtitle }}}
									          	</span>
											</div>
											<# } #>
											<# if ( item.title ) { #>
											<{{{ item.title_tag }}} class="mry-mb-30 mry-title--h">
												<span {{{ view.getRenderAttributeString( 'item_title' ) }}}>
									          		{{{ item.title }}}
									          	</span><br>
									          	<# if ( item.title_b ) { #>
												<span class="mry-border-text">
													<span {{{ view.getRenderAttributeString( 'item_title_b' ) }}}>
										          		{{{ item.title_b }}}
										          	</span>
												</span>
												<# } #>
											</{{{ item.title_tag }}}>
											<# } #>
											<# if ( item.text ) { #>
											<div class="mry-text mry-mb-30">
												<span {{{ view.getRenderAttributeString( 'item_text' ) }}}>
									          		{{{ item.text }}}
									          	</span>
											</div>
											<# } #>
											<# if ( item.button1 && item.button1_show == 'yes' ) { #>
											<a<# if ( item.button1_link ) { if ( item.button1_link.is_external ) { #> target="_blank"<# } #><# if ( item.button1_link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ item.button1_link.url }}}"<# } #> class="mry-btn mry-default-link mry-anima-link">
												<span {{{ view.getRenderAttributeString( 'item_button1' ) }}}>
									          		{{{ item.button1 }}}
									          	</span>
											</a>
											<# } #>
											<# if ( item.button2 && item.button2_show == 'yes' ) { #>
											<a<# if ( item.button2_link ) { if ( item.button2_link.is_external ) { #> target="_blank"<# } #><# if ( item.button2_link.nofollow ) { #> rel="nofollow"<# } #> href="{{{ item.button2_link.url }}}"<# } #> class="mry-btn-text mry-default-link mry-anima-link">
												<span {{{ view.getRenderAttributeString( 'item_button2' ) }}}>
									          		{{{ item.button2 }}}
									          	</span>
											</a>
											<# } #>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- project end -->

					</div>
					<# }); #>
				</div>
			</div>

			<div class="mry-slider-pagination-frame">
				<div class="mry-slider-pagination"></div>
			</div>

			<div class="mry-slider-nav-panel">
				<div class="container">
					<div class="mry-slider-progress-bar-frame">
						<div class="mry-slider-progress-bar">
							<div class="mry-progress"></div>
						</div>
					</div>
				</div>

				<div class="mry-slider-arrows">
					<div class="mry-label">Slider Navigation</div>
					<div class="mry-button-prev mry-magnetic-link"><span class="mry-magnetic-object"><i class="fas fa-arrow-left"></i></span></div>
					<div class="mry-button-next mry-magnetic-link"><span class="mry-magnetic-object"><i class="fas fa-arrow-right"></i></span></div>
				</div>
			</div>
			<# } #>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Mireya_Hero_Slider_Widget() );
