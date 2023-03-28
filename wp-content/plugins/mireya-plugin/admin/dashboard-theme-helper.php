<?php

/* Theme Info Class */
if ( ! function_exists( 'mireya_theme_info' ) ) {
  function mireya_theme_info() {
    $data = array();

    $theme = wp_get_theme();
    $theme_parent = $theme->parent();
    if ( !empty( $theme_parent ) ) {
      $theme = $theme_parent;
    }
    $data['slug'] = $theme->get_stylesheet();
    $data['name'] = $theme[ 'Name' ];
    $data['version'] = $theme[ 'Version' ];
    $data['author'] = $theme[ 'Author' ];
    $data['is_child'] = ! empty( $theme_parent );

    return $data;
  }
}
if ( ! class_exists( 'MireyaThemeInfo' ) ) {
  class MireyaThemeInfo {

    private static $_instance = null;

    public $slug;

    public $name;

    public $version;

    public $author;

    public $is_child;

    public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
				self::$_instance->init();
			}
			return self::$_instance;
		}

    public function __construct() {

		}

    public function init() {
      $theme = wp_get_theme();
      $theme_parent = $theme->parent();
      if ( !empty( $theme_parent ) ) {
        $theme = $theme_parent;
      }

      $this->slug = $theme->get_stylesheet();
      $this->name = $theme[ 'Name' ];
      $this->version = $theme[ 'Version' ];
      $this->author = $theme[ 'Author' ];
      $this->is_child = ! empty( $theme_parent );
    }
  }
}

function mireya_theme_info() {
  return MireyaThemeInfo::instance();
}
add_action( 'plugins_loaded', 'mireya_theme_info' );

/* Plugin Info Class */
if ( ! class_exists( 'MireyaPluginInfo' ) ) {
  class MireyaPluginInfo {

    private static $_instance = null;

    public $name;

    public $version;

    public $author;

    public $slug;

    public $capability;

    public $dashboard_uri;

    public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
				self::$_instance->init();
			}
			return self::$_instance;
		}

    public function __construct() {

		}

    public function init() {
      $plugin = MireyaPlugin::get_plugin_info();
      $status = get_option( 'Mireya_lic_Status' );

      $this->name = $plugin['Name'];
      $this->version = $plugin['Version'];
      $this->author = $plugin[ 'Author' ];
      $this->slug = 'mireya-plugin';
      $this->capability = ( $status == 'active' ) ? 'extended' : 'normal';
      $this->dashboard_uri = plugin_dir_url( __FILE__ );
    }
  }
}

function mireya_plugin_info() {
  return MireyaPluginInfo::instance();
}
add_action( 'plugins_loaded', 'mireya_plugin_info' );

/* Activation Notice */
if ( ! function_exists( 'mireya_theme_activation_notice' ) ) {
	function mireya_theme_activation_notice() {
    // Return early if the nag message has been dismissed or user < author.
    if ( get_user_meta( get_current_user_id(), 'mireya_dismissed_notice', true ) || ! current_user_can( apply_filters( 'mireya_show_admin_notice_capability', 'publish_posts' ) ) ) {
      return;
    }
	?>
    <div class="notice notice-warning is-dismissible">
			<p><?php echo wp_kses_post( 'Please activate Mireya theme to unlock all features: premium support and receive all future theme updates automatically!', 'mireya-plugin' ); ?></p>
      <p>
        <a href="<?php echo admin_url( 'admin.php?page=mireya-theme-activation' ); ?>" class="button button-primary"><?php echo esc_html__( 'Activate Now', 'mireya-plugin' ); ?></a>
        <a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'mireya-dismiss', 'dismiss_admin_notices' ), 'mireya-dismiss-' . get_current_user_id() ) ); ?>" class="dismiss-notice" target="_parent"><?php echo esc_html__( 'Dismiss this notice', 'mireya-plugin' ); ?></a>
      </p>
		</div>
	<?php
	}
}

/* Activation Filter */
if ( ! function_exists( 'mireya_is_theme_activated' ) ) {
	function mireya_is_theme_activated() {
		return apply_filters( 'mireya/is_theme_activated', false );
	}
}
