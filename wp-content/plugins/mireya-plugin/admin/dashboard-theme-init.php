<?php

if ( ! class_exists( 'MireyaThemeDashboard' ) ) {
	class MireyaThemeDashboard {

		public $dashboard_slug = 'mireya-theme-dashboard';

		private static $_instance = null;

		/* Instance */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
				self::$_instance->init_theme_dashboard_enqueue();
				self::$_instance->init_theme_dashboard_menu();
				self::$_instance->init_theme_dashboard_content();
			}
			return self::$_instance;
		}

		public function __construct() {

		}

    public function init_theme_dashboard_content() {
    }

    public function theme_dashboard_assets() {

      /* enqueue theme dashboard styles */
			wp_enqueue_style( 'mireya-theme-dashboard-style', mireya_plugin_info()->dashboard_uri . 'assets/css/dashboard.css', [], mireya_plugin_info()->version );
			wp_enqueue_style( 'mireya-theme-dashboard-webfonts', mireya_plugin_info()->dashboard_uri . 'assets/css/webfonts.css', [], mireya_plugin_info()->version );

      /* enqueue theme dashboard scripts */
      wp_enqueue_script( 'mireya-theme-dashboard-scripts', mireya_plugin_info()->dashboard_uri . 'assets/js/dashboard.js', [ 'jquery' ], mireya_plugin_info()->version, true );
		}

		public function init_theme_dashboard_enqueue() {
      add_action( 'admin_enqueue_scripts', array( $this, 'theme_dashboard_assets' ) );
    }

    public function init_theme_dashboard_menu() {
			add_action( 'admin_menu', [ $this, 'theme_dashboard_menu' ] );
    }

		public function theme_dashboard_menu() {
			$menu_position = 2;
			$menu_admin_capability = 'manage_options';

			add_menu_page(
				esc_html__( 'Mireya Panel', 'mireya-plugin' ),
				esc_html__( 'Mireya Panel', 'mireya-plugin' ),
				$menu_admin_capability,
				$this->dashboard_slug,
				[ $this, 'theme_dashboard_general_render' ],
				'dashicons-bslthemes',
				$menu_position
			);

			$submenu_items = array();

			$submenu_items[] = array(
				$this->dashboard_slug,
				esc_html__( 'Theme Dashboard', 'mireya-plugin' ),
				esc_html__( 'Welcome', 'mireya-plugin' ),
				$menu_admin_capability,
				'mireya-theme-dashboard',
				[ $this, 'theme_dashboard_general_render' ]
			);

			$submenu_title = 	esc_html__( 'Activate', 'mireya-plugin' );

			if ( mireya_plugin_info()->capability != 'normal'  ) : $submenu_title = esc_html__( 'Status', 'mireya-plugin' ); endif;

			$submenu_items[] = array(
				$this->dashboard_slug,
				$submenu_title,
				$submenu_title,
				$menu_admin_capability,
				'mireya-theme-activation',
				[ $this, 'theme_dashboard_activation_render' ]
			);

			$submenu_items[] = array(
				$this->dashboard_slug,
				esc_html__( 'Plugins', 'mireya-plugin' ),
				esc_html__( 'Plugins', 'mireya-plugin' ),
				$menu_admin_capability,
				'mireya-theme-plugins',
				[ $this, 'theme_dashboard_plugins_render' ]
			);

			$submenu_items[] = array(
				$this->dashboard_slug,
				esc_html__( 'Demo Content', 'mireya-plugin' ),
				esc_html__( 'Demo Content', 'mireya-plugin' ),
				$menu_admin_capability,
				'mireya-theme-demo',
				[ $this, 'theme_dashboard_demo_render' ]
			);

			$submenu_items[] = array(
				$this->dashboard_slug,
				esc_html__( 'Help Center', 'mireya-plugin' ),
				esc_html__( 'Help Center', 'mireya-plugin' ),
				$menu_admin_capability,
				'mireya-theme-help',
				[ $this, 'theme_dashboard_help_render' ]
			);

			$submenu_position = 0;

			foreach  ( $submenu_items as $params ) {
				$submenu_position += 2;

				add_submenu_page(
					$params[0],
					$params[1],
					$params[2],
					$params[3],
					$params[4],
					$params[5],
					$submenu_position
				);
			}

		}

		public function theme_dashboard_general_render() {
			$this->theme_dashboard_header();
			$this->theme_dashboard_body( 'general' );
			$this->theme_dashboard_footer();
		}

		public function theme_dashboard_activation_render() {
			$this->theme_dashboard_header();
			$this->theme_dashboard_body( 'activation' );
			$this->theme_dashboard_footer();
		}

		public function theme_dashboard_plugins_render() {
			$this->theme_dashboard_header();
			$this->theme_dashboard_body( 'plugins' );
			$this->theme_dashboard_footer();
		}

		public function theme_dashboard_demo_render() {
			$this->theme_dashboard_header();
			$this->theme_dashboard_body( 'demo' );
			$this->theme_dashboard_footer();
		}

		public function theme_dashboard_help_render() {
			$this->theme_dashboard_header();
			$this->theme_dashboard_body( 'help' );
			$this->theme_dashboard_footer();
		}

		public function theme_dashboard_header() {
			global $submenu;
			$menu_items = '';
			if ( isset( $submenu[ $this->dashboard_slug ] ) ) {
				$menu_items = $submenu[ $this->dashboard_slug ];
			}
			if ( ! empty( $menu_items ) ) :
			?>

			<div class="mireya-dashboard">
				<div class="mireya-dashboard-header">
					<div class="nav-tab-wrapper">
						<?php foreach ( $menu_items as $item ):
							$class = isset( $_GET['page'] ) && $_GET['page'] == $item[2] ? ' nav-tab-active' : '';
							?>
							<a href="<?php echo esc_url( admin_url( 'admin.php?page=' . $item[2] ) ); ?>" class="nav-tab<?php echo esc_attr( $class ); ?>">
								<?php echo esc_html( $item[0] ); ?>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="mireya-dashboard-wrapper">
			<?php endif;
		}

		public function theme_dashboard_body( $template ) {
			$env_elements = 1;

			//if ( mireya_plugin_info()->capability == 'normal' && ( $template == 'plugins' || $template == 'demo' ) ) {
			if ( mireya_plugin_info()->capability == 'normal' && ( $template == 'plugins' || $template == 'demo' ) && ! $env_elements ) {
				require_once 'templates/dashboard-' . $template  . '-normal.php';
			} else {
				require_once 'templates/dashboard-' . $template  . '.php';
			}
		}

		public function theme_dashboard_footer() {
			?>
					<div class="mireya-dashboard-footer">
						<div class="copyright">
							<?php echo sprintf( __( '&copy; %s %s. All rights reserved. ', 'mireya-plugin' ), date('Y'), '<a href="https://bslthemes.com/" target="_blank">bslthemes</a>' ); ?>
						</div>
					</div>
				</div>
			</div>
		<?php }
	}

	function mireya_theme_dashboard_init() {
		return MireyaThemeDashboard::instance();
	}

	mireya_theme_dashboard_init();
}
