<?php


if ( ! defined('BASEPATH'))
{
    exit('Nu poti accesa acest fisier direct.');
}

set_title(site_name() . ' - Confirmare cont');

$step = 'request';
$status = '';

if ( ! empty($_POST['username']) && ! empty($_POST['email']))
{
    $username = $DB->escape($_POST['username']);
    $email = $DB->escape($_POST['email']);
    
    $data = $DB->select("id", ACCOUNT_DATABASE.".account", "login LIKE '".$username."' AND `email`='".$email."' AND `status`='BLOCK' AND `active`='0'");
    
    $status = 'error';
    
    if (is_array($data))
    {
        $register_token = sha1(microtime().$username.rand(123151, 999999));
        
        $CFG->load('register');
        
        $arr = array(
            'register_token'         => $register_token,
            'register_expire'        => ($CFG->get('register_expire') + time())           
        );
        
        $CFG->unload('register');
                
        if ($DB->update(ACCOUNT_DATABASE.'.account', $arr, "login LIKE '".$username."'"))
        {
            $arr['login'] = $username;
            $arr['site_url'] = site_url();
            $arr['site_name'] = site_name();
            
            $email_ses = email()->load('resendaccount/resendaccount');
            $email_ses->assign($arr);
            $email_ses->set('noreply@'.rtrim(site_name(), '/'), '', $email, 'Metin2 - Confirmare cont');
            $email_ses->send();            
        }        
        $status = 'ok';                
    }
}

$smarty->assign('status', $status);

assign('content_tpl', 'content/resendaccount/'.$step);