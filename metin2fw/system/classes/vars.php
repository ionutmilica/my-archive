<?php

class Vars
{
    private static $_data = array();
    
    public static function get($name)
    {
        return isset(self::$_data[$name]) ? self::$_data[$name] : FALSE;
    }
    
    public static function set($name, $value)
    {
        return self::$_data[$name] = $value;
    }
}