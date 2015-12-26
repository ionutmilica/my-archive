<?php

class Singleton
{
    protected static $_instance = null;
        
    public static function init() 
    {           
        if (self::$_instance == null)
        { 
            self::$_instance = new self(); 
        }
        return self::$_instance; 
    }     
}