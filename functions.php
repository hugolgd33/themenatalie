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
add_action('wp_enqueue_scripts', function(){
    wp_enqueue_script('main', get_stylesheet_directory_uri() . '/script/menu.js', '', '', true);
  });
  

add_action('wp_enqueue_scripts','nathalie_assets_install');


// fonctions supportées par le thème //
function nathalie_supports (){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header','Navigation menu');
}
add_action('after_setup_theme','nathalie_supports');

// redirect home //

function custom_redirects() {

	if ( is_front_page() ) {
		wp_redirect( home_url( '/photo/' ) );
		die;
	}

}
add_action( 'template_redirect', 'custom_redirects' );


function ajouter_script_ajax() {
    wp_enqueue_script('ajax-filtre', get_template_directory_uri() . '/js/ajax-filtre.js', array('jquery'), '1.0', true);
    wp_localize_script('ajax-filtre', 'ajaxfiltre', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajaxfiltre-nonce')
    ));
}
add_action('wp_enqueue_scripts', 'ajouter_script_ajax');






function filtrer_photos() {
    // Vérifiez le nonce de sécurité
    if ( !isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'ajaxfiltre-nonce') )
        die('Permission non accordée.');

    // Récupérez les valeurs des filtres
    $categorie = $_POST['categorie'];
    $format = $_POST['format'];
    $annee = $_POST['annee'];

    // Construisez votre requête WP_Query en fonction des filtres
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => -1, // Afficher tous les articles
        'tax_query' => array(
            'relation' => 'AND',
        ),
    );

    // Ajoutez la condition pour exclure la catégorie ou le format si la valeur est "1"
    if ($categorie !== "") {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie-photo',
            'field' => 'slug',
            'terms' => $categorie,
        );
    }

    if ($format !== "") {
        $args['tax_query'][] = array(
            'taxonomy' => 'format-photo',
            'field' => 'slug',
            'terms' => $format,
        );
    }
    if ($annee !== "") {
        $args['tax_query'][] = array(
            'taxonomy' => 'annee-photo',
            'field' => 'slug',
            'terms' => $annee,
        );
    }

    $query = new WP_Query($args);

    // Boucle pour afficher les éléments filtrés
    
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');
            $current_post = get_post();           
            ?>
            <div class="block-photo">
                <img class="photo-img" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
                <div class="overlay">
                    <a class="photo-visualisation" href="<?php echo $image[0]; ?>" data-lightbox="photos" title="<span class='ref'><?php the_field('reference'); ?></span> <span class='cat'><?php echo wp_get_post_terms( $current_post->ID, 'categorie-photo')[0]->name; ?></span>">
                        <i class="fas fa-expand"></i> <!-- Icône de plein écran -->
                     </a>
                    <a class="lien" href="<?php the_permalink(); ?>"></a>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/Icon_eye.png" alt="">
                    <p class="photo-reference"><?php the_field( 'reference' ); ?></p>
                    <h4 class="photo-category"><?php echo wp_get_post_terms( $current_post->ID, 'categorie-photo')[0]->name; ?></h4>
                   
                </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo 'Aucune photo trouvée.';
    endif;
    die();
}
add_action('wp_ajax_filtrer_photos', 'filtrer_photos');
add_action('wp_ajax_nopriv_filtrer_photos', 'filtrer_photos');




function ajouter_lightbox() {
    // Styles Lightbox2
    wp_enqueue_style('lightbox', get_template_directory_uri() . '/lightbox/lightbox.min.css');
    // Scripts Lightbox2
    wp_enqueue_script('lightbox', get_template_directory_uri() . '/lightbox/lightbox.min.js', array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'ajouter_lightbox');






// Charger plus fonction

function load_more_photos() {
    $paged = $_POST['page'];
    
    $args = array(
        'post_type' => 'photo', // Changez ceci si votre custom post type a un autre nom
        'posts_per_page' => 12,
        'paged' => $paged
    );

    $query = new WP_Query($args);

    if($query->have_posts()):
        while($query->have_posts()): $query->the_post();
        $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'image-reduite');
        $current_post = get_post();
        ?>
        <div class="block-photo">
            <img class="photo-img" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
            <div class="overlay">
                <a class="photo-visualisation" href="<?php echo $image[0]; ?>" data-lightbox="photos" title="<span class='ref'><?php the_field('reference'); ?></span> <span class='cat'><?php echo wp_get_post_terms( $current_post->ID, 'categorie-photo')[0]->name; ?></span>">
                    <i class="fas fa-expand"></i> <!-- Icône de plein écran -->
                 </a>
                <a class="lien" href="<?php the_permalink(); ?>"></a>
                <img src="<?php echo get_template_directory_uri(); ?>/images/Icon_eye.png" alt="">
                <p class="photo-reference"><?php the_field( 'reference' ); ?></p>
                <h4 class="photo-category"><?php echo wp_get_post_terms( $current_post->ID, 'categorie-photo')[0]->name; ?></h4>
               
            </div>
        </div>
        <?php
        endwhile;
    endif;

    wp_reset_postdata();
    die();
}
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');
?>
