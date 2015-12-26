<?php


if ( ! defined('BASEPATH'))
{
    exit('Nu poti accesa acest fisier direct.');
}

set_title(site_name() . ' - Schimbare email');

check_login();

if (isset($_SESSION['user_data']['email_token']) && $_SESSION['user_data']['email_token'] != '')
{
    assign('content_tpl', 'content/emailchange/error');
    return;
}

$step = 'step1';

if (isset($_POST['oldEmail']) && isset($_POST['newEmail']))
{
    $id = isset($_SESSION['user_data']['id']) ? $_SESSION['user_data']['id'] : 0;
    $data = $DB->select("id,login,email,email_token", ACCOUNT_DATABASE.".account", "`id`='".$id."'");
    
    $old_email = $_POST['oldEmail'];
    $new_email = $DB->escape($_POST['newEmail']);
    
    
    if (is_array($data))
    {
        if ($data['email'] != $old_email)
        {
            $error = 'Emailul vechi nu coincide cu cel din baza de date.';
            $smarty->assign('error', $error);
        }
        elseif ($data['email'] == $new_email)
        {
            $error = 'Cele doua email-uri nu trebuie sa coinicida.';
            $smarty->assign('error', $error);
        }
        elseif ( ! filter_var($new_email, FILTER_VALIDATE_EMAIL))
        {
            $error = 'Noul email nu este valid.';
            $smarty->assign('error', $error);
        }
        else
        {
            $token = sha1(microtime().$data['email'].rand(123151, 999999));
            $email_expire = time() + (3 * 24 * 60 * 60); 
            
            $ok = $DB->query("UPDATE ".ACCOUNT_DATABASE.".account SET `email_token`='".$token."', `new_email`='".$new_email."', `email_expire`='".$email_expire."', `email_step`='1' WHERE `id`='".$data['id']."'");            
            if ($ok)
            {            
                $arr = array(
                    'login'     => $data['login'],
                    'site_name' => site_name(),
                    'site_url'  => site_url(),
                    'token'     => $token
                );
                $email_ses = email()->load('emailchange/emailchange');
                $email_ses->assign($arr);
                $email_ses->set('noreply@'.rtrim(site_name(), '/'), '', $data['email'], 'Schimbare de email');
                $email_ses->send();
                
                $step = 'step2';
            }            
        }        
    }
}

assign('content_tpl', 'content/emailchange/'.$step);