<?php


if ( ! defined('BASEPATH'))
{
    exit('Nu poti accesa acest fisier direct.');
}

set_title(site_name() . ' - Inregistrare');

$DB = Mysql::init();
$CFG->load('register');

$step = 'step1';

// Daca inregistrarile sunt dezactivate afisam eroarea

if ($CFG->get('active_register') == FALSE)
{
    $smarty->assign('register_closed_message', $CFG->get('register_closed_message'));
    $smarty->assign('register_page', 'step0');
    $smarty->assign('content_tpl', 'content/register');
    
    return;
}

// Daca este activata in fisierul de configurare printam captcha

if ($CFG->get('register_captcha') == TRUE)
{
    $smarty->assign('captcha', '');    
    $smarty->assign('captcha_path', site_url().'captcha.php');
}

// Daca este trimis formularul de inregistrare analizam datele

if (isset($_POST['username']) && isset($_POST['password']))
{
    $username = $DB->escape($_POST['username']);
    $password = $DB->escape($_POST['password']);
    $email = $DB->escape($_POST['email']);
    
    $errors = array();
    
    $data = $DB->select("id", ACCOUNT_DATABASE.".account", "login LIKE '".$username."'");
    if (is_array($data))
    {
        $errors['username_exists'] = true;
    }
    
    if ( ! preg_match('/^[a-zA-Z0-9]{4,16}$/', $username, $match))
    {
        $errors['invalid_username'] = true;
    }
    
    if (strlen($password) < 4 || strlen($password) > 16)
    {
        $errors['invalid_password'] = true;
    }
    
    if ( ! filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $errors['invalid_email'] = true;
    }
    
    if ($CFG->load('register_captcha') == TRUE && ($_POST['captcha'] != $_SESSION['security_code']))
    {
        $errors['invalid_captcha'] = true;
    }
    
    unset($_SESSION['security_code']);
    
    if (count($errors) == 0)
    {
        $account_status = ($CFG->get('email_activation') == TRUE) ? 'BLOCK' : 'OK';
        $register_token = sha1(microtime().$username.rand(123151, 999999));
        
        $arr = array(
            'id'                     => 'NULL',
            'login'                  => $username,
            'password'               => 'PASSWORD("'.$password.'")',
            'email'                  => $email,
            'create_time'            => date('Y-m-d H:i:s'),
            'status'                 => $account_status,
            'gold_expire'            => date('Y-m-d H:i:s', $CFG->get('gold_expire') + time()),
            'silver_expire'          => date('Y-m-d H:i:s', $CFG->get('silver_expire') + time()),
            'safebox_expire'         => date('Y-m-d H:i:s', $CFG->get('safebox_expire') + time()),
            'autoloot_expire'        => date('Y-m-d H:i:s', $CFG->get('autoloot_expire') + time()),
            'fish_mind_expire'       => date('Y-m-d H:i:s', $CFG->get('fish_mind_expire') + time()),
            'marriage_fast_expire'   => date('Y-m-d H:i:s', $CFG->get('marriage_fast_expire') + time()),
            'money_drop_rate_expire' => date('Y-m-d H:i:s', $CFG->get('money_drop_rate_expire') + time()),
            'coins'                  => $CFG->get('register_coins'), // @TODO: pentru installer
            'jd'                     => $CFG->get('register_jd'),   // @TODO: pentru installer
            'register_token'         => $register_token, // @TODO: pentru installer
            'register_expire'        => ($CFG->get('register_expire') + time()), // @TODO: pentru installer           
        );
        
        // inregistram contul

        if ($DB->insert(ACCOUNT_DATABASE.'.account', $arr, true))
        {
            $arr['site_url'] = site_url();
            $arr['site_name'] = site_name();
            $arr['password'] = $password;
            
            if ($CFG->get('email_activation') == TRUE)
            {
                $email_ses = email()->load('register/confirm_account_1');
                $email_ses->assign($arr);
                $email_ses->set('noreply@'.rtrim(site_name(), '/'), '', $email, 'Metin2 - Confirmare email');                
            }
            else
            {                
                $email_ses = email()->load('register/confirm_account_2');
                $email_ses->assign($arr);
                $email_ses->set('noreply@'.rtrim(site_name(), '/'), '', $email, 'Metin2 - Bun venit!');
            }
            $email_ses->send();
        }
        else
        {
            exit(sprintf("Can't insert into mysql database!"));
        }                    
                
        $step = 'step2';
    }
    else
    {
        $step = 'step1';
        $smarty->assign('register_errors', $errors);    
    }   
} 
// Cand utilizatorul doreste sa confirme contul creat

$args = Vars::get('args');

if (isset($args[0]) && $args[0] == 'confirmation')
{
    $username = isset($args[1]) ? $args[1] : '';
    $token = isset($args[2]) ? $args[2] : '';

    $data = $DB->select("id, email", ACCOUNT_DATABASE.".account", "`login` LIKE '".$username."' AND `register_token` LIKE '".$token."'");

    if (is_array($data))
    {
        $ok = $DB->query("UPDATE ".ACCOUNT_DATABASE.".account SET `status`='OK', `register_token`='', `register_expire`='0' WHERE `id`='".$data['id']."'");
        if ($ok == TRUE)
        {
            $arr = array(
                'login'     => $username,
                'site_name' => site_name(),
                'site_url'  => site_url()
            );
            $email_ses = email()->load('register/confirm_account_3');
            $email_ses->assign($arr);
            $email_ses->set('noreply@'.rtrim(site_name(), '/'), '', $data['email'], 'Metin2 - Bun venit!');
            $email_ses->send();
        }        
    }    
    else
    {
        $smarty->assign('confirmation_error', true);
    }
    $step = 'step3';        
}

$smarty->assign('register_page', $step);
$smarty->assign('content_tpl', 'content/register');

// curatam captcha

if (isset($_SESSION['security_code']))
{
    unset($_SESSION['security_code']);
}