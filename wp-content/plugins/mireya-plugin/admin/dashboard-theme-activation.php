<?php

require_once "includes/MireyaBase.php";

if ( ! class_exists( 'MireyaThemeActivation' ) ) {
class MireyaThemeActivation {
  public $plugin_file= __FILE__;
  public $responseObj;
  public $licenseMessage;
  public $showMessage = false;
  public $slug = 'mireya';

    function __construct() {
        $licenseKey = get_option( 'Mireya_lic_Key', '' );
        $liceEmail = get_option( 'Mireya_lic_email', '' );
        $renLink = get_option( 'Mireya_lic_Ren', '' );
        $templateDir=get_template_directory();

        MireyaBase::addOnDelete( function() {
           update_option( 'Mireya_lic_Key', '' );
           update_option( 'Mireya_lic_Status', '' );
           update_option( 'Mireya_lic_Ren', '' );
        });

        if ( MireyaBase::CheckWPPlugin( $licenseKey, $liceEmail, $this->licenseMessage, $this->responseObj, $templateDir.'/style.css' ) ) {
            add_action( 'admin_post_Mireya_el_deactivate_license', [ $this, 'action_deactivate_license' ] );
            if ( $this->responseObj->is_valid ) {
    					add_filter( 'mireya/is_theme_activated', '__return_true' );
    				}
            update_option( 'Mireya_lic_Status', 'active' );
            $renSupp = (string) $this->responseObj->support_renew_link;
            $renSupp = explode( '|', $renSupp );
            if ( is_array( $renSupp ) ) {
              $renSupp = $renSupp[0];
            } else {
              $renSupp = '';
            }
            update_option( 'Mireya_lic_Ren', $renSupp );
            add_action( 'mireya_theme_dashboard_activation_form', [ $this, 'activated_form_content' ] );
        } else {
            if ( !empty( $licenseKey ) && !empty( $this->licenseMessage ) ) {
               $this->showMessage = true;
            }
            update_option( 'Mireya_lic_Status', '') || add_option( 'Mireya_lic_Status', '' );
            update_option( 'Mireya_lic_Key', '') || add_option( 'Mireya_lic_Key', '' );
            update_option( 'Mireya_lic_Ren', '') || add_option( 'Mireya_lic_Ren', '' );
            add_action( 'admin_post_Mireya_el_activate_license', [ $this, 'action_activate_license' ] );
            add_action( 'admin_notices', 'mireya_theme_activation_notice' );
            add_action( 'mireya_theme_dashboard_activation_form', [ $this, 'license_form_content' ] );
        }
    }
    function action_activate_license(){
        check_admin_referer( 'el-license' );
        $licenseKey = ! empty( $_POST['el_license_key'] ) ? $_POST['el_license_key']: '';
        $licenseEmail = ! empty( $_POST['el_license_email'] ) ? $_POST['el_license_email']: '';
        update_option( 'Mireya_lic_Key', $licenseKey ) || add_option( 'Mireya_lic_Key', $licenseKey);
        update_option( 'Mireya_lic_email', $licenseEmail ) || add_option( 'Mireya_lic_email', $licenseEmail );

        update_option( '_site_transient_update_themes', '' );
        update_option( '_site_transient_update_plugins', '' );
        wp_safe_redirect( admin_url( 'admin.php?page=' . $this->slug . '-theme-activation' ) );
    }
    function action_deactivate_license() {
        check_admin_referer( 'el-license' );
        $message = '';
        if ( MireyaBase::RemoveLicenseKey( __FILE__,$message ) ) {
            update_option( 'Mireya_lic_Key', '' ) || add_option( 'Mireya_lic_Key', '' );
            update_option( 'Mireya_lic_Status', '') || add_option( 'Mireya_lic_Status', '');

            update_option( '_site_transient_update_themes', '' );
            update_option( '_site_transient_update_plugins', '' );
        }
        wp_safe_redirect( admin_url( 'admin.php?page='.$this->slug . '-theme-activation' ) );
    }
    function activated_form_content(){
        ?>
        <div class="mireya-dashboard-activation">
          <h2><?php echo esc_html__( 'Mireya Theme is successfully activated!', 'mireya-plugin' ); ?></h2>
          <p><?php echo esc_html__( 'Check your license status and support details for Mireya theme.', 'mireya-plugin' ); ?></p>
          <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <input type="hidden" name="action" value="Mireya_el_deactivate_license"/>

            <div class="mireya-dashboard-list">
              <ul>
                <li>
                   <strong><?php echo esc_html__( 'Status:', 'mireya-plugin' );?></strong>
                   <?php if ( $this->responseObj->is_valid ) : ?>
                   <span class="el-license-valid"><?php echo esc_html__( 'Activated', 'mireya-plugin' );?></span>
                   <?php else : ?>
                   <span class="el-license-invalid"><?php echo esc_html__( 'Invalid Activated', 'mireya-plugin' ); ?></span>
                   <?php endif; ?>
                </li>
                <li>
                   <strong><?php echo esc_html__( 'License Type:', 'mireya-plugin' );?></strong>
                   <?php echo $this->responseObj->license_title; ?>
                </li>
                <li>
                   <strong><?php echo esc_html__( 'License Expired on:', 'mireya-plugin' );?></strong>
                   <?php echo $this->responseObj->expire_date; ?>
                </li>
                <li>
                   <strong><?php echo esc_html__( 'Support Expired on:', 'mireya-plugin' );?></strong>
                   <?php
                       echo $this->responseObj->support_end;
                       $renew_str = (string) $this->responseObj->support_renew_link;
                       $renew_str = explode( '|', $renew_str );

                       $renew_link = 'https://1.envato.market/' . $renew_str[0];
                       if ( !empty( $this->responseObj->support_renew_link ) ){
                        ?>
                        <a target="_blank" class="button-link" href="<?php echo esc_url( $renew_link ); ?>"><?php echo esc_html( 'Renew', 'mireya-plugin' ); ?></a>
                        <?php
                    }
                   ?>
                </li>
                <li>
                   <strong><?php echo esc_html__( 'Your License Key:', 'mireya-plugin' ); ?></strong>
                   <span class="el-license-key"><?php echo esc_attr( substr($this->responseObj->license_key,0,9)."XXXXXXXX-XXXXXXXX".substr($this->responseObj->license_key,-9) ); ?></span>
                </li>
              </ul>
              <div class="buttons">
                <?php wp_nonce_field( 'el-license' ); ?>
                <?php submit_button( esc_attr__( 'Deactivate License', 'mireya-plugin' ) ); ?>
                <a href="<?php echo esc_url( admin_url( 'admin-post.php' ) . '?action=mireya_fupc' ); ?>" class="button button-link">
                  <?php echo esc_html__( 'Check Updates', 'mireya-plugin' ); ?>
                </a>
                <a target="_blank" class="button button-link" href="https://1.envato.market/c/1790164/275988/4415?u=https://themeforest.net/item/mireya-architecture-portfolio-wordpress-theme/31598936/support">
                  <?php echo esc_html__( 'Get Support', 'mireya-plugin' ); ?>
                </a>
              </div>
            </div>
          </form>

          <div class="notice notice-info">
              <p><?php echo sprintf( __( 'Note! You can have <strong>ONE active theme installation</strong> at a time. You can move the license to a different domain by "Deactivate License" from the active theme installation and then re-activate the theme on a different WordPress installation.', 'mireya-plugin' ) ); ?></p>
          </div>
        </div>
    <?php
    }

    function license_form_content() {
        ?>
        <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <input type="hidden" name="action" value="Mireya_el_activate_license"/>
            <div class="mireya-dashboard-activation">
                <h2><?php echo esc_html__( 'Activate Mireya Theme and Support', $this->slug );?></h3>
                <?php
                if ( !empty( $this->showMessage ) && !empty( $this->licenseMessage ) ) {
                    ?>
                    <div class="notice notice-error is-dismissible">
                        <p><?php echo esc_html__( $this->licenseMessage, 'mireya-plugin' ); ?></p>
                    </div>
                    <?php
                }
                ?>
                <p><?php echo esc_html__( 'Enter your purchase code here, to activate your copy of Mireya theme, and get access to premium support and lifetime auto theme updates.', 'mireya-plugin' );?></p>
                <p><i><?php echo sprintf( 'Not have purchase code yet? Buy now on <a href="%s" target="_blank">Envato Market</a>', 'https://1.envato.market/e4NGzD' ); ?></i></p>
                <table>
                  <tr>
                    <th><label for="el_license_key"><?php echo esc_html__( 'Purchase Code', 'mireya-plugin' ); ?></label></th>
                    <td>
                      <input type="text" class="regular-text code" name="el_license_key" size="50" placeholder="<?php echo esc_attr__( 'xxxxxxxx-xxxxxxxx-xxxxxxxx-xxxxxxxx', 'mireya-plugin' ); ?>" required="required" />
                      <div class="description">
                        <?php echo esc_html__( 'Can\'t find the purchase code?', 'mireya-plugin' ); ?> <a target="_blank" href="https://1.envato.market/c/1790164/275988/4415?u=https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-"><?php echo esc_html__( 'Follow this guide', 'mireya-plugin' ); ?></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th><label for="el_license_email"><?php echo esc_html__( 'Email Address', 'mireya-plugin' ); ?></label></th>
                    <td>
                      <?php
                          $purchaseEmail = get_option( 'Mireya_lic_email', get_bloginfo( 'admin_email' ) );
                      ?>
                      <input type="text" class="regular-text code" name="el_license_email" size="50" value="<?php echo esc_attr( $purchaseEmail ); ?>" placeholder="<?php echo esc_attr__( 'your-email@domain.com', 'mireya-plugin' ); ?>" required="required" />
                      <div class="description"><?php echo esc_html__( 'We will send update news of this theme by this email, don\'t worry, we hate spam', 'mireya-plugin' );?></div>
                    </td>
                  </tr>
                  <tr>
                    <th></th>
                    <td>
                      <div class="buttons">
                          <?php wp_nonce_field( 'el-license' ); ?>
                          <?php submit_button( esc_attr__( 'Submit', 'mireya-plugin' ) ); ?>
                      </div>
                    </td>
                  </tr>
                </table>

                <div class="notice notice-info">
                    <p><?php echo esc_html__( 'Note! You are not required to separately register / activated any of the plugins which are bundled with the theme.', 'mireya-plugin' ); ?></p>
                </div>
                <div class="notice notice-info">
                    <p><?php echo sprintf( __( 'Note! You can have <strong>ONE active theme installation</strong> at a time. You can move the license to a different domain by "Deactivate License" from the active theme installation and then re-activate the theme on a different WordPress installation.', 'mireya-plugin' ) ); ?></p>
                </div>
            </div>
        </form>
        <?php
    }
}

}

new MireyaThemeActivation();
