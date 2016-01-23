<?php
namespace PHPData;

class Collection extends Container {

    /**
     * Init the collection according to received data.
     * @param Mixed $data
     */
    public function __construct($data = null)
    {
        if (is_array($data) || ($data = isJson($data)) !== false)
        {
            $this->data = $data;
        }
    }
    
    /**
     * Slice a collection and pick items from $start to $end.
     * @param  integer $start
     * @param  integer $end
     * @return Collection
     */
    public function slice($start, $end)
    {
        return new Collection(array_slice($this->data, $start, $end));
    }

    /**
     * Skip first #num items from the collection
     * @param  integer $numItems
     * @return Collection
     */
    public function skip($numItems)
    {
        return $this->slice($numItems - 1, $this->count());
    }
    
    /**
     * Limit the collection for pagination purposes.
     * 
     * @param  integer $start
     * @param  integer $numItems
     * @return Collection
     */
    public function limit($start, $numItems)
    {
        return $this->slice($start, $start + $numItems);
    }

    /**
     * Return a new collection of items for satisfied condition.
     * @param  string $key
     * @param  string $condition
     * @param  string $against 
     * @return Collection
     */
    public function where($key, $condition, $against)
    {
        $comparator = new Comparator(0, 0);

        return $this->filter(function ($value) use ($key, $condition, $comparator, $against) 
        {    
            $toCompare = $value;

            if (is_array($value))
            {
                $toCompare = ArrayHelper::path($value, $key);
            }

            $comparator->reset($toCompare, $against);

            return $comparator->expect($condition);
        });
    }
    
    /**
     * Sort a collection by user preference
     * @param  string/callable $sortBy
     * @param  [string] $sorting
     * @return Collection
     */
    public function sort($sortBy = null, $sorting = 'ascending')
    {
        $tmp = $this->data;
        
        if ( ! is_callable($sortBy))
        {
            $callback = function ($a, $b) use ($sortBy) 
            {
                if (is_array($a) && is_array($b))
                {
                    $a = ArrayHelper::path($a, $sortBy);
                    $b = ArrayHelper::path($b, $sortBy);
                }

                return Comparator::compare($a, $b);
            };
        }
        else
        {
            $callback = $sortBy;
        }

        uasort($tmp, $callback);

        $newCollection = new Collection($tmp);
        
        if ($sorting == 'descending')
        {
            return $newCollection->reverse();
        }
        
        return $newCollection;
    }

    /**
     * Remove all occurences of an item from collection
     * @param  Mixed $item
     * @return Collection
     */
    public function remove($item)
    {
        return $this->where('value', '!=', $item);
    }

    /**
     * Remove all items between positions $start and $end.
     * @param  integer $start
     * @param  integer $end
     * @return Collection
     */
    public function removeRange($start, $count)
    {
        $i = 0;
        $removed = 0;

        $data = array();
        
        foreach ($this->data as $key => $item)
        {
            if (($i >= $start && $removed < $count) == false)
            {
                $data[$key] = $item;
            }
            else
            {
                $removed++;
            }

            $i++;
        }

        return new Collection($data);
    }

    /**
     * Reverse collection elements
     * @return Collection
     */
    public function reverse()
    {
        $data = $this->data;

        krsort($data);

        return new Collection($data);
    }
    
    /**
     * Apply a filter for each collection item.
     * @param  callable $filter
     * @return Collection
     */
    public function each(callable $filter)
    {
        $data = $this->data;
        
        array_walk($data, $filter);
        
        return new Collection($data);
    }

    /**
     * Filters a collection by a given callback
     * @param  callable $filter
     * @return Collection
     */
    public function filter(callable $filter)
    {
        $tmp = array_filter($this->data, $filter);

        return new Collection($tmp);
    }

    /**
     * Format collection output as php native array
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }
    
    /**
     * Format collection output as a JSON string
     * @return Json string
     */
    public function toJSON()
    {
        return json_encode($this->data);
    }

    /**
     * Converts to json when asked to convert to string.
     * $x = (string) $obj;
     * echo $obj;
     * @return JSON
     */
    public function __toString()
    {
        return $this->toJSON();
    }
}

/**
 * Helper function that checks if a given string is json
 * @param  string  $string
 * @return array/boolean
 */
function isJson($string)
{
    $data = json_decode($string, true);

    return json_last_error() == JSON_ERROR_NONE ? $data : false;
}