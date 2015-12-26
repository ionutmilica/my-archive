<?php

check_login();

if ( ! defined('BASEPATH'))
{
    exit('Nu poti accesa acest fisier direct.');
}

set_title(site_name() . ' - Caracterele mele');

$data = $DB->query("SELECT * FROM ".PLAYER_DATABASE.".player WHERE account_id = '".$_SESSION['user_data']['id']."'");

$users = array();
$i = 0;

while ($row = $DB->fetch($data))
{    
    $users[$i]['id']    = $row['id'];
    $users[$i]['name']  = $row['name'];
    $users[$i]['level']  = $row['level'];
    $users[$i]['time']  = ($row['playtime'] > 0) ? duration($row['playtime'] * 60) : 'nedeterminat';
    $users[$i]['class'] = char_class($row['job']);    
    
    $i++;
}

$smarty->assign('users', $users);
assign('content_tpl', 'content/character');