$(document).ready(function() {

    $('#btLogin').on('click', function(e) {
        $.ajax({
            type: "POST",
            url: BASE_URL + '/index.php?page=Accueil&action=login',
            data: {login:$('#login').val(),password:$('#password').val()},
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

    $('#password').on('keyup', function(e) {
        if(e.keyCode == 13) {
            $('#btLogin').trigger('click');
        }
    });
});