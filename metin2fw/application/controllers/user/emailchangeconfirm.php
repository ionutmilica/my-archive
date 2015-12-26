<?php


if ( ! defined('BASEPATH'))
{
    exit('Nu poti accesa acest fisier direct.');
}

set_title(site_name() . ' - Confirmare schimbare email');

if (isset($_SESSION['user_data']['email_token']) && $_SESSION['user_data']['email_token'] == '')
{
    assign('content_tpl', 'content/emailchange/confirmation_error');
    return;
}

$step = 'step1';

$args = Vars::get('args');

$username = isset($args[1]) ? $DB->escape($args[1]) : '';
$token    = isset($args[1]) ? $DB->escape($args[2]) : '';

$data = $DB->select("id, email, new_email, email_step", ACCOUNT_DATABASE.".account", "`login` LIKE '".$username."' AND `email_token` LIKE '".$token."'");

if (is_array($data))
{
    $args[0] = isset($args[0]) ? $args[0] : 'cancel';
    
    if ($args[0] == 'confirm' && $data['email_step'] == 2)
    {
        $ok = $DB->query("UPDATE ".ACCOUNT_DATABASE.".account SET `email`='".$data['new_email']."', `email_token`='', `email_expire`='', `new_email`='', `email_step`='0' WHERE `id`='".$data['id']."'");
        $step = 'confirmation_confirm';
    }
    elseif ($args[0] == 'accept' && $data['email_step'] == 1)
    {
        $token = sha1(microtime().$data['email'].rand(123151, 999999)); 
            
        $ok = $DB->query("UPDATE ".ACCOUNT_DATABASE.".account SET `email_token`='".$token."', `email_step`='2' WHERE `id`='".$data['id']."'");            
        if ($ok)
        {            
            $arr = array(
                'login'     => $username,
                'site_name' => site_name(),
                'site_url'  => site_url(),
                'token'     => $token
            );
            $email_ses = email()->load('emailchange/emailchange_accept');
            $email_ses->assign($arr);
            $email_ses->set('noreply@'.rtrim(site_name(), '/'), '', $data['new_email'], 'Schimbare de email');
            $email_ses->send();
                
            $step = 'step2';
        }                     
        $step = 'confirmation_accept';
    }
    else
    {        
        $ok = $DB->query("UPDATE ".ACCOUNT_DATABASE.".account SET `email_token`='', `new_email`='', `email_step`='0', `email_expire`='0' WHERE `id`='".$data['id']."'");
        $step = 'confirmation_cancel';
    }
}
else
{
    $step = 'confirmation_error';
}

assign('content_tpl', 'content/emailchange/'.$step);