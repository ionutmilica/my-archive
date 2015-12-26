<?php

/**
 * @todo Un update major pentru clasament
 * @info Acesta functioneaza de minune, dar trebuie simplificat algoritmul          
**/


if ( ! defined('BASEPATH'))
{
    exit('Nu poti accesa acest fisier direct.');
}

set_title(site_name() . ' - Clasament jucatori');


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

$class = -1;
if (preg_match('/class-(-?[0-9]+)/i', $plain_args, $match))
{
    $class = ((int)$match[1] > -1) ? $match[1] : -1;
}

if (isset($_POST['classchoice']) || isset($_POST['characterchoice']) || ($name != ''))
{
    $name = isset($_POST['characterchoice']) ? $_POST['characterchoice'] : $name;
    if ($name != '')
    {
        $where = "WHERE name LIKE '%".$DB->escape($name)."%'";
    }
    $class = isset($_POST['classchoice']) ? $_POST['classchoice'] : $class;
    if ($class > -1 && $class < 4)
    {
        $arr = array(
                0 => '0,4',
                1 => '1,5',
                2 => '2,6',
                3 => '3,7',
            );
        if ($where != '') $where .= ' AND '; else $where .= ' WHERE ';
        if ($class > -1)
        {
            $where .= "job IN (".$arr[$class].")";
        }    
    } 
}    

$sql = "SELECT COUNT(id)
        FROM ( 
            SELECT id, name, level, exp, empire, job, @num := @num +1 AS rang
            FROM ( 
                SELECT player.id, player.name, player.level, player.exp, player_index.empire, player.job, @num :=0
                FROM ".PLAYER_DATABASE.".player
                LEFT JOIN ".PLAYER_DATABASE.".player_index ON player_index.id = player.account_id
                INNER JOIN ".ACCOUNT_DATABASE.".account ON account.id=player.account_id
                WHERE player.name NOT LIKE '[%]%' AND account.status!='BLOCK'
                ORDER BY player.level DESC , player.exp DESC 
            ) AS t1 
        ) AS t2 
        $where";  

$items = $DB->fetch($DB->query($sql), 'row');

$per_page = 10;                  
$pages = ceil($items[0] / $per_page);         
$limit_start = ($page - 1) * $per_page;
$limit_end   = $per_page;            
    

    
$sql = "SELECT id, name, level, exp, empire, job, rang
        FROM ( 
            SELECT id, name, level, exp, empire, job, @num := @num +1 AS rang
            FROM ( 
                SELECT player.id, player.name, player.level, player.exp, player_index.empire, player.job, @num :=0
                FROM ".PLAYER_DATABASE.".player
                LEFT JOIN ".PLAYER_DATABASE.".player_index ON player_index.id = player.account_id
                INNER JOIN ".ACCOUNT_DATABASE.".account ON account.id=player.account_id
                WHERE player.name NOT LIKE '[%]%' AND account.status!='BLOCK'
                ORDER BY player.level DESC , player.exp DESC 
            ) AS t1 
        ) AS t2 
        $where LIMIT $limit_start, $limit_end";     
  
$query = $DB->query($sql);
    
while($row = $DB->fetch($query))
{
    $players[] = $row;    
}      

$smarty->assign('users', $players);
$smarty->assign('class', $class);
$smarty->assign('name', $name);
$smarty->assign('page', $page);
$smarty->assign('pages', $pages);

assign('content_tpl', 'content/highscore/players');