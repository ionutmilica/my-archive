<?php

class Autoload
{
    public static function load($class_name)
    {
        $path = DS.str_replace('_', DIRECTORY_SEPARATOR, strtolower($class_name)).'.php';
        
        if (is_file(SYSPATH.'classes'.$path))
        {
            require SYSPATH.'classes'.$path;
            return true;    
        }
        throw new Exception("Can't find the class $class_name.");
    }
}