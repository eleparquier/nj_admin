$(document).ready(function() {
    CKEDITOR.replace( 'regles' );

    $('.btEnvoyerRegles').on('click', function (e) {
        $.ajax({
            type: "POST",
            url: BASE_URL + '/index.php?page=Admin&action=modifRegles',
            data: {regles:CKEDITOR.instances['regles'].getData()},
            success: function(data) {
                if(data.error != 0) {
                    $('.loginPourError').addClass('has-error');
                    $('.loginPourError .help-block').html(data.errorMsg);
                } else {
                    $('.loginPourError').removeClass('has-error');
                    $('.loginPourError .help-block').html('');
                    window.location.reload();
                }
            },
            dataType: 'json'
        });
    });

    CKEDITOR.instances['regles'].on('key', function(e) {
        $('.groupBt').addClass('has-warning');
        $('.groupBt').find('.help-block').html('Le texte a été mofifié');
    });
});