<?php

// Set to 2 for full debug report - useful when your emails aren't sent

$config['debug_level'] = false;

// if we won't use php native mail function
    
$config['email_use_smtp'] = true;

// your smtp info for sending mails

$config['smtp_host'] = 'smtp.gmail.com';
$config['smtp_port'] = 587;
$config['smtp_secure'] = 'tls';
$config['smtp_user'] = '*@gmail.com';
$config['smtp_password'] = '*';


/** Gmail config sample **/
/*
$config['smtp_host'] = 'smtp.gmail.com';
$config['smtp_port'] = 587;
$config['smtp_secure'] = 'tls';
$config['smtp_user'] = 'user@gmail.com';
$config['smtp_password'] = 'password';
 */