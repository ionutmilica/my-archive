<?php

if ( ! defined('BASEPATH'))
{
    exit('Nu poti accesa acest fisier direct.');
}

set_title(site_name() . ' - Logare');

$logged_in = false;
$login_failed = false;

if (isset($_SESSION['logged_in'])) $logged_in = true;

if ( !empty($_POST['username']) && !empty($_POST['password']))
{
    $DB = Mysql::init();       
    
    $username = $DB->escape($_POST['username']);
    $password = $DB->escape($_POST['password']);
    $captcha = isset($_POST['captcha']) ? $_POST['captcha'] : null;
    
    if (Session::read('login_attempts') > 3)
    {        
        if (isset($_SESSION['security_code']) && $_SESSION['security_code'] != $captcha)
        {
            $login_failed = true;
        }
    }    
    if ( ! $login_failed)
    {
        $data = $DB->select("*", ACCOUNT_DATABASE.".account", "login LIKE '".$username."' AND password LIKE PASSWORD('".$password."')");
        
        if (is_array($data))
        {    
            if ($data['status'] == 'BLOCK')
            {
                $smarty->assign('blocked_account', true);
                $smarty->assign('active', $data['active']);                    
            }
            else
            {
                $_SESSION['logged_in'] = true;
                $_SESSION['user_data'] = $data;
                
                $logged_in = true;
                Session::write('login_attempts', 0);
            }
        }
    }    
}

if ($logged_in)
{
    header('Location: '.site_url().'/main/index');
    exit;
}
else
{
    if (Session::read('login_attempts') > 3)
    {
        assign('captcha', site_url().'captcha.php');
    }
    
    if ($logged_in == false)
    {
        assign('login_error', true);
        
        if (isset($_SESSION['login_attempts']))
        {
            $_SESSION['login_attempts']++;
        }
        else
        {
            $_SESSION['login_attempts'] = 1;
        }
    }
    assign('content_tpl', 'content/login');
}