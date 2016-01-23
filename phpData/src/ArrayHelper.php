<?php
namespace PHPData;

class ArrayHelper {
    
    public static function path($array, $path, $default = NULL, $delimiter = '.')
	{
		if ( ! is_array($array))
		{
			return $default;
		}

		if (is_array($path))
		{
			$keys = $path;
		}
		else
		{
			if (array_key_exists($path, $array))
			{
				return $array[$path];
			}

			$path = ltrim($path, $delimiter.' ');
			$path = rtrim($path, $delimiter.' *');
			$keys = explode($delimiter, $path);
		}

		do
		{
			$key = array_shift($keys);

			if (ctype_digit($key))
			{
				$key = (int) $key;
			}

			if (isset($array[$key]))
			{
				if ($keys)
				{
					if (is_array($array[$key]))
					{
						$array = $array[$key];
					}
					else
					{
						break;
					}
				}
				else
				{
					return $array[$key];
				}
			}
			elseif ($key === '*')
			{
				$values = array();
				foreach ($array as $arr)
				{
					if ($value = ArrayHelper::path($arr, implode('.', $keys)))
					{
						$values[] = $value;
					}
				}

				if ($values)
				{
					return $values;
				}
				else
				{
					break;
				}
			}
			else
			{
				break;
			}
		}
		while ($keys);

		return $default;
	}
}
