var RegistrationController = {
    validator: {
        message: 'Vrijednost nije ispravna',
        feedbackIcons: validatorIcons,
        fields: {

            username: {
                message: 'Korisničko ime nije ispravno',
                validators: {
                    notEmpty: {
                        message: 'Korisničko ime je obavezno i ne može biti ostavljeno prazno'
                    },
                    stringLength: {
                        min: 4,
                        max: 16,
                        message: 'Korisničko ime mora biti između 4 i 16 znakova'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ ]+$/,
                        message: 'Korisničko ime se može sastojati od alfanumeričkih znakova i _'
                    },
                    remote: {
                        message: 'Korisničko ime je zauzeto',
                        url: usernameCheckUrl
                    }
                }
            },

            password: {
                validators: {
                    notEmpty: {
                        message: 'Lozinka je obavezna i ne može biti ostavljena prazna'
                    },
                    stringLength: {
                        min: 4,
                        max: 255,
                        message: 'Lozinka mora biti izmežu 4 i 255 znakova'
                    },
                    identical: {
                        field: 'password_confirmation',
                        message: 'Lozinka i potvrda lozinke nisu jednake'
                    }
                }
            },

            password_confirmation: {
                validators: {
                    notEmpty: {
                        message: 'Potvrda lozinke je obavezna i ne može biti ostavljena prazna'
                    },
                    identical: {
                        field: 'password',
                        message: 'Lozinka i potvrda lozinke nisu jednake'
                    }
                }
            },

            email: {
                validators: {
                    emailAddress: {
                        message: 'Unesena vrijednost nije valjana email adresa'
                    },
                    remote: {
                        message: 'Email adresa nije dostupna',
                        url: emailCheckUrl
                    }
                }
            },

            name: {
                message: 'Naziv nije ispravan',
                validators: {
                    notEmpty: {
                        message: 'Naziv ne može biti prazan'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ čćžšđČĆŽŠĐ]+$/,
                        message: 'Naziv moraju biti alfanumerički znakovi'
                    }
                }
            },


            address: {
                message: 'Adresa nije ispravna',
                validators: {
                    notEmpty: {
                        message: 'Adresa ne može biti prazna'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ čćžšđČĆŽŠĐ]+$/,
                        message: 'Adresa mora biti alfanumerički znakovi'
                    }
                }
            },


            contact_person: {
                message: 'Kontakt osoba nije ispravna',
                validators: {
                    notEmpty: {
                        message: 'Kontakt osoba ne može biti prazna'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ čćžšđČĆŽŠĐ]+$/,
                        message: 'Kontakt osoba mora biti alfanumerički znakovi'
                    }
                }
            },


            phone: {
                message: 'Telefon nije ispravan',
                validators: {
                    notEmpty: {
                        message: 'Telefon ne može biti prazan'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ čćžšđČĆŽŠĐ]+$/,
                        message: 'Telefon mora biti niz alfanumeričkih znakova'
                    }
                }
            },


            web: {
                message: 'Web nije ispravan',
                validators: {
                    notEmpty: {
                        message: 'Web ne može biti prazan'
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
                if (result.status == 1) {
                    if (result.data.hasOwnProperty('message')) {
                        $(".form-notification").addClass('alert-success').removeClass('alert-danger').text(result.data.message).show();
                        $form.find("input, textarea").val("");
                    }
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