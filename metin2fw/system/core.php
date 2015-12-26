<?php
    ! defined('BASEPATH') and die('Can\t acces this file.');
    
    // setam caile de acces catre system, fisierele de configuratie si module

    define('SYSPATH', BASEPATH . 'system'.DS);
    define('CFGPATH', APPPATH . 'config'.DS);
    define('MODPATH', BASEPATH . 'modules'.DS);
    define('PLUGINPATH', BASEPATH . 'plugins'.DS);
    
    require SYSPATH . 'autoload.php';
    
    // setam ca functia implicita sa fie metoda load din clasa Autoload
         
    spl_autoload_register(); 
    spl_autoload_register(array('Autoload', 'load'));
    
    // deschidem sesiunea
    
    Session::start('metin2fw');    
    
    // functii globale facute de utilizator (programator)
    
    require SYSPATH . 'functions.php';
    
    require SYSPATH . 'constants.php';
          
    //    
    $CFG = Config::init();
    $REG = Registry::init();

    // includem declararea bazei de date

    require SYSPATH . 'database.php';
    // wrapper pentru metodele claselor
    
    require SYSPATH . 'wrapper.php';    
            
    // Functii ce ne ajut sa lucram cu smarty
    
    require SYSPATH . 'smarty.php';
        
    // pre-config
    
    set_sitename($CFG->get('site_name'));
            
    $smarty->assign('keywords', $CFG->get('site_keywords'));
    $smarty->assign('site_description', $CFG->get('site_description'));  
    $smarty->assign('site_lang', $CFG->get('site_lang'));    
    $smarty->assign('base_href', site_url());
    $smarty->assign('banners', $CFG->get('banners'));
    
    date_default_timezone_set($CFG->get('default_timezone')); 