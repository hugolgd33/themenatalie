

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <title>Nathalie Moka</title>
        <?php wp_head() ?>
    </head>
<body>
<script>
  document.addEventListener('DOMContentLoaded', function() {

// Événement lors de l'ouverture de la lightbox
window.addEventListener('lightboxStart', function() {
    document.body.style.overflow = 'hidden';
});

// Événement lors de la fermeture de la lightbox
window.addEventListener('lightboxEnd', function() {
    document.body.style.overflow = '';
});
});

</script>
<?php 
get_template_part('template-parts/menu');
get_template_part('template-parts/popup-overlay');