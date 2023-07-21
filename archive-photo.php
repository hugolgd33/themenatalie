<?php

/*
Template Name: Photo
*/
 get_header()
 ?>
<section class="banner">
  <h1>Photographe event</h1>    
  <img src="<?php echo get_template_directory_uri(); ?>/images/header/header_<?php echo(rand(0,15));?>.jpeg" alt="Photo de couverture">
</section>
<section class="container-general">
    <main class="archive__body">

    <!--début : création des filtres pour la page archive-->
            <form class="archive__body__filtres" method="POST">

                <select class="select_categorie" name="categorie-photo" id="categorie-photo">
                <option selected value="0">Catégorie</option>
                <?php $terms = get_terms('categorie-photo');
                foreach($terms as $term){ ?>
                <option value="<?php echo $term->slug ?>"><?php echo $term->slug ?></option>

               <?php }

                ?>

                <input type="submit"></input>
            </form>


        <?php 
            $filtres = array( 'post_type' => 'photo', 'posts_per_page' => 12, 'paged' => $paged);

            if (isset ($_POST ['categorie-photo']) && ($_GET ['categorie-photo']) != "0")
            {
                $filtres ['categorie-photo']=$_GET['categorie-photo'];
            }
            $reponse = new WP_Query( $filtres );
        ?>


        <div class="portfolio-container">

            <?php while ( $reponse->have_posts() ) : $reponse->the_post(); 
            
             $image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');
             $current_post = get_post();           
             echo '<div class="block-photo">';
             echo '<img class="photo-img" src="'.$image[0].'"/>';
             echo '<div class="overlay">'; ?>
             <a class="lien" href="<?php the_permalink(); ?>"> </a><?php
               echo'<img src="'. get_template_directory_uri().'/images/Icon_eye.png" alt="">';
               echo'<button class="photo-visualisation"></button>'; ?>
               <p class="photo-reference"><?php the_field( 'reference' ); ?></p> <?php
               echo'<h4 class="photo-category">'. wp_get_post_terms( $current_post->ID, 'categorie-photo')[0]->name .'</h4>';
              
             echo'</div>';
             echo'</div>';
            ?> 

            <?php endwhile;?>
            
        </div>
    </main>
</section>

<?php get_footer()?>