<!-- contact ref automatique -->
<script type="text/javascript">
jQuery(document).ready(function($) {
  $('#ref_input').val('<?php $ref_active =the_field( 'reference' ); echo $ref_active; ?>');
});
</script>

<!-- Page début -->
<article class="post-photo" id="post-<?php the_ID(); ?>" >
	<div class="post-info">
		<div class="post-single">
			<div class="post-desc">
				<?php the_title( '<h2 class="post-desc-title">', '</h2>' ); ?>
				<p>
					<strong> Référence :</strong> <?php the_field( 'reference' ); ?><br>
					<strong>Format :</strong> <?php the_field( 'format' ); ?><br>
					<?php the_terms( $post->ID, 'categorie-photo', '<strong> Catégorie : </strong> ' ); ?><br>
					<strong>Type : </strong><?php the_field( 'type' ); ?><br>
					<strong>Année : </strong><?php the_field( 'annee' ); ?>
				</p>
			</div>

			<div class="post-img">
				<?php 
					echo '<div class="post-img-container">';
						$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');
						echo '<img src="'.$image[0].'"/>';
					echo '</div>';
					?>
			</div>
		</div>
		<div class="post-bottom-container">
			<div class="post-contact">
				<p>Cette photo vous interresse ?</p> 
				<a class="post-contact-btn" href="#" onclick="Popup()">Contact</a>
			</div>
			
			<div class="post-navigation">
				<div class="post-navigation-previous">
					<?php 
						$previous = get_previous_post();
						if($previous!=null)
						{
							echo '<a href="'.esc_url( get_permalink($previous->ID) ) .'">'; 
							$img_previous = wp_get_attachment_image_src( get_post_thumbnail_id($previous->ID), 'thumbnail');
							echo '<img class="post-navigation-img" src="'.$img_previous[0].'"/>';
							echo'</br>';
							echo '<img class="post-arrow" src="'.get_stylesheet_directory_uri().'/images/assets/arrow-previous.png"/>';
							echo '</a>';
						}
					?>
				</div>
				<div class="post-navigation-later">
					<?php
						$later = get_next_post();
						if($later!=null)
						{
							echo '<a href="'.esc_url( get_permalink($later->ID) ) .'">'; 
							$img_later = wp_get_attachment_image_src( get_post_thumbnail_id($later->ID), 'thumbnail'); 
							echo '<img class="post-navigation-img" src="'.$img_later[0].'"/>';
							echo'</br>';
							echo '<img class="post-arrow" src="'.get_stylesheet_directory_uri().'/images/assets/arrow-later.png"/>';
							echo '</a>';
						}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="post-feat">
		<h3>Vous aimerez aussi</h3>
		<div class="post-feat-container">
        <?php 
				$current_post = get_post();
				$getcategorie_post_param = wp_get_post_terms( $current_post->ID, 'categorie-photo');
                $categorie_post_nom = $getcategorie_post_param[0]->name;
                $vous_aimerez_param = [
                    'post_type' => 'photo',
					'categorie-photo'=> $categorie_post_nom,
                ];
                $test = new WP_Query( $vous_aimerez_param);
                $nmb_post = 0;
                while ( ($test->have_posts()) && ($nmb_post <3)  ):
                    
					$test->the_post();
					$article = get_post();
					if ($current_post->ID != $article->ID)
					{

                        $nmb_post = $nmb_post + 1;
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');
                        
                        $nmb_post = $nmb_post + 1;
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
					};
                    
                endwhile; 
				
		
			?>
			
		</div>
	</div>
	<a class="post-contact-btn post-btn-bottom" href="<?php echo get_home_url(); ?>/photo/" >Voir toutes les photos</a>
</article>



