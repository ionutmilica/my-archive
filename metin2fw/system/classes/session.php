<?php

class Session
{
    public static function start($name = null)
    {
        if ( ! isset($_SESSION))
        {
            session_start();            
        }
        if ($name != NULL)
        {
            session_name();
            session_name($name);
        }
    }
    
    public static function is_session_started()
    {
        return isset($_SESSION);
    }
    
    public static function stop()
    {
        session_write_close();
    }
    
    public static function destroy()
    {
        session_destroy();
    }
    
    public static function write($name, $data)
    {
        if (self::is_session_started())
        {
            return $_SESSION[$name] = $data;
        }
        return false;
    }
    
    public static function read($name)
    {
        if (isset($_SESSION[$name]))
        {
            return $_SESSION[$name];
        }
        return false;
    }
}