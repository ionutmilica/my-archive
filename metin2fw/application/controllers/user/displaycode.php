<?php


if ( ! defined('BASEPATH'))
{
    exit('Nu poti accesa acest fisier direct.');
}

set_title(site_name() . ' - Cod stergere caractere');

check_login();

$step = 'request';

$data = $DB->select("id, login, email, social_id, socialid_token, socialid_expire", ACCOUNT_DATABASE.".account", "`id`='".$_SESSION['user_data']['id']."'");

if ($data['socialid_expire'] != 0)
{
    $step = 'wait';
}
else
{
    if (isset($_POST['sendSocialcodeDisplayLink']))
    {
        if (is_array($data))
        {            
            $token  = sha1(microtime().$data['email'].rand(123151, 999999));
            $expire = time() + (24 * 60 * 60);
                
            $ok = $DB->query("UPDATE ".ACCOUNT_DATABASE.".account SET `socialid_token`='".$token."', `socialid_expire`='".$expire."' WHERE `id`='".$data['id']."'");
            if ($ok)
            {                        
                // trimitem email
                $arr = array(
                    'login'     => $data['login'],
                    'token'     => $token,
                    'site_name' => site_name(),
                    'site_url'  => site_url()
                );
                $email_ses = email()->load('displaycode/displaycode');
                $email_ses->assign($arr);
                $email_ses->set('noreply@'.rtrim(site_name(), '/'), '', $data['email'], 'Metin2 - Afiseaza codul');
                $email_ses->send();                
            }
        }
        $step = 'sent';            
    }
}
assign('content_tpl', 'content/displaycode/'.$step);