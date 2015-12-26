<?php

class Config 
{
    protected static $_instance = null;
    
    protected $_is_loaded = array();
    protected $_loaded_configs = array();
    protected $_data = array();
    
    public static function init()
    {
        if (self::$_instance == null)
        {
            self::$_instance = new Config;
        }
        return self::$_instance;
    }    
 

    public function __construct() 
    {
        $this->load('config');
        
 		if ($this->_data['base_url'] == '')
		{
			if (isset($_SERVER['HTTP_HOST']))
			{
				$base_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
				$base_url .= '://'. $_SERVER['HTTP_HOST'];
				$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
			}
			else
			{
				$base_url = 'http://localhost/';
			}

			$this->set('base_url', $base_url);
		}       
    } 
        
    public function load($file)
    {
        $file = ($file == '') ? 'config' : str_replace('.php', '', $file);
        
        if ($file == '')
        {
            return $this;
        }
        
        $file_path = CFGPATH . $file . '.php';

        if ( in_array($file_path, $this->_is_loaded))
            return $this;
        
        if ( ! file_exists($file_path))
        {
            return $this;
        }
        
        require $file_path;
        
        if ( ! isset($config))
        { 
            return $this;
        }
    
        $this->_data = array_merge($this->_data, $config);
        
        $this->_is_loaded[] = $file_path;
        
        $this->_loaded_configs[$file] = array_keys($config);       
        
        return $this;   
    }
    
    public function unload($file)
    {
        if (isset($this->_loaded_configs[$file]))
        {
            foreach ($this->_loaded_configs[$file] AS $value)
            {
                if (isset($this->_data[$value]))
                {
                    unset($this->_data[$value]);
                }
            }            
            
            unset($this->_loaded_configs[$file]);
            unset($this->_is_loaded[array_search(CFGPATH . $file . '.php', $this->_is_loaded)]);
        }

        return $this;
    }
    
    public function get($key)
    {
        if (isset($this->_data[$key]))
        {
            return $this->_data[$key];
        }
        return FALSE;
    }   
    
    public function set($key, $value)
    {
        return $this->_data[$key] = $value;
    }
    
    public function __get($key)
    {
        return $this->get($key);
    }
    
    public function __set($key, $value)
    {
        return $this->set($key, $value);
    }
}