<?php

    if ( ! defined('BASEPATH'))
    {
        die('Nu ai acces la un fisier de sistem.');
    }
    
    /**
     * In acest fisier inlocuim anumite metode cu simple functii pentru 
     * a fi mai usor de folosit mai departe. 
    **/
    
    function site_url()
    {
        return Config::init()->get('base_url');
    }
    
    function site_name()
    {
        return Config::init()->get('site_name');
    }
    
    function call($file, $ext = '.php', $path = null)
    {
        return call_file($file, $ext, $path);
    }
    
    function email($path = null) 
    { 
        if ($path == null)
        {
            $path = BASEPATH.'templates/emails/';
        }
        return new Email($path); 
    }