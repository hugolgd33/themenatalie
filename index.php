<?php get_header()?>
<section class="banner">
  <h1>Photographe event</h1>    
  <img src="<?php echo get_template_directory_uri(); ?>/images/header/header_<?php echo(rand(0,15));?>.jpeg" alt="Photo de couverture">
</section>
<section class="container-general">
    <main class="archive__body">

    <!--début : création des filtres pour la page archive-->
            <form class="archive__body__filtres" method="POST">
                <select class="archive__body__filtres__selection archive__filtres__selection--date" name="categorie-photo" id="categorie-photo">
                    <option selected value="0">CATEGORIE</option>
                    <option value="reception">Réception</option>
                    <option value="television">Télévision</option>
                    <option value="concert">Concert</option>
                    <option value="mariage">Mariage</option>
                    
                </select>
            
                <select class="archive__body__filtres__selection archive__filtres__selection--date" name="format" id="format">
                    <option selected value="0">FORMATS</option>
                    <option value="paysage">Paysage</option>
                    <option value="portrait">Portrait</option>
                </select>

                <select class="archive__body__filtres__selection archive__filtres__selection--date" name="annee" id="annee">
                    <option selected value="0">TRIER PAR</option>
                    <option value="recentes">Des plus récentes aux plus anciennes</option>
                    <option value="anciennes">Des plus anciennes aux plus récentes</option>
                </select>

                <button type="submit">envoyer</button>
            </form>
    <!--fin : création des filtres pour la page archive-->

    <!-- je définis ce que je veux -->
        <?php $filtres = array( 'post_type' => 'photo', 'posts_per_page' => 12, 'paged' => $paged);
    /*début : vérification du filtre format*/

        if (isset ($_POST ['format']) && ($_GET ['format']) != "0")
        {
            $filtres ['format']=$_GET['format'];
        }
        if (isset ($_POST ['categorie-photo']) && ($_GET ['categorie-photo']) != "0")
        {
            $filtres ['categorie-photo']=$_GET['categorie-photo'];
        }
        if (isset ($_POST ['annee']) && ($_GET ['annee']) != "0")
        {
            $filtres ['annee']=$_GET['annee'];
        }
        ?>
        <!--fin : vérification du filtre format-->

        <!--je fais la demande des informations que je souhaite a wp que je stock dans une réponse(variable)-->
        <?php $reponse = new WP_Query( $filtres ); ?>

        <div class="archive__body__photos">
            <!--parcourir les informations ($reponse) et les affiche-->
            <?php while ( $reponse->have_posts() ) : $reponse->the_post(); ?>
            <!--début : l'ensemble des photos de la page-->
            <?php
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
            <!--fin : l'ensemble des photos de la page-->

            <?php endwhile;?>
            <button id="boutonChargerPlus" class=" load-posts">
                Charger plus
            </button> 
            <div id="post-container"></div>
            
        </div>
    </main>
</section>

<?php get_footer()?>