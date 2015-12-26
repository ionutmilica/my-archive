<?php

class Route
{
	/**
	 * Static array that holds all Route instances
	 * @var array
	 */
	private static $routes = array();
	
	/**
	 * Creates a new route and add it to an static array
	 * @param Route $route Instance of the route
	 */
	
	public static function add($route, $callback)
	{
		if ( ! isset(self::$routes[$route]))
		{
			self::$routes[$route] = new Route($route, $callback);
		}
		return self::$routes[$route];
	}

	/**
	 * Return all the routes instances.
	 * @return array Array of Route instances
	 */
	public static function all()
	{
		return self::$routes;
	}

	/**
	 * Holds the route format
	 * @var string
	 */
	private $format;

	/**
	 * Holds the compiled route format in regex expr
	 * @var [type]
	 */
	private $compiled;
	
	/**
	 * Every route accept bindings for {key} syntax like.
	 * @var array
	 */
	private $bindings = array();

	/**
	 * Hold saved tags via matches. (Used by router)
	 * @var array
	 */
	private $data = array();

	/**
	 * Rules applied over all routes
	 * @var array
	 */
	private static $globalBindings = array();

	/**
	 * The constructor
	 * @param string $route
	 */
	private function __construct($route, $callback)
	{
		$this->format = $route;
		$this->callback = $callback;
	}

	/**
	 * Binds data to the route
	 * @param  string $name
	 * @param  string $value
	 * @return Route
	 */
	public function where($name, $value)
	{
		if (is_array($name))
		{
			foreach ($name as $bind)
			{
				$this->where($name, $value);
			}
		}
		else
		{
			$this->bindings[$name] = $value;
		}

		return $this;
	}

	public static function pattern($name, $value)
	{
		if (is_array($name))
		{
			foreach ($name as $bind)
			{
				self::pattern($name, $value);
			}
		}
		else
		{
			self::$globalBindings[$name] = $value;
		}

	}

	/**
	 * Compiles the route syntxa in regex format
	 * @todo  Refactor the code
	 * @return void
	 */
	public function compile()
	{
		$this->compiled = null;

		preg_match_all('#{(.*?)}#i', $this->format, $out);
		
		$parts = explode('/', $this->format);
		$size = count($parts);

		$i = 0;
		
		foreach ($parts as $part)
		{
			$part = str_replace(array('{', '}'), '', $part);
			$key = array_search($part, $out[1]);
			
			if ($key !== FALSE)
			{
				$opt = $this->isOptional($part, $clean) ? true : false;

				$rep = '(?P<'.$clean.'>.*?)';

				if (isset(self::$globalBindings[$part]))
				{
					$rep = '(?P<'.$clean.'>'.self::$globalBindings[$part].')';
				}

				if (isset($this->bindings[$part]))
				{
					$rep = '(?P<'.$clean.'>'.$this->bindings[$part].')';
				}

				$beforeSlash = $i != 0 ? ! $opt ? '/' : '/?': '';
				$this->compiled .= $beforeSlash . $rep . ($opt ? '?' : '');

				$i++;
			}
		}
		return $this;
	}

	/**
	 * Checks if a route tag is optional
	 * @param  string  $string
	 * @param  string  $good
	 * @return boolean
	 */
	private function isOptional($string, &$good)
	{
		$size = strlen($string);

		if ($string[$size - 1] == '?')
		{
			$good = str_replace('?', '', $string);
			return true;			
		}
		$good = $string;

		return false;
	}

	/**
	 * See if one of the defined routes matches a passed string.
	 * @param  string $string
	 * @return boolean
	 */
	public function matches($string)
	{
		$result = preg_match_all('#^'.$this->compiled.'$#i', $string, $out);

		foreach ((array)$out as $key => $data)
		{
			if ( ! is_int($key))
			{
				if (isset($data[0]))
				{
					$this->data[$key] = $data[0];
				}
			}
		}

		return $result;
	}

	// tmp methods
	// 
	public function getCallback()
	{
		return $this->callback;
	}

	public function getData()
	{
		return $this->data;
	}
}