<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Mireya Video Widget.
 *
 * @since 1.0
 */
class Mireya_Video_Widget extends Widget_Base {

	public function get_name() {
		return 'mireya-resume';
	}

	public function get_title() {
		return esc_html__( 'Video', 'mireya-plugin' );
	}

	public function get_icon() {
		return 'fa fa-video-camera';
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
				'label' => esc_html__( 'Title', 'mireya-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'video_link',
			[
				'label'       => esc_html__( 'Video Link (Youtube or Vimeo)', 'mireya-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'https://vimeo.com/25428289', 'mireya-plugin' ),
				'default'     => esc_html__( 'Video Link', 'mireya-plugin' ),
			]
		);

		$this->add_control(
			'video_image',
			[
				'label'       => esc_html__( 'Video Image (Placeholder)', 'mireya-plugin' ),
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
				'label'     => esc_html__( 'Video', 'mireya-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'btn_color',
			[
				'label'     => esc_html__( 'Button Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .mry-about-video .mry-video-cover-frame .mry-play-button' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .mry-about-video .mry-video-cover-frame .mry-play-button a i' => 'color: {{VALUE}};',
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

		?>

		<div class="mry-about">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-10">

						<div class="mry-about-video mry-mb-100 mry-fo">
							<div class="mry-video-cover-frame">
								<?php if ( $settings['video_image'] ) : $image = wp_get_attachment_image_url( $settings['video_image']['id'], 'mireya_1920xAuto' ); ?>
								<img class="mry-video-cover mry-scale-object" src="<?php echo esc_url( $image ); ?>" alt="">
								<?php endif; ?>
								<div class="mry-cover-overlay"></div>
								<div class="mry-play-button mry-magnetic-link">
									<?php if ( $settings['video_link'] ) : ?>
									<a class="mry-magnetic-object" data-magnific-video href="<?php echo esc_url( $settings['video_link'] ); ?>"><i class="fas fa-play"></i></a>
									<?php endif; ?>
								</div>
								<div class="mry-curtain"></div>
							</div>
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

		<div class="mry-about">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-10">

						<div class="mry-about-video mry-mb-100 mry-fo">
							<div class="mry-video-cover-frame">
								<# if ( settings.video_image ) { #>
								<img class="mry-video-cover mry-scale-object" src="{{{ settings.video_image.url }}}" alt="" />
								<# } #>
								<div class="mry-cover-overlay"></div>
								<div class="mry-play-button mry-magnetic-link">
									<# if ( settings.video_link ) { #>
									<a class="mry-magnetic-object" data-magnific-video href="{{{ settings.video_link }}}"><i class="fas fa-play"></i></a>
									<# } #>
								</div>
								<div class="mry-curtain"></div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Mireya_Video_Widget() );
