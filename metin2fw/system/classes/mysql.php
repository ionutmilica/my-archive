<?php

/**
 * Pentru a simplifica interogarile mysql putem folosi aceasta clasa
 * 
**/

class Mysql
{       
    public $_mysql_link = null;    
    private $_query_id = null;
    private $_is_connected = false;
    
    private $_query = array();
    
    private static $_instance = null;
    
    private static $_debug_level = 0;
    private static $_errors = array();
    
    private static $_query_count = 0;
    
    public static function init($server = null, $username = null, $password = null, $database = null, $is_permantent = false)
    {
        if (self::$_instance == null)
        {
            self::$_instance = new Mysql($server, $username, $password, $database, $is_permantent);
        }   
        return self::$_instance;         
    }
    
    public function __construct($server = null, $username = null, $password = null, $database = null, $is_permantent = false)
    {    
        $functs = array('mysql_connect', 'mysql_pconnect');
        
        $this->_mysql_link = $functs[(int) $is_permantent]($server, $username, $password);        
        
        if ($this->_mysql_link == false) 
        {
            self::add_error("conectare: Verificati datele introduse in mysql.");         
        }  
          
        if (($database_selected = mysql_select_db($database, $this->_mysql_link)) && $database_selected == true)
        {
            self::add_error("conectare: Baza de date $database nu a fost gasita.");
        }
        
        if ($database && $this->_mysql_link)
        {
            $this->_is_connected = true;   
        }                                 
    }
    
    public function __deconstruct()
    {   
        $this->disconnect();
    }
    
    public function query($command)
    {
        self::$_query_count++;
        
        $this->_query[] = $command;

        if (($query = mysql_query($command, $this->_mysql_link)) && $query != false)
        {
            $this->_query_id = $query;            
            return $query;
        }
                                        
        self::add_error("Query: ".mysql_error()."");
        return false;
    }
    
    public function fetch($link_id = -1, $mode = 'assoc')
    {
        $fetch_mode = array(
            'assoc' => 'mysql_fetch_assoc',
            'row'   => 'mysql_fetch_row',
            'array' => 'mysql_fetch_array'
        );
        
        if ( ! is_resource($link_id))
        {
            $link_id = $this->_query_id;
        }
        return $fetch_mode[$mode]($link_id);
    }
    
    public function select($cmd, $table, $condition = 1, $mode = 'assoc')
    {
        if (is_array($cmd))
        {
            $cmd = implode(',', $cmd);
        }
        return $this->fetch($this->query('SELECT '. $cmd . ' FROM '.$table .' WHERE '. $condition), $mode);
    }
    
    public function select_one($row, $table, $condition = 1, $mode = 'assoc')
    {
    	$data = $this->select($row, $table, $condition, $mode);
    	if ($mode == 'assoc')
    	{
    		return $data[$row];
    	}
    	return $data[0];
    }
    
    public function update($table, $data, $where = '1', $is_escaped = false)
    {
        $q = "UPDATE $table SET ";
        
        foreach ($data as $key => $val)
        {
            if (strtolower($val) == 'null')
            {
                $q .= "$key = NULL, ";
            }
            elseif (strtolower($val) == 'now()')
            {
                $q .= "$key = NOW(), ";
            }
            elseif (preg_match("/^increment\((\-?\d+)\)$/i", $val, $m))
            {
                $q .= "$key = $key + $m[1], ";
            }
            else
            {
                if ($is_escaped)
                {
                    $q .= "$key='" . self::escape($val) . "', ";
                }
                else
                {
                    $q .= "$key='" . $val . "', ";
                }
            }
        }            
        $q = rtrim($q, ', ') . ' WHERE ' . $where . ';';
        
        return $this->query($q);
    }    

    public function insert($table, $data, $is_escaped = false)
    {
        $query = "INSERT INTO $table ";
        $values = $names = '';
        $okN = false;    
        
        if (count($data) != count($data, COUNT_RECURSIVE))
        { 
            $q = array();        
            foreach ($data AS $key => $value)
            {    
                $values = '';
                foreach ($value as $subKey => $subValue)
                {        
                    if ( ! $okN) $n .= "$subKey, ";
                    
                    if (stripos($value, 'password(') !== FALSE)
                    {
                        $values .= "$value, ";
                    }
                    else
                    {                    
                        if ($is_escaped == false)
                        {
                            $values .= "'".self::escape($value)."', ";
                        }
                        else
                        {
                            $values .= "'".$value."', ";
                        }
                    }                    
                }
                $okN = true;
                $q[] = "(".rtrim($values, ', ').")";
            }
            $query .= "(".rtrim($names, ', ').") VALUES ".implode(', ', $q).';';
        }                    
        else
        {
            $q = $query;
            foreach ($data as $key => $value)
            {                
                $names .= "$key, ";
                if (stripos($value, 'password(') !== FALSE)
                {
                    $values .= "$value, ";
                }
                else
                {                    
                    if ($is_escaped == false)
                    {
                        $values .= "'".self::escape($value)."', ";
                    }
                    else
                    {
                        $values .= "'".$value."', ";
                    }
                } 
            }
            $query .= "(".rtrim($names, ', ').") VALUES (".rtrim($values, ', ').");";        
        }
        
        if ($this->query($query))
        {
            return $this->last_insert_id($this->_mysql_link);
        }
        return false;
    }
     
    public function set_names($format = 'utf8')
    {
        return $this->query('SET NAMES '.$format); 
    }
    
    public function last_insert_id($link_id = null)
    {
        if ( ! is_resource($link_id))
        {
            $link_id = $this->_mysql_link;
        }
        
        return mysql_insert_id($link_id);
    }
    
    public function free_result($result)
    {
        return mysql_free_result($result);
    }
    
    public function disconnect()
    {
        if ($this->_mysql_link)
        {
            mysql_close($this->_mysql_link);        
            $this->_mysql_link = null;
        }
        self::$instance = null;        
    }
    
    public function is_connected()
    {
        return ($this->_is_connected == true);
    }
    
    public static function error()
    {
        $html = '<table border="1">';
        $html.= '<tr>
            <td>#</td>
            <td>Message</td>
        </tr>'; 
        foreach (self::$_errors AS $key => $value)
        {
            $html .= "<tr><td>".($key + 1)."</td><td>$value</td></tr>";
        }
        $html .= '</table>';
        
        echo $html;
    }
    
    public static function escape(&$string)
    {
        // temporar
        if (is_array($string))
        {
            foreach ($string AS $key => $value)
            {
                $string[$key] = mysql_real_escape_string($value);
            }
            return $string;
        }
        return mysql_real_escape_string($string);
    }
    
    public static function add_error($error)
    {
        self::$_errors[] = $error;
    }
    
    public static function setDebug($level)
    {
        self::$debug_level = (int) $level;
    }
}