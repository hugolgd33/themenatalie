<?php
// scripts & css ajoutés au projet //
function nathalie_assets_install (){
    wp_register_script('jquery','https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js');
    wp_enqueue_script('jquery');
    wp_register_script('menu',get_template_directory_uri() .'/script/menu.js');
    wp_enqueue_script('menu');

    wp_register_style('contact',get_template_directory_uri() .'/css/popup-contact-style.css');
    wp_enqueue_style('contact');
    wp_register_style('style',get_template_directory_uri() .'/style.css');
    wp_enqueue_style('style');
}


add_action('wp_enqueue_scripts','nathalie_assets_install');



// menu dans admin wordpress //


function portfolio_parameter() {
    add_menu_page(__('Menu ajout portfolio', 'nathaliemota'), __('Portfolio', 'nathaliemota'), 'manage_options', 'nathaliemota-settings', 'nathaliemota_portfolio_settings', 'dashicons-admin-settings', 60);
    }
    
    function nathaliemota_portfolio_settings() {
    echo '<h1>'.get_admin_page_title().'</h1>';
    }
    
    add_action('admin_menu', 'portfolio_parameter', 10);

function cookinfamily_settings_register() {
register_setting('cookinfamily_settings_fields', 'cookinfamily_settings_fields', 'cookinfamily_settings_fields_validate');
add_settings_section('cookinfamily_settings_section', __('Paramètres', 'cookinfamily'), 'cookinfamily_settings_section_introduction', 'cookinfamily_settings_section');
add_settings_field('cookinfamily_settings_field_introduction', __('Introduction', 'cookinfamily'), 'cookinfamily_settings_field_introduction_output', 'cookinfamily_settings_section', 'cookinfamily_settings_section');
}

function cookinfamily_settings_section_introduction() {
echo __('Paramètrez les différentes options de votre thème CookInFamily.', 'cookinfamily');
}

function cookinfamily_settings_field_introduction_output() {
$value = get_option('cookinfamily_settings_field_introduction');

echo '<input name="cookinfamily_settings_field_introduction" type="text" value="'.$value.'" />';
}

add_action('admin_init', 'cookinfamily_settings_register');