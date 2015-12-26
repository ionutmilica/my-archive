<?php


if ( ! defined('BASEPATH'))
{
    exit('Nu poti accesa acest fisier direct.');
}

set_title(site_name() . ' - Delogare');

Session::destroy();
Session::stop();

$smarty->assign('logged_in', false);
$smarty->assign('content_tpl', 'content/logout');