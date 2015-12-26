<?php


if ( ! defined('BASEPATH'))
{
    exit('Nu poti accesa acest fisier direct.');
}

set_title(site_name() . ' - Stergere caractere');

$step = 'invalid';

$args = Vars::get('args');

$username = isset($args[0]) ? $DB->escape($args[0]) : '';
$token    = isset($args[1]) ? $DB->escape($args[1]) : '';

$data = $DB->select("id, login, email, social_id, socialid_token", ACCOUNT_DATABASE.".account", "`login`='".$username."' AND `socialid_token`='".$token."'");

if (is_array($data))
{
    $generated_code = generate_random_string(6);
    $smarty->assign('code', $generated_code);   

    $DB->query("UPDATE ".ACCOUNT_DATABASE.".account SET `social_id`='".$generated_code."', `socialid_token`='' WHERE `id`='".$data['id']."'");    
         
    $step = 'generate';    
}

assign('content_tpl', 'content/displaycode/'.$step);