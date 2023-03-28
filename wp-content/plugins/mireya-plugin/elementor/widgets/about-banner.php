<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Mireya About Banner Widget.
 *
 * @since 1.0
 */
class Mireya_About_Banner_Widget extends Widget_Base {

	public function get_name() {
		return 'mireya-banner';
	}

	public function get_title() {
		return esc_html__( 'About Banner', 'mireya-plugin' );
	}

	public function get_icon() {
		return 'fa fa-info';
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
			'bg_image',
			[
				'label'       => esc_html__( 'Background Image', 'mireya-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'label', [
				'type' => Controls_Manager::TEXT,
				'label' => esc_html__( 'Name', 'mireya-plugin' ),
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter label', 'mireya-plugin' ),
				'default'	=> esc_html__( 'Label', 'mireya-plugin' ),
			]
		);

		$repeater->add_control(
			'value', [
				'type' => Controls_Manager::TEXT,
				'label' => esc_html__( 'Value', 'mireya-plugin' ),
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter value', 'mireya-plugin' ),
				'default'	=> esc_html__( 'Value', 'mireya-plugin' ),
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Info List', 'mireya-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ label }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_styling',
			[
				'label'     => esc_html__( 'Content', 'mireya-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .qrt-page-cover .qrt-about-info' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'label_color',
			[
				'label'     => esc_html__( 'Label Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .qrt-table li h5' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typography',
				'label'     => esc_html__( 'Label Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .qrt-table li h5',
			]
		);

		$this->add_control(
			'value_color',
			[
				'label'     => esc_html__( 'Value Color', 'mireya-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .qrt-table li > span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'value_typography',
				'label'     => esc_html__( 'Value Typography', 'mireya-plugin' ),
				'selector' => '{{WRAPPER}} .qrt-table li > span',
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

		<div class="row qrt-p-0-40">
          <div class="col-lg-12">
            <div class="qrt-page-cover">
              <?php if ( $settings['bg_image'] ) : $image = wp_get_attachment_image_url( $settings['bg_image']['id'], 'mireya_1920xAuto' ); ?>
              <img src="<?php echo esc_url( $image ); ?>" alt="" />
              <?php endif; ?>
              <?php if ( get_field( 'page_layout' ) != 1 ) : ?>
              <div class="qrt-hint-frame">
                <div class="qrt-scroll-hint">
                  <span></span>
                </div>
              </div>
          	  <?php endif; ?>
              <?php if ( $settings['list'] ) : ?>
              <div class="qrt-about-info<?php if ( get_field( 'page_layout' ) == 1 ) : ?> qrt-right-position<?php endif; ?>">
                <div class="qrt-cover-info">
				  <ul class="qrt-table">
					<?php foreach ( $settings['list'] as $index => $item ) :
					$item_label = $this->get_repeater_setting_key( 'label', 'list', $index );
					$this->add_inline_editing_attributes( $item_label, 'basic' );

					$item_value = $this->get_repeater_setting_key( 'value', 'list', $index );
					$this->add_inline_editing_attributes( $item_value, 'basic' );
                    ?>
                    <li>
                      <h5 class="qrt-white">
                      	<span <?php echo $this->get_render_attribute_string( $item_label ); ?>>
	        				<?php echo wp_kses_post( $item['label'] ); ?>
	        			</span>
                      </h5>
                      <span <?php echo $this->get_render_attribute_string( $item_value ); ?>>
						<?php echo esc_html( $item['value'] ); ?>
					  </span>
					</li>
                    <?php endforeach; ?>
				  </ul>
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

		<div class="row qrt-p-0-40">
          <div class="col-lg-12">
            <div class="qrt-page-cover">
              <# if ( settings.bg_image ) { #>
              <img src="{{{ settings.bg_image.url }}}" alt="" />
              <# } #>
              <# if ( settings.list ) { #>
              <div class="qrt-about-info qrt-right-position">
                <div class="qrt-cover-info">
				  <ul class="qrt-table">
					<# _.each( settings.list, function( item, index ) {

					  var item_label = view.getRepeaterSettingKey( 'label', 'list', index );
					  view.addInlineEditingAttributes( item_label, 'basic' );

					  var item_value = view.getRepeaterSettingKey( 'value', 'list', index );
					  view.addInlineEditingAttributes( item_value, 'basic' );

					#>
                    <li>
                      <h5 class="qrt-white">
                      	<span {{{ view.getRenderAttributeString( item_label ) }}}>
	        				{{{ item.label }}}
	        			</span>
                      </h5>
                      <span {{{ view.getRenderAttributeString( item_value ) }}}>
							{{{ item.value }}}
		        	  </span>
					</li>
                    <# }); #>
				  </ul>
                </div>
              </div>
         	  <# } #>
            </div>
          </div>
        </div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Mireya_About_Banner_Widget() );
