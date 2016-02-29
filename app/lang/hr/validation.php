<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => " :attribute mora biti prihvaćen.",
	"active_url"           => " :attribute nije validan URL",
	"after"                => " :attribute mora biti iza  :date.",
	"alpha"                => " :attribute može samo sadržavati slova",
	"alpha_dash"           => " :attribute može sadržavati samo slova,brojeve i crtice",
	"alpha_num"            => " :attribute može samo sadržavati slova i brojke.",
	"array"                => " :attribute mora biti niz.",
	"before"               => " :attribute mora biti prije :date.",
	"between"              => array(
		"numeric" => " :attribute mora biti između :min i :max.",
		"file"    => " :attribute mora biti između :min i :max kilobytes.",
		"string"  => " :attribute mora biti između :min i :max znakova.",
		"array"   => " :attribute mora imati između :min i :max itema.",
	),
	"confirmed"            => " :attribute potvrda ne odgovara.",
	"date"                 => " :attribute nije ispravan datum.",
	"date_format"          => " :attribute ne odgovara formatu :format.",
	"different"            => " :attribute i :other moraju biti različiti.",
	"digits"               => " :attribute moraju biti :digits brojke.",
	"digits_between"       => " :attribute mora biti između :min i :max znamenki.",
	"email"                => " :attribute mora biti ispravna email adresa.",
	"exists"               => " odabrani :attribute je neispravan.",
	"image"                => " :attribute mora biti slika.",
	"in"                   => " odabrani :attribute je neispravan.",
	"integer"              => " :attribute mora biti cijeli broj.",
	"ip"                   => " :attribute mora biti ispravna IP adresa.",
	"max"                  => array(
		"numeric" => " :attribute ne smije biti veći od :max.",
		"file"    => " :attribute ne smije biti veći od :max kilobytes.",
		"string"  => " :attribute ne smije biti veći od :max characters.",
		"array"   => " :attribute ne smije biti veći od :max items.",
	),
	"mimes"                => " :attribute must be a file of type: :values.",
	"min"                  => array(
		"numeric" => " :attribute mora imati najmanje :min.",
		"file"    => " :attribute mora imati najmanje :min kilobytes.",
		"string"  => " :attribute mora imati najmanje :min characters.",
		"array"   => " :attribute mora imati najmanje :min items.",
	),
	"not_in"               => " odabrani :attribute je neispravan.",
	"numeric"              => " :attribute mora biti broj.",
	"regex"                => " :attribute format je neispravan.",
	"required"             => " :attribute polje je obavezno.",
	"required_if"          => " :attribute polje je obavezno kad :other je :value.",
	"required_with"        => " :attribute polje je obavezno kad :values je odabrana.",
	"required_with_all"    => " :attribute polje je obavezno kad :values je odabrana.",
	"required_without"     => " :attribute polje je obavezno kad :values je odabrana.",
	"required_without_all" => " :attribute polje je obavezno kad niti jedna  :values su odabrane.",
	"same"                 => " :attribute i :other moraju biti jednaki.",
	"size"                 => array(
		"numeric" => " :attribute mora biti :size.",
		"file"    => " :attribute mora biti :size kilobytes.",
		"string"  => " :attribute mora biti :size characters.",
		"array"   => " :attribute mora sadržavati :size items.",
	),
	"unique"               => " :attribute je već zauzeto.",
	"url"                  => " :attribute format nije ispravan.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(
		'attribute-name' => array(
			'rule-name' => 'custom-message',
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	|  following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
