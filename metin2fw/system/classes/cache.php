<?php

class Cache
{   
    
    public static function set($cache_name, $data = array())
    {
        $cache_path = APPPATH . 'storage/cache/'. $cache_name . '.cache';
        
        file_put_contents($cache_path, serialize($data));
    }
    
    public static function get($cache_name)
    {
        $cache_path =  APPPATH . 'storage/cache/'. $cache_name . '.cache';
        
        return unserialize(@file_get_contents($cache_path));        
    }
    
    public static function is_cached($cache_name, $expire_time)
    {        
        $cache_path =  APPPATH . 'storage/cache/'. $cache_name . '.cache';
        
        $time = 0;
        
        if (is_file($cache_path))
        {
            $time = filemtime($cache_path);
        }     

        return (bool) (($time + $expire_time) > time());
    } 
}