<?php
/**
 * Plugin Name: Password Strength Requirements for Woocommerce
 * Plugin URI: https://bizstudio.co.nz/password-strength-requirements-woocommerce/
 * Description: A plugin to customise password strength requirements in WooCommerce.
 * Version: 1.1.0
 * Author: Bizstudio NZ
 * Author URI: https://bizstudio.co.nz
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Requires Plugins: woocommerce
 * Text Domain: password-strength-rwc
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add a link to the settings page on the plugins page.
function bzwps_plugin_settings_link( $links ) {
    $settings_link = '<a href="admin.php?page=wc-settings&tab=account">' . __('Settings', 'password-strength-rwc') . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'bzwps_plugin_settings_link' );

// Register settings in WooCommerce's Accounts & Privacy tab.
function bzwps_register_wc_settings( $settings ) {
    $custom_settings = array(
        array(
            'title' => __( 'Password Strength Settings', 'password-strength-rwc' ), // Added title array
            'type'  => 'title',
            'id'    => 'bzwps_password_strength_options',
        ),
    );

    $custom_settings[] = array(
        'title'    => __( 'Minimum Password Length', 'password-strength-rwc' ),
        'desc'     => __( 'Select the minimum number of characters required for a password.', 'password-strength-rwc' ),
        'id'       => 'bzwps_min_password_length',
        'type'     => 'select',
        'options'  => array(
            '6'  => '6',
            '8'  => '8',
            '10' => '10',
            '12' => '12',
            '14' => '14',
            '18' => '18',
            '20' => '20',
            '30' => '30',
        ),
        'default'  => '6',
        'desc_tip' => true,
    );
    
    $custom_settings[] = array(
        'title'    => __( 'Minimum Numeric Characters', 'password-strength-rwc' ),
        'desc'     => __( 'Set the minimum number of numeric characters required.', 'password-strength-rwc' ),
        'id'       => 'bzwps_min_numeric_chars',
        'type'     => 'select',
        'options'  => array(
            '0' => __( 'None', 'password-strength-rwc' ),
            '1' => __( 'At least 1', 'password-strength-rwc' ),
            '2' => __( 'At least 2', 'password-strength-rwc' ),
        ),
        'default'  => '1',
        'desc_tip' => true,
    );

    $custom_settings[] = array(
        'title'    => __( 'Minimum Special Characters', 'password-strength-rwc' ),
        'desc'     => __( 'Set the minimum number of special characters required.', 'password-strength-rwc' ),
        'id'       => 'bzwps_min_special_chars',
        'type'     => 'select',
        'options'  => array(
            '0' => __( 'None', 'password-strength-rwc' ),
            '1' => __( 'At least 1', 'password-strength-rwc' ),
            '2' => __( 'At least 2', 'password-strength-rwc' ),
        ),
        'default'  => '1',
        'desc_tip' => true,
    );

    $custom_settings[] = array(
        'type' => 'sectionend',
        'id'   => 'bzwps_password_strength_options',
    );

    return array_merge( $settings, $custom_settings );
}
add_filter( 'woocommerce_account_settings', 'bzwps_register_wc_settings' );

// Validate password based on custom settings.
function bzwps_validate_password_strength( $password ) {
    $min_length        = get_option( 'bzwps_min_password_length', 8 );
    $min_numeric_chars = get_option( 'bzwps_min_numeric_chars', '1' );
    $min_special_chars = get_option( 'bzwps_min_special_chars', '1' );

    // Check password length.
    if ( strlen( $password ) < $min_length ) {
        return false;
    }

    // Check numeric characters.
    if ( preg_match_all( '/[0-9]/', $password ) < $min_numeric_chars ) {
        return false;
    }

    // Check special characters.
    if ( preg_match_all( '/[\W]/', $password ) < $min_special_chars ) {
        return false;
    }

    return true;
}

// Hook into WooCommerce password validation.
function bzwps_custom_password_strength( $strength ) {
    if ( isset( $_POST['account_password'] ) ) {
// Nonce verification
if ( ! isset( $_POST['bzwps_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['bzwps_nonce'] ) ), 'bzwps_save_settings' ) ) {
    wp_die( esc_html__( 'Nonce verification failed. Please try again.', 'password-strength-rwc' ) );
}

$password = sanitize_text_field( wp_unslash( $_POST['account_password'] ) );

        if ( ! bzwps_validate_password_strength( $password ) ) {
            return 4; // 4 represents 'Insufficient'.
        }
    }

    return $strength;
}
add_filter( 'woocommerce_min_password_strength', 'bzwps_custom_password_strength' );

// Add a nonce field to the form
function bzwps_add_nonce_field() {
    wp_nonce_field( 'bzwps_save_settings', 'bzwps_nonce' );
}
add_action( 'woocommerce_edit_account_form', 'bzwps_add_nonce_field' );
