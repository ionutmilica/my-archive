<?php

/**
 * Setari pentru inregistrare
 * 
**/

// day = o zi exprimata in secunde

$day = 60 * 60 * 24;

$config['active_register'] = TRUE;

$config['register_closed_message'] = 'Momentan, numarul de conturi depaseste limita suportata de serverul nostru.';

$config['email_activation'] = true;

$config['register_captcha'] = true;

$config['register_coins'] = 0;

$config['register_jd'] = 0;

$config['register_expire'] = $day * 5;

$config['gold_expire'] = $day * 365;

$config['silver_expire'] = $day * 365;

$config['safebox_expire'] = $day * 365;

$config['autoloot_expire'] = $day * 365;

$config['fish_mind_expire'] = $day * 365;

$config['marriage_fast_expire'] = $day * 365;

$config['money_drop_rate_expire'] = $day * 365;
