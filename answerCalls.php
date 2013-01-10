<?php

    require_once 'plivo.php';

    $body = 'Hi, Are you available to receive your delivery today? Please enter 1 for yes and 2 for no.';
   
    $attributes = array (
        'loop' => 2,
    );
    $getdigitattributes = array (
	'action'=> 'http://' . $_SERVER["SERVER_NAME"] . '/digitsResponse.php',
    );

    $r = new Response();
    $g = $r->addGetDigits($getdigitattributes);
    $g->addSpeak($body,$attributes);
    $r->addSpeak("Input not recieved",array('language' => 'en-US', 'voice' => 'WOMAN'));
    echo($r->toXML());

?>