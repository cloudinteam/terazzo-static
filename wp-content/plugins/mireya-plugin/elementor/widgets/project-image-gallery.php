<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Mireya Project Image Gallery Widget.
 *
 * @since 1.0
 */
class Mireya_Project_Image_Gallery_Widget extends Widget_Base {

	public function get_name() {
		return 'mireya-project-image-gallery';
	}

	public function get_title() {
		return esc_html__( 'Project Image Gallery', 'mireya-plugin' );
	}

	public function get_icon() {
		return 'fas fa-project-diagram';
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
			'title_tab',
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
			'size', [
				'label'       => esc_html__( 'Size', 'mireya-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default', 'mireya-plugin' ),
					'vertical' => __( 'Vertical', 'mireya-plugin' ),
					'wide' => __( 'Wide', 'mireya-plugin' ),
				],
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Images', 'mireya-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
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
			'masonry',
			[
				'label' => esc_html__( 'Masonry Grid', 'mireya-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Enable', 'mireya-plugin' ),
				'label_off' => __( 'Disable', 'mireya-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
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
					'{{WRAPPER}} .mry-main-title .mry-numbering .mry-border-text' => '-webkit-text-stroke-color: {{VALUE}};',
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
		$this->add_inline_editing_attributes( 'num', 'basic' );

		$theme_lightbox = get_field( 'portfolio_lightbox_disable', 'option' );

		?>

		<div class="container">
			<div class="row">
				<?php if ( $settings['title'] || $settings['num'] || $settings['subtitle'] ) : ?>
				<div class="col-lg-12">
					<div class="mry-main-title mry-title-center mry-p-0-40">
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
						<<?php echo esc_attr( $settings['title_tag'] ); ?> class="mry-fo mry-title--h">
							<span <?php echo $this->get_render_attribute_string( 'title' ); ?>>
				          		<?php echo wp_kses_post( $settings['title'] ); ?>
				         	</span>
						</<?php echo esc_attr( $settings['title_tag'] ); ?>>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
				<?php if ( $settings['items'] ) : ?>
				<div class="col-lg-12">
					<div class="mry-portfolio-frame">
						<div class="mry-masonry-grid mry-without-descr mry-p-0-100">
							<div class="mry-grid-sizer"></div>
							<?php foreach ( $settings['items'] as $index => $item ) : ?>
							<?php if ( $item['image'] ) :  $image = wp_get_attachment_image_url( $item['image']['id'], 'mireya_950xAuto' ); $image_full = wp_get_attachment_image_url( $item['image']['id'], 'mireya_1920xAuto' ); ?>
							<div class="mry-masonry-grid-item mry-masonry-grid-item-50<?php if ( $item['size'] == 'vertical' ) : ?> mry-masonry-grid-item-h-x-2<?php endif; ?><?php if ( $item['size'] == 'wide' ) : ?> mry-masonry-grid-item-100<?php endif; ?>">

								<div class="mry-card-item">
									<div class="mry-card-cover-frame mry-mb-20 mry-fo">
										<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>" class="mry-scale-object">
										<div class="mry-cover-overlay"></div>
										<div class="mry-hover-links">
											<a<?php if ( ! $theme_lightbox ) : ?> data-magnific-gallery<?php endif; ?> data-elementor-lightbox-slideshow="gallery" data-no-swup href="<?php echo esc_url( $image_full ); ?>" class="mry-zoom mry-magnetic-link">
												<span class="mry-magnetic-object"><i class="fas fa-expand"></i></span>
											</a>
										</div>
									</div>
								</div>

							</div>
							<?php endif; ?>
							<?php endforeach; ?>
						</div>
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
		view.addInlineEditingAttributes( 'num', 'basic' );
		view.addInlineEditingAttributes( 'subtitle', 'basic' );
		#>

		<div class="container">
			<div class="row">
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
				<# if ( settings.items ) { #>
				<div class="col-lg-12">
					<div class="mry-portfolio-frame">
						<div class="mry-masonry-grid mry-without-descr mry-p-0-100">
							<div class="mry-grid-sizer"></div>
							<# _.each( settings.items, function( item, index ) { #>
							<# if ( item.image ) { #>
							<div class="mry-masonry-grid-item mry-masonry-grid-item-50<# if ( item.size == 'vertical' ) { #> mry-masonry-grid-item-h-x-2<# } #><# if ( item.size == 'wide' ) { #> mry-masonry-grid-item-100<# } #>">
								<div class="mry-card-item">
									<div class="mry-card-cover-frame mry-mb-20 mry-fo">
										<img src="{{{ item.image.url }}}" alt="{{{ item.name }}}" class="mry-scale-object">
										<div class="mry-cover-overlay"></div>
										<div class="mry-hover-links">
											<a data-magnific-gallery data-elementor-lightbox-slideshow="gallery" data-no-swup href="{{{ item.image.url }}}" class="mry-zoom mry-magnetic-link">
												<span class="mry-magnetic-object"><i class="fas fa-expand"></i></span>
											</a>
										</div>
									</div>
								</div>
							</div>
							<# } #>
							<# }); #>
						</div>
					</div>
				</div>
				<# } #>
			</div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Mireya_Project_Image_Gallery_Widget() );
