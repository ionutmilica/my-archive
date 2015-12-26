<?php

    /**
     * Functii de baza ce ne vor servi in diverse scopuri.
     * A se defini aici functiile care se doresc a fi globale.
     * ex: function img($src, $alt = '.') { return "<img src='$src' alt='$alt'"/>"; }    
    **/

    function call_file($file, $ext = '.php', $path = NULL)
    {
        $paths = array(BASEPATH, PLUGINPATH, SYSPATH, CFGPATH);
        
        if ($path != NULL)
        {
            $paths = $path;
        }
        
        foreach ($paths AS $path)
        {
            if (is_file($path.$file.$ext))
            {
                require $path.$file.$ext;
            }
        }
        return FALSE;        
    }
    
    function plugin(&$url_parts)
    {
        $CFG = Config::init();
        
        if (isset($url_parts[0]) && isset($url_parts[1]))
        {
            $file_path = $url_parts[0] . DS . $url_parts[1].'.php';
            
            if (is_file($file = TPL_PATH .'application/controllers' . DS . $file_path))
            {
                $url_parts = array_slice($url_parts, 2);
                return $file;                                
            }
            if (is_file($file = APPPATH.'controllers/'. $file_path))
            { 
                $url_parts = array_slice($url_parts, 2);        
                return $file;                
            }
        }
            
        if (isset($url_parts[0]))
        {
            $file_path = $url_parts[0].'.php';
            
            if (is_file($file = TPL_PATH .'application/controllers' . DS . $file_path))
            {
                $url_parts = array_slice($url_parts, 1);
                return $file;                                
            }             
            if (is_file($file = APPPATH .'controllers/'. $file_path))
            {
                $url_parts = array_slice($url_parts, 1);
                return $file;                
            }        
        }
            
        $file_path  = (($CFG->get('default_controller') == '') ? '' : $CFG->get('default_controller') . DS) . $CFG->get('default_action') . '.php';

        if (is_file($file = TPL_PATH . 'application/controllers' . DS . $file_path))
        {
            return $file;
        }

        return APPPATH . 'controllers/'.$file_path;                   
    }
    
    function generate_random_string($size, $string = '')
    {        
        $chars = array_merge(range('a', 'z'), range('A', 'Z'), range(1, 9));
        $chars_size = count($chars);
        
        $i = 0;
        while($i < $size)
        {
            $char = $chars[mt_rand(0, $chars_size - 1)];
            $string .= $char;   
            $i++;
        }
        
        return $string;        
    }
    
    function is_logged_in()
    {
        if (isset($_SESSION['logged_in']))
        {            
            $DB = Mysql::init();        
            
            $data = $DB->select('*', ACCOUNT_DATABASE.'.account', "id='".$_SESSION['user_data']['id']."'");
    
            clear_site();

            if (is_array($data))
            {
                assign('user_data', $data);
                Session::write('user_data', $data);                 
                return true;    
            }
        }        
        return false;
    }
    
    function is_admin()
    {
        if (isset($_SESSION['user_data']['user_level']) && $_SESSION['user_data']['user_level'] > 0)
        {
            return true;
        }
        return false;
    }
    
    function check_login()
    {
        /**
         * @todo : update 
        **/        
        
        if ( ! defined('LOGGED_IN') || LOGGED_IN == FALSE)
        {
            header('Location: '.site_url().'');
            exit;
        }        
    }
    
    function clear_site()
    {
        require SYSPATH . 'clear_site.php';
        return;            
    }
    
    // aflam clasa caracterelor
    
    function char_class($id)
    {
        /**
         * @todo : un update pentru aceasta functie 
        **/
        
        $arr = array(
            array(
                'name' => 'Razboinic',
                'img'  => 'warrior0.png'
            ),
            array(
                'name' => 'Ninja',
                'img'  => 'ninja0.png'
            ),
            array(
                'name' => 'Sura',
                'img'  => 'sura0.png'
            ),
            array(
                'name' => 'Saman',
                'img'  => 'shaman0.png'
            ),
             
            array(
                'name' => 'Razboinica',
                'img'  => 'warrior1.png'
            ),
            array(
                'name' => 'Ninja',
                'img'  => 'ninja1.png'
            ),
            array(
                'name' => 'Sura',
                'img'  => 'sura1.png'
            ),
            array(
                'name' => 'Saman',
                'img'  => 'shaman1.png'
            )             
        );
        return $arr[$id];
    }
    
    function duration($seconds)
    {
        $seconds = (int) $seconds;
        $ret = "";

        $days = (int) ($seconds / (3600 * 24));
        if($days > 0)
        {
            $num = ($days == 1) ? '' : 'le';
            $ret .= "$days zi$num ";
        }
    
        $hours = (int) ($seconds / 3600) % 24;
        if($hours > 0)
        {
            $num = ($hours == 1) ? 'a' : 'e';
            $ret .= "$hours or$num ";
        }
        
        $minutes = $seconds / 60 % 60;
        
        if($hours > 0 || $minutes > 0)
        {
            $num = ($minutes == 1) ? '' : 'e';
            $ret .= "$minutes minut$num ";
        }
        return $ret;
    }    
    
    
    function set_log($message, $type)
    {
    	$DB = Mysql::init();
    	 
    	$data = array(
    			'id' 	  => null,
    			'type'	  => $type,
    			'user_id' => isset($_SESSION['user_data']['id']) ? $_SESSION['user_data']['id'] : 0,
    			'message' => $DB->escape($message),
    			'date'	  => date('Y-m-d H:i:s')
    	);
    	 
    	return $DB->insert(ACCOUNT_DATABASE.'.site_logs', $data);
    }
    
    function hide($text)
    {
        $parts = explode('@', $text);
        $length = strlen($parts[0]);    
        
        if ($length < 3)
        {
            $parts[0] = '***';
        }
        else
        {
            for ($i = 0; $i < $length; $i++)
            {
                if ($i != 0 && $i != $length - 1)
                {
                    $parts[0][$i] = '*';
                }
            }
        }
        return implode('@', $parts);       
    }    
