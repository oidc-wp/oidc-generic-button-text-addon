<?php
/**
 * Plugin Name: OpenID Connect Client Button Text Settings Add-on
 * Description: Provides Dashboard settings to manage the login button text for the OpenID Connect Client plugin.
 * Version: 1.0.0
 *
 * @package  OpenidConnectGeneric_MuPlugin
 *
 * @link     https://github.com/oidc-wp/oidc-generic-button-text-addon
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Modifies the OIDC login button text.
 *
 * @link https://github.com/daggerhart/openid-connect-generic#openid-connect-generic-login-button-text
 *
 * @param string $text The button text.
 *
 * @return string
 */
function ogbta_login_button_text( $text ) {

	// @var array<mixed> $settings
	$settings = get_option( 'openid_connect_generic_settings', array() );

	$text = ( ! empty( $settings['oidc_login_button_text'] ) ) ? strval( $settings['oidc_login_button_text'] ) : __( 'Login with SSO', 'oidc-generic-button-text-addon' );

	return $text;

}
add_filter( 'openid-connect-generic-login-button-text', 'ogbta_login_button_text', 10, 1 );

/**
 * Adds a new setting that allows an Administrator to set the button text from
 * the plugin settings screen.
 *
 * @link https://github.com/daggerhart/openid-connect-generic#openid-connect-generic-settings-fields
 *
 * @param array<mixed> $fields The array of settings fields.
 *
 * @return array<mixed>
 */
function ogbta_add_login_button_text_setting( $fields ) {

	// @var array<mixed> $field_array
	$field_array = array(
		'oidc_login_button_text' => array(
			'title'       => __( 'Login Button Text', 'oidc-generic-button-text-addon' ),
			'description' => __( 'Set the login button label text.', 'oidc-generic-button-text-addon' ),
			'type'        => 'text',
			'section'     => 'client_settings',
		),
	);

	// Prepend the field array with the new field to push it to the top of the settings screen.
	return $field_array + $fields;

}
add_filter( 'openid-connect-generic-settings-fields', 'ogbta_add_login_button_text_setting', 10, 1 );
