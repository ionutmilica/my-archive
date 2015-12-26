<?php
error_reporting(E_ALL);
/**
 * @todo: Replace this code with a proper router
**/

define('DS', DIRECTORY_SEPARATOR);
define('BASEPATH', realpath(dirname(__FILE__)) . DS);
define('APPPATH', BASEPATH . 'application' . DS);

require BASEPATH . 'system' . DS . 'core.php';

define('LOGGED_IN', is_logged_in());
$smarty->assign('logged_in', LOGGED_IN);

if (isset($_SESSION['user_data']['id']))
   $smarty->assign('user_id', $_SESSION['user_data']['id']); 
else
    $smarty->assign('user_id', 0);

/* ----- Use a router insted ----- */

$query    = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
$req_uri  = isset($_SERVER['REQUEST_URI'])  ? $_SERVER['REQUEST_URI']  : '';

$request = str_replace($CFG->get('relative_path'), '', $req_uri);
$request = str_replace('?' .$query, '', $request);
$url_parts = explode('/', trim($request, '/'));
$url_parts[0] = (isset($url_parts[0]) && $url_parts[0] != '') ? $url_parts[0] : '';
$url_parts = str_replace('..', '', $url_parts);

/* ---------- */

$file = plugin($url_parts);

Vars::set('args', $url_parts);
Vars::set('plain_args', implode('/', $url_parts)); 

require $file;

require BASEPATH.'getRank.php';

$smarty->assign('players_rank', Vars::get('players_rank'));
$smarty->assign('guilds_rank', Vars::get('guilds_rank'));
$smarty->display('main.tpl');
