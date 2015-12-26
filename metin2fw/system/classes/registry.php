<?php

class Registry {

    private $_vars = array();

    protected static $_instance = null;
        
    public static function init() 
    {           
        if (self::$_instance == null)
        { 
            self::$_instance = new self(); 
        }
        return self::$_instance; 
    }     
            
    public function set($key, &$value)
    {
        return $this->_vars[$key] =& $value;
    }
    
    public function get($key)
    {
        if ($this->offsetExists($key))
        {
            return $this->_vars[$key];
        }
        return FALSE;
    }
    
    public function offsetExists($key)
    {
        return isset($this->_vars[$key]);
    }

    public function __set($key, $value) 
    {
        return $this->set($key, $value);
    }

    public function __get($key) 
    {
        return $this->get($key);
    }
}