<?php

return array(

    'username' => 'Korisničko ime',
    'password' => 'Lozinka',
    'password_confirmation' => 'Potvrda lozinke',
    'e_mail' => 'Email',
    'username_e_mail' => 'korisničko ime ili email',

    'signup' => array(
        'title' => 'Registracija',
        'desc' => 'Registriraj novi račun',
        'confirmation_required' => 'Potrebna potvrda !',
        'submit' => 'Kreiraj novi račun',
    ),

    'login' => array(
        'title' => 'Prijava',
        'desc' => 'Unesite vaše podatke',
        'forgot_password' => 'Zaboravljena lozinka',
        'remember' => 'Upamti me',
        'submit' => 'Prijava',
    ),

    'forgot' => array(
        'title' => 'Zaboravljena lozinka',
        'submit' => 'Nastavi',
    ),

    'alerts' => array(
        'account_created' => 'Vaš račun je uspješno stvoren',
        'instructions_sent'       => 'Molimo provjerite Vaš email sa instrukcijama kako potvrditi račun',
        'too_many_attempts' => 'Previše pokušaja, molimo pokušajte za par minuta',
        'wrong_credentials' => 'Netočno korisničko ime,email ili lozinka',
        'not_confirmed' => 'Vaš račun nije povrđen, molimo potražite email s linkom za provjeru',
        'confirmation' => 'Čestitamo ! Vaš račun je potvrđen ! Sada možete pristupiti sustavu',
        'wrong_confirmation' => 'Ups ! Pogrešan kod potvrde',
        'password_forgot' => 'Podaci potrebni za reset lozinke su Vam poslani na email',
        'wrong_password_forgot' => 'Korisnik nije pronađen',
        'password_reset' => 'Lozinka je uspješno promjenjena',
        'wrong_password_reset' => 'Netočna lozinka ili greška, molimo kontaktirajte administratore',
        'wrong_token' => 'Token za reset lizinke nije validan',
        'duplicated_credentials' => 'Pristupni podaci koje ste predložili se već koriste, molimo predložite nove',
    ),

    'email' => array(
        'account_confirmation' => array(
            'subject' => 'Potvrda emaila',
            'greetings' => 'Pozdrav :name',
            'body' => 'Molimo pristupite navedenom linku kako bi ste potvrdili račun.',
            'farewell' => 'Lijep pozdrav,',
        ),

        'password_reset' => array(
            'subject' => 'Resetiraj lozinku',
            'greetings' => 'Pozdrav :name',
            'body' => 'Molimo pristupite sljedećem linku kako bi ste promjenili lozinku',
            'farewell' => 'Lijep pozdrav,',
        ),
    ),

);
