<?php

class Vect
{
    public $vect = array();
    
    public function __construct()
    {
        for ($i = 0; $i < 45; $i++)
        {
            $this->vect[$i] = 0;
        }
    }
    
    public function add($pos, $size)
    {
        if ($this->can_add($pos, $size))
        {
            for ($i = 0; $i < $size; $i++)
            {                
                $this->vect[$pos + (5 * $i)] = 1;
            }
            return true;
        }                       
        return false;
    }
    
    public function is_valid($size)
    {
        foreach ($this->vect AS $key => $value)
        {
            if ($this->can_add($key, $size))
            {
                return $key;
            }                        
        }
        return false;    
    }
    
    public function __toString()
    {
        $string = '';
        foreach ($this->vect AS $key => $v)
        {
            $string .= $v.' ';
            if (($key + 1) % 5 == 0)
            {
                $string .= '<br/>';
            } 
        }
        return $string;
    }
    
    private function can_add($pos, $size)
    {
        if ($this->vect[$pos] == 0)
        {   
            for ($i = 0; $i < $size; $i++)
            {
                if ( ! isset($this->vect[$pos + (5 * $i)]) || $this->vect[$pos + (5 * $i)] != 0)
                {
                    return false;
                }
            }
            return true;
        }
        return false;        
    }
}
