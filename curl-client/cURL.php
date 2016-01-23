<?php

class cURL
{
	/**
	 * Holds the curl client resource
	 * @var CURL RESOURCE
	 */
	protected $res;


	/**
	 * Holds the stack with curl options
	 * @var mixed array
	 */
	protected $options = array();

	protected $postfields = array();
	protected $getfields  = array();


	public function __construct($url = null)
	{
		if ( ! empty($url))
		{
			$this->addOption('URL', $url);
		}

		$this->reset();
	}

	/**
	 * Setter for curl pre-request settings.
	 * @param array/int $option
	 * @param mixed $value
	 */
	public function setOption($option, $value = null)
	{
		if ( ! is_array($option))
		{
			$option = is_long($option) ? $option : constant($option);
			curl_setopt($this->res, $option, $value);
		}
		else
		{
			foreach ($option as $key => $opt)
			{
				$this->setOption($key, $opt);
			}
		}
	}

	/**
	 * Acts like setOption but it sets the option
	 * to the stack and waits the navigate/exec function execute
	 * the request
	 *
	 * @param [type] $option [description]
	 * @param [type] $value  [description]
	 */
	public function addOption($option, $value)
	{
		$option = strtoupper($option);

		if (is_string($option) && ! defined($option))
		{
			$option = 'CURLOPT_' . $option;
		}

		$this->options[$option] = $value;
	}

	/**
	 * Checks if an option is setted.
	 * @param  string  $name
	 * @return boolean
	 */
	public function hasOption($name)
	{
		return isset($this->options[$name]) or isset($this->options['CURLOPT_'.$name]);
	}

	/**
	 * Reset the current instance of the client
	 * and reinit the curl.
	 * @return void
	 */
	public function reset()
	{
		$this->dispose();
		$this->res = curl_init();

		// Set the defaults

		$this->addOption('RETURNTRANSFER', true);
		$this->addOption('FOLLOWLOCATION', true);
	}

	/**
	 * Method that helps us to navigate to a specific url
	 * @param  [type] $url [description]
	 * @return [type]      [description]
	 */
	public function navigate($url = null)
	{
		if ( ! empty($url))
		{
			$this->addOption('URL', $url);
		}

		// Make sure we add the getfields and other checks

		$this->prepareURL();

		// Set the postfields if we have a post request

		if ($this->hasOption('POST'))
		{
			$this->addOption('POSTFIELDS', $this->postfields);
		}

		// Set the rest of the curl client options

		$this->setOption($this->options);

 		return curl_exec($this->res);
	}

	/**
	 * Send post headers via the request
	 * @param  array/string $name
	 * @param  mixed $value
	 * @return cURL object
	 */
	public function post($name, $value = null)
	{
		if ( ! $this->hasOption('POST'))
		{
			$this->addOption('POST', true);
		}

		if (is_array($name))
		{
			$this->postfields = array_merge($this->postfields, $name);
		}
		else
		{
			$this->postfields[$name] = $value;
		}

		return $this;
	}

	/**
	 * Add get fields to an url.
	 * It works like:
	 * 	$request->get('action', 'login');
	 *  // domain.tld/?action=login
	 * 
	 * @param  array/string
	 * @param  mixed $value
	 * @return cURL instance
	 */
	public function get($name, $value = null)
	{
		if (is_array($name))
		{
			$this->getfields = array_merge($this->getfields, $name);
		}
		else
		{
			$this->getfields[$name] = $value;
		}

		return $this;
	}

	/**
	 * Clears the resource
	 * @return void
	 */
	public function dispose()
	{
		if (null != $this->res)
		{
			// Close curl client
			
			curl_close($this->res);
			$this->res = null;

			// Clean user settings stack

			$this->postfields = array();
			$this->getfields  = array();
			$this->options    = array();
		}
	}

	/**
	 * Prepare url for the request. It converts the getfields into a url query
	 * and makes it safe for request.
	 * 	
	 * @return void
	 */
	protected function prepareURL()
	{
		$query = array();

		foreach ($this->getfields as $field => $value)
		{
			$query[] = $field.'='.urlencode($value);
		}
		$query = implode('&', $query);

		$url = trim($this->options['CURLOPT_URL'], '&');

		if (stripos($this->options['CURLOPT_URL'], '?') === false)
		{
			$url .= '?';
		}
		else
		{
			$query = '&' . $query;
		}

		$this->addOption('URL', $url . $query);
	}

	/**
	 * GC - Closes the curl connection.
	 */
	public function __destruct()
	{
		$this->dispose();
	}
}