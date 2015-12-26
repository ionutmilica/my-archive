<?php

require SYSPATH . 'smarty' . DS. 'Smarty.class.php';

$smarty = new Smarty;

Registry::init()->set('smarty', $smarty);

$tpl = $CFG->get('template');
$tpl_dir = 'frontend';

if (defined('_ADMIN'))
{
    $tpl = 'admin';
    $tpl_dir = 'backend';
}

$smarty->setTemplateDir(BASEPATH . 'templates' . DS . $tpl_dir . DS . $tpl);
$smarty->setCompileDir(APPPATH . 'storage/smarty/' . DS . $tpl_dir);
$smarty->setCacheDir(BASEPATH . 'storage/smarty/cache');
$smarty->setConfigDir(BASEPATH . 'templates' . DS . $tpl_dir . DS . $tpl . DS . 'config');
$smarty->use_sub_dirs = true;
$smarty->assign('relative',   site_url());
$smarty->assign('relative_tpl', site_url() . 'templates/' . $tpl_dir .'/'. $tpl . '/');

define('TPL_PATH', BASEPATH . 'templates' . DS . $tpl_dir . DS . $tpl . DS);
// smarty wrapper

function assign($key, $value)
{
    return Registry::init()->smarty->assign($key, $value);
}

function set_title($string, $key = 'page_title')
{
    return assign($key, $string);    
}
function set_sitename($string, $key = 'site_name')
{
    return assign($key, $string);
}