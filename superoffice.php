<?php
/*
Plugin Name: SuperOffice
Plugin URI: http://www.superoffice.com
Description: This plugin helps your SuperOffice CRM integration -which helps you to transfer contact details to WordPress- to collect your site's user roles.
Version: 1.1.0
Author: SuperOffice InfoBridge Software B.V.
Author URI: https://wordpress.superofficeapps.com/
*/

if (!defined( 'WPINC' )) {
    die;
}

function superoffice_rest_get_roles() {
    global $wp_roles;

    return $wp_roles->roles;
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'superoffice/v1', '/roles', array(
        'methods' => 'GET',
        'callback' => 'superoffice_rest_get_roles',
        'permission_callback' => function () {
            return current_user_can('edit_user');
        }
    ));
});