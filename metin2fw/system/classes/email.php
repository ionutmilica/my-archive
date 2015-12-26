<?php

class Email {
    
    protected $content = NULL;
    protected $from = NULL;
    protected $to = NULL;
    protected $subject = NULL;
    
    protected $templatePath;
    protected $config;
    protected $mailer;
    
    public function __construct($path = null)
    {
        $this->config =& Config::init()->load('email');
        $this->templatePath = $path;
        $this->initMailer();
    }
    
    public function __destruct()
    {
        $this->config->unload('email');
    }
    
    // In the next version
    
    public static function factory($path)
    {
        return new Email($path);
    }
    
    protected function check_init()
    {
        if ($this->from == NULL) return FALSE;
        if ($this->from_name == '') $this->from_name = $this->from;
        if ($this->to == NULL) return FALSE;
        if ($this->subject == NULL) return FALSE;
        RETURN TRUE;
    }
    public function set($from, $from_name, $to, $subject)
    {
        $this->from = $from;
        $this->from_name = $from_name;
        $this->to = $to;
        $this->subject = $subject;
    }
    
    public function load($templateName)
    {
        if (is_file($file = $this->templatePath.$templateName.'.tpl'))
        {
            $this->content = file_get_contents($file);
        }        
        return $this;
    }
    public function assign($name, $value = '')
    {
        if (is_array($name))
        {
            foreach ($name AS $key => $value)
            {
                $this->content = preg_replace('#\{'.$key.'\}#i', $value, $this->content);
            } 
        }
        else 
        {
            $this->content = preg_replace('#\{'.$name.'\}#i', $value, $this->content);
        }
        return $this;
    }
    
    protected function isGMail()
    {
        $host = $this->config->get('smtp_host');
        
        return (stripos($host, 'google') !== FALSE) || 
               (stripos($host, 'gmail') !== FALSE);
    }
    
    protected function initMailer()
    {
        $this->mailer = new PHPMailer();
        $this->mailer->SMTPDebug  = $this->config->get('debug_level');
        $this->mailer->Debugoutput = 'html';
        
        if ($this->config->get('email_use_smtp') || $this->isGMail())
        {
            $this->mailer->IsSMTP();
            $this->mailer->SMTPAuth = true; 
            $this->mailer->SMTPSecure = $this->config->get('smtp_secure');
            $this->mailer->Port = $this->config->get('smtp_port');
            $this->mailer->Host = $this->config->get('smtp_host');
            $this->mailer->Username = $this->config->get('smtp_user');  
            $this->mailer->Password = $this->config->get('smtp_password');               
   	}
        $this->mailer->isHtml(true);
    }
    
    public function send()
    {
        if ( ! $this->check_init())
        { 
            return false;
        }

        $this->mailer->AddReplyTo($this->from, $this->from); 
        $this->mailer->From = $this->from;
        $this->mailer->FromName = $this->from_name; 
        $this->mailer->Subject = $this->subject;
        $this->mailer->MsgHTML($this->content);
        $this->mailer->AddAddress($this->to);

        return $this->mailer->Send();
    }
}
?>