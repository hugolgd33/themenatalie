<?php
// scripts & css ajoutés au projet //
function nathalie_assets_install (){
    wp_register_script('jquery','https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js');
    wp_enqueue_script('jquery');
    wp_register_script('menu',get_template_directory_uri() .'/script/menu.js');
    wp_enqueue_script('menu');

    wp_register_style('contact',get_template_directory_uri() .'/css/popup-contact-style.css');
    wp_enqueue_style('contact');
    wp_register_style('contentsingle',get_template_directory_uri() .'/css/_content-single.css');
    wp_enqueue_style('contentsingle');
    wp_register_style('style',get_template_directory_uri() .'/style.css');
    wp_enqueue_style('style');
}


add_action('wp_enqueue_scripts','nathalie_assets_install');


// fonctions supportées par le thème //
function nathalie_supports (){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header','Navigation menu');
}
add_action('after_setup_theme','nathalie_supports');

// menu dans admin wordpress //


