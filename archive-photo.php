


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
        

    <!--Filtres formulaire html -->
    <form action="#" method="POST" class="form">


                <select name="categorie-photo">
                    <?php
                    $categories = get_terms([
                        'taxonomy' => 'categorie-photo',
                    ]); 
                    ?>
                    <option  value="1" >CATÉGORIES</option>
                    <?php
                    foreach ($categories as $categorie) : ?>
                        <option
                        value="<?php echo $categorie->slug; ?>"
                        > <?php echo $categorie->name; ?> </option>
                    <?php endforeach; ?>
           
                </select>
                <select name="format-photo">
                    <?php
                  $formats = get_terms( array(
                    'taxonomy'   => 'format-photo',
                ) );
                    ?>
                    <option value="1">FORMATS</option>
                    <?php
                    foreach ($formats as $format) : ?>
                        <option
                        value="<?php echo $format->slug; ?>"
                        > <?php echo $format->name; ?> </option>
                    <?php endforeach; ?>
           
                </select>

                <select name="annee-photo">
                    <?php
                  $annees = get_terms( array(
                    'taxonomy'   => 'annee-photo',
                ) );
                    ?>
                    <option  value="1">TRIER PAR</option>
                    <?php
                    foreach ($annees as $annee) : ?>
                        <option
                        value="<?php echo $annee->slug; ?>"
                        > <?php echo $annee->name; ?> </option>
                    <?php endforeach; ?>
                </select>

            </form>

           

        <div id="contain-photo"class="portfolio-container">
<!-- Photos qui correspondent au filtre-->
<?php
if(have_posts()):
  while(have_posts()): the_post();
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
    ?>
        <div class="div-btn-load">
        <button id="load-more-posts" data-page="2">Charger plus</button>
       </div>
       <?php
endif;
  ?>
  </div>
 
</section>


<?php get_footer()?>