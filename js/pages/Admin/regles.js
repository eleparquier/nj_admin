$(document).ready(function() {
    CKEDITOR.replace( 'regles' );
    var btEnvoyerRegles = $('.btEnvoyerRegles');
    btEnvoyerRegles.on('click', function (e) {
        if(btEnvoyerRegles.hasClass('btn-primary')) {
            $.ajax({
                type: "POST",
                url: BASE_URL + '/index.php?page=Admin&action=modifRegles',
                data: {regles: CKEDITOR.instances['regles'].getData()},
                success: function (data) {
                    btEnvoyerRegles.removeClass('btn-primary');
                }
            });
        }
    });

    CKEDITOR.instances['regles'].on('key', function(e) {
        btEnvoyerRegles.addClass('btn-primary');
    });
});