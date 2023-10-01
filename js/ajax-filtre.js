jQuery(document).ready(function($) {
    // Écoutez l'événement de changement sur les sélecteurs
    $('select[name="categorie-photo"], select[name="format-photo"],select[name="annee-photo"]').on('change', function() {
        // Récupérez les valeurs des sélecteurs
        var categorie = $('select[name="categorie-photo"]').val();
        var format = $('select[name="format-photo"]').val();
        var annee = $('select[name="annee-photo"]').val();

        // Vérifiez si la valeur du select est "1" et excluez-le si c'est le cas
        if (categorie === "1") {
            categorie = ""; // Assurez-vous que la valeur est vide pour exclure la catégorie
        }
        if (format === "1") {
            format = ""; // Assurez-vous que la valeur est vide pour exclure le format
        }
        if (annee === "1") {
            console.log("aucune année select");
            annee = ""; // Assurez-vous que la valeur est vide pour exclure le format
        }

        // Effectuez une requête AJAX pour filtrer les éléments
        $.ajax({
            type: 'POST',
            url: ajaxfiltre.ajax_url,
            data: {
                action: 'filtrer_photos',
                categorie: categorie,
                format: format,
                annee: annee,
                nonce: ajaxfiltre.nonce
            },
            success: function(response) {
                $('#contain-photo').html(response);
            }
        });
    });
});
jQuery(document).ready(function($) {
    var postsPerPage = 12; // Modifiez cette valeur selon vos besoins

    $('#load-more-posts').click(function() {
        var button = $(this),
            page = button.data('page');
        var divbtn = $(".div-btn-load");

        $.ajax({
            url: ajaxfiltre.ajax_url,
            type: 'post',
            data: {
                action: 'load_more_photos',
                page: page
            },
            success: function(response) {
                // Convertissez la réponse en un objet jQuery
                var $response = $(jQuery.parseHTML(response));

                // Filtrer pour obtenir uniquement les éléments .block-photo
                var blockPhotos = $response.filter(function() {
                    return $(this).hasClass('block-photo');
                });

                // Vérifiez la présence de .block-photo
                if(blockPhotos.length < postsPerPage) {
                    // Si le nombre de posts retournés est inférieur à postsPerPage
                    divbtn.hide();
                } 
                
                $('#contain-photo').append(response);
                button.data('page', page + 1);
            }
        });
    });
});

