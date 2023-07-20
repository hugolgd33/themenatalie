<section class="banner">
  <h1>Photographe event</h1>    
  <img src="<?php echo get_template_directory_uri(); ?>/images/banner-cover.png" alt="Photo de couverture">
</section>
<section class="container-general">
<?php if (have_posts()): ?>
    <div class="portfolio-container">
        <?php while (have_posts()): the_post(); ?>
            <div class="block-photo">
                <img class="photo-img" src="<?php the_post_thumbnail_url(); ?>" alt="">
                <div class="overlay">
                    <a class="lien" href="<?php the_permalink(); ?>"> </a>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/Icon_eye.png" alt="">
                    <button class="photo-visualisation"></button>
                    <p class="photo-reference">reference</p>
                    <h4 class="photo-category"><?php the_category() ?></h4>
                </div>
            <?php the_title() ?>
            
            </div>
        <?php endwhile ?>
    </div>
<?php else: ?>
<h1>pas d'article </h1>
<?php endif;?>
</section>
