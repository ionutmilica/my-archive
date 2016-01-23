<?php

class uvtClient extends cURL
{
	private $url = 'http://uvt.ro';
	private $data;
	public $header;

	public function __construct()
	{
		parent::__construct();
	}

	public function navigate($url = null)
	{
		return parent::navigate($this->url);
	}

	public function fetch()
	{
		return $this->data = $this->navigate();
	}

	public function getHTMLHead()
	{
		if (preg_match_all('#<head>(.*?)<\/head>#sm', $this->data, $out))
		{
			$this->header = $out[1][0];
		}
		
		$replace = array('src="/', 'href="/');
		$with    = array('src="'.$this->url.'/', 'href="'.$this->url.'/');

		$this->header = str_replace($replace, $with, $this->header);
		$this->header = preg_replace('#<script type="text/javascript">(.*?)</script>#ms', '', $this->header);

		return $this->header;
	}
}