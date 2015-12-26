<?php


if ( ! defined('BASEPATH'))
{
    exit('Nu poti accesa acest fisier direct.');
}

set_title(site_name() . ' - Parola depozit');

$DB = Mysql::init();

check_login();

$step = 'request';

if (isset($_POST['sendStoragePassword']))
{
    $data = $DB->select("id, login, email", ACCOUNT_DATABASE.".account", "`id`='".$_SESSION['user_data']['id']."'");

    if (is_array($data))
    {
        $storage_pass = $DB->select('password', PLAYER_DATABASE.'.safebox', "`account_id`='".$_SESSION['user_data']['id']."'");

        if ($storage_pass == '')
        {
            $step = 'error';
        }
        else
        {
            // trimitem email
            $arr = array(
                'login'     => $data['login'],
                'password'  => $storage_pass['password'],
                'site_name' => site_name(),
                'site_url'  => site_url()
            );
            
            $email_ses = email()->load('passwordlost/storagepassword');
            $email_ses->assign($arr);
            $email_ses->set('noreply@'.rtrim(site_name(), '/'), '', $data['email'], 'Metin2 - Parola Depozit');
            $email_ses->send();                
            $step = 'sent';
        }        
    }
}

assign('content_tpl', 'content/storagepassword/'.$step);