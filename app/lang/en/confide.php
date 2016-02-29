<?php

return array(

    'username' => 'Korisničko ime',
    'password' => 'Lozinka',
    'password_confirmation' => 'Potvrdite lozinku',
    'e_mail' => 'Email',
    'username_e_mail' => 'Korisničko ime ili email',
    'signup' => array(
        'title' => 'Registracija',
        'desc' => 'Registriraj novi računt',
        'confirmation_required' => 'Potrebna je potvrda korisničkog računa',
        'submit' => 'Registriraj novi korisnički račun',
    ),
    'login' => array(
        'title' => 'Prijava',
        'desc' => 'Unesite svoje pristupne podatke',
        'forgot_password' => 'Zaboravljena lozinka',
        'remember' => 'Zapamti me',
        'submit' => 'Prijava',
    ),
    'forgot' => array(
        'title' => 'Zaboravljena lozinka',
        'submit' => 'Nastavi',
    ),
    'alerts' => array(
        'account_created' => 'Vaš račun je uspješno stvoren, poveznica za potvrdu je poslana na vašu email adresu.',
        'instructions_sent' => 'Molimo provjerite email sa linkom za potvdu vaše email adrese.',
        'too_many_attempts' => 'Previše pokušaja prijave, pokušajte ponovo za par minuta',
        'wrong_credentials' => 'Netočno korisničko ime ili lozinka',
        'not_confirmed' => 'Vaš račun nije potvrđen. Molimo potražite link potvrde na Vašem emailu.',
        'confirmation' => 'Vaš račun je uspješno potvrđen, Možete se prijaviti..',
        'password_confirmation' => 'Lozinke ne odgovaraju',
        'wrong_confirmation' => 'Krivi kod potvrde.',
        'password_forgot' => 'Podaci potrebni za reset lozinke su Vam poslani na email',
        'wrong_password_forgot' => 'Korisnik nije pronađen.',
        'password_reset' => 'Vaša lozinka je uspješno promjenjena.',
        'wrong_password_reset' => 'Netočna lozinka, molimo pokušajte ponovo',
        'wrong_token' => 'Reset token nije važeći.',
        'duplicated_credentials' => 'Podaci koje ste unjeli se već koriste, molimo unesite druge podatke',
    ),
    'email' => array(
        'account_confirmation' => array(
            'subject' => 'Potvrda korisničkog računa',
            'greetings' => 'Pozdrav :name',
            'body' => 'Molimo pristupite sljedećoj poveznici kako bi ste potvrdili Vaš korisnički račun.',
            'farewell' => 'Lijep pozdrav',
        ),
        'password_reset' => array(
            'subject' => 'Reset lozinke',
            'greetings' => 'Pozdrav :name',
            'body' => 'Molimo pristupite sljedećoj poveznici kako bi ste resetirali vašu lozinku',
            'farewell' => 'Lijep pozdrav',
        ),
    ),

);
