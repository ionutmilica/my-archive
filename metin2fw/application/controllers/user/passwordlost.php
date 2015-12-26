<?php


if ( ! defined('BASEPATH'))
{
    exit('Nu poti accesa acest fisier direct.');
}

set_title(site_name() . ' - Recuperare parola');

$step = 'step1';

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['captcha']))
{
    $username = $DB->escape($_POST['username']);
    $email = $DB->escape($_POST['email']);
    $captcha  = $_POST['captcha'];

    if (isset($_SESSION['security_code']) && ($captcha == $_SESSION['security_code']))
    {    
        $data = $DB->select("id", ACCOUNT_DATABASE.".account", "`login` LIKE '".$username."' AND `email` LIKE '".$email."'");
        if (is_array($data))
        {
            $token = sha1(microtime().$username.rand(123151, 999999));
            
            $ok = $DB->query("UPDATE ".ACCOUNT_DATABASE.".account SET `passlost_token`='".$token."' WHERE `id`='".$data['id']."'");
            // trimitem email
            $arr = array(
                'login'     => $username,
                'token'     => $token,
                'site_name' => site_name(),
                'site_url'  => site_url()
            );
            $email_ses = email()->load('passwordlost/password_token');
            $email_ses->assign($arr);
            $email_ses->set('noreply@'.rtrim(site_name(), '/'), '', $email, 'Metin2 - Parola noua');
            $email_ses->send();
            
            $step = 'step2';        
        }
    }    
}

$args = Vars::get('args');

if (isset($args[0]) && $args[0] == 'confirmation')
{
    $username = isset($args[1]) ? $args[1] : '';
    $token = isset($args[2]) ? $args[2] : 'invalid_token';
    
	if ($token == '')
	{
		$token = 'invalid_token';
	}
	
    $smarty->assign('username', $username);
    $smarty->assign('token', $token);
    
    $data = $DB->select("id, email", ACCOUNT_DATABASE.".account", "`login` LIKE '".$username."' AND `passlost_token` LIKE '".$token."'");
    if (is_array($data))
    {
        if (isset($_POST['newPassword']))
        {
            if (strlen($_POST['newPassword']) < 4 || strlen($_POST['newPassword']) > 16)
            {
                assign('invalid_password', true);
                $step = 'step3';
            }
            else
            {
                $password = $DB->escape($_POST['newPassword']);
                $ok = $DB->query("UPDATE ".ACCOUNT_DATABASE.".account SET `password`=PASSWORD('".$password."'), `passlost_token`=''  WHERE `id`='".$data['id']."'");
                
                if ($ok)
                {
                    $step = 'step4';    
                }
            }
        }
        else
        {
            $step = 'step3';
        }
    }
}

$smarty->assign('captcha', site_url().'captcha.php');

$smarty->assign('content_tpl', 'content/passwordlost/'.$step);

/*
if (isset($_SESSION['security_code']))
{
    unset($_SESSION['security_code']);
}*/