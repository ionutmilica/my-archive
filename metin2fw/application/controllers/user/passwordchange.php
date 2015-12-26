<?php


if ( ! defined('BASEPATH'))
{
    exit('Nu poti accesa acest fisier direct.');
}

set_title(site_name() . ' - Schimbare parola');

$DB = Mysql::init();

check_login();

$step = 'passwordchange_request';

if (isset($_POST['passwordchangerequest']))
{
    $data = $DB->select("id, login, email", ACCOUNT_DATABASE.".account", "`id`='".$_SESSION['user_data']['id']."'");
    
    if (is_array($data))
    {
        $token = sha1(microtime().$data['login'].rand(123151, 999999));
            
        $ok = $DB->query("UPDATE ".ACCOUNT_DATABASE.".account SET `passlost_token`='".$token."' WHERE `id`='".$data['id']."'");
            // trimitem email
        $arr = array(
            'login'     => $data['login'],
            'token'     => $token,
            'site_name' => site_name(),
            'site_url'  => site_url()
        );
            $email_ses = email()->load('passwordlost/password_token');
            $email_ses->assign($arr);
            $email_ses->set('noreply@'.rtrim(site_name(), '/'), '', $data['email'], 'Metin2 - Parola noua');
            $email_ses->send();
            $step = 'passwordchange_sent';        
    }
}

assign('content_tpl', 'content/passwordlost/'.$step);