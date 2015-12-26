<?php


if ( ! defined('BASEPATH'))
{
    exit('Nu poti accesa acest fisier direct.');
}

$expire = $CFG->get('rank_regenerate');
$expire = 0;

if (Cache::is_cached('top_10_players', $expire))
{
    Vars::set('players_rank', Cache::get('top_10_players'));    
}
else
{
    $players = array();
    
    $sql = "SELECT player.id, player.name, player.level, player_index.empire 
                FROM ".PLAYER_DATABASE.".player 
                LEFT JOIN ".PLAYER_DATABASE.".player_index ON player_index.id=player.account_id 
                LEFT JOIN ".PLAYER_DATABASE.".guild_member ON guild_member.pid=player.id 
                INNER JOIN ".ACCOUNT_DATABASE.".account 
                ON account.id=player.account_id
                WHERE player.name NOT LIKE '[%]%' AND account.status!='BLOCK'
            ORDER BY player.level DESC, player.exp DESC LIMIT 10";
    $query = $DB->query($sql);
    
    while($row = $DB->fetch($query))
    {
        $players[] = $row;    
    }       
    Cache::set('top_10_players', $players);
    Vars::set('players_rank', $players);
}


if (Cache::is_cached('top_10_guilds', $expire))
{
    Vars::set('guilds_rank', Cache::get('top_10_guilds'));    
}
else
{
    $guilds = array();
    
    $sql = "SELECT 
        guild.name, guild.level, guild.win, guild.ladder_point, player_index.empire
        FROM ".PLAYER_DATABASE.".guild  
        LEFT JOIN ".PLAYER_DATABASE.".player ON guild.master = player.id 
        LEFT JOIN ".PLAYER_DATABASE.".player_index ON player_index.id = player.account_id 
        WHERE player.name NOT LIKE '[%]%' 
        ORDER BY guild.ladder_point DESC LIMIT 10";
        
    $query = $DB->query($sql);
    
    while($row = $DB->fetch($query))
    {
        $guilds[] = $row;    
    }       
    Cache::set('top_10_guilds', $guilds);
    Vars::set('guilds_rank', $guilds);
}