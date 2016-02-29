var LoginController = {
    validator: {
        message: 'Vdijednost nije istpravna',
        feedbackIcons: validatorIcons,
        fields: {
            username: {
                message: 'Korisničko ime nije ispravno',
                validators: {
                    notEmpty: {
                        message: 'Korisničko ime je obavezno i ne može biti prazno'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ ]+$/,
                        message: 'Korisničko ime se može sastojati samo od alfanumeričkih znakova i _'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Lozinka je obavezna i ne može biti prazna'
                    }
                }
            }
        }
    },

    submitHandler: function (e) {
        $(".form-notification").hide();
        e.preventDefault();
        var $form = $(e.target);
        var bv = $form.data('bootstrapValidator');

        $.ajax({
            type: "POST",
            url: $form.attr('action'),
            data: $form.serialize(),
            dataType: 'JSON'
        })
            .done(function (result) {
                if (result.data.hasOwnProperty('message')) {
                    $(".form-notification").addClass('alert-success').removeClass('alert-danger').text(result.data.message).show();
                }

                if (result.data.hasOwnProperty('redirect')) {
                    window.location = result.data.redirect;
                } else if (result.status == 1) {
                    window.location = homeUrl;
                }
            })

            .fail(function (xhr) {
                var result = $.parseJSON(xhr.responseText);
                if (result.data.hasOwnProperty('message')) {
                    $(".form-notification").addClass('alert-danger').removeClass('alert-success').text(result.data.message).show();
                }

            });
    }

}