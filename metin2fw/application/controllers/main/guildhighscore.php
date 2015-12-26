<?php

/**
 * @todo Un update major pentru clasament
 * @info Acesta functioneaza de minune, dar trebuie simplificat algoritmul          
**/


if ( ! defined('BASEPATH'))
{
    exit('Nu poti accesa acest fisier direct.');
}

set_title(site_name() . ' - Clasament bresle');

$players = array();

$where = '';

$plain_args = Vars::get('plain_args');

$page = 1;
if (preg_match('/page-([0-9]+)/i', $plain_args, $match))
{
    $page = ((int)$match[1] > 0) ? $match[1] : 1;
}

$name = '';
if (preg_match('/name-([a-zA-Z|\[\]]+)/i', $plain_args, $match))
{
    $name = isset($match[1]) ? $DB->escape($match[1]) : '';
}

$empire = -1;
if (preg_match('/empire-(-?[0-9]+)/i', $plain_args, $match))
{
    $empire = ((int)$match[1] > -1) ? $match[1] : -1;
}

if (isset($_POST['empirechoice']) || isset($_POST['guildchoice']) || ($name != ''))
{
    $name = isset($_POST['guildchoice']) ? $_POST['guildchoice'] : $name;
    if ($name != '')
    {
        $where = "WHERE name LIKE '%".$DB->escape($name)."%'";
    }
    $empire = isset($_POST['empirechoice']) ? $_POST['empirechoice'] : $empire;
    if ($empire > 0 && $empire < 4)
    {
        if ($where != '') $where .= ' AND '; else $where .= ' WHERE ';
        $where .= "empire IN (".$empire.")";    
    } 
}    

$sql = "SELECT COUNT(id)
        FROM (
            SELECT id, name, level, win, ladder_point, master, empire, @num := @num +1 AS rang
            FROM (
                SELECT player.id, guild.name, guild.level, guild.win, guild.ladder_point, guild.master, player_index.empire, @num :=0
                FROM ".PLAYER_DATABASE.".guild
                LEFT JOIN ".PLAYER_DATABASE.".player ON guild.master = player.id
                LEFT JOIN ".PLAYER_DATABASE.".player_index ON player_index.id = player.account_id
                WHERE player.name NOT LIKE '[%]%'
                ORDER BY guild.ladder_point DESC , guild.level DESC 
            ) AS t1
        ) AS t2
        $where";  

$items = $DB->fetch($DB->query($sql), 'row');

$per_page = 10;                  
$pages = ceil($items[0] / $per_page);         
$limit_start = ($page - 1) * $per_page;
$limit_end   = $per_page;            
    
$guilds = array();
    
$sql = "SELECT id, name, level, win, ladder_point, master, empire, rang
        FROM (
            SELECT id, name, level, win, ladder_point, master, empire, @num := @num +1 AS rang
            FROM (
                SELECT player.id, guild.name, guild.level, guild.win, guild.ladder_point, guild.master, player_index.empire, @num :=0
                FROM ".PLAYER_DATABASE.".guild
                LEFT JOIN ".PLAYER_DATABASE.".player ON guild.master = player.id
                LEFT JOIN ".PLAYER_DATABASE.".player_index ON player_index.id = player.account_id
                WHERE player.name NOT LIKE '[%]%'
                ORDER BY guild.ladder_point DESC , guild.level DESC 
            ) AS t1
        ) AS t2
        $where LIMIT $limit_start, $limit_end";     
  
$query = $DB->query($sql);

$i = 0;    
while($row = $DB->fetch($query))
{
    $master_name = $DB->select('name', ''.PLAYER_DATABASE.'.player', "`id`='".$row['master']."'");
    $guilds[$i] = $row;
    $guilds[$i]['master'] = $master_name['name'];
    $i++;    
}      

#var_dump($guilds);

$smarty->assign('guilds', $guilds);
$smarty->assign('empire', $empire);
$smarty->assign('name', $name);
$smarty->assign('page', $page);
$smarty->assign('pages', $pages);

assign('content_tpl', 'content/highscore/guilds');