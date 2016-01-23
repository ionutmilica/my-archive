<?php
namespace PHPData;

class Container implements \ArrayAccess, \Countable, \SeekableIterator {
    
    /**
     * The container storage. Holds all the values
     * @var array
     */
    protected $data = array();

    /**
     * The container size
     * @var integer
     */
    protected $size = 0;

    /**
     * Current position pointer for SeekableIterator
     * @var integer
     */
    protected $position = 0;
    
    /**
     * Method implemented for Countable interface
     * @return integer Returns the size of our current container
     */
    public function count()
    {
        return $this->size;
    }

    /**
     * Adds a new element to our container
     * @param  Mixed $value It can be a array/object/string
     * @return integer Returns the size of our current container
     */
    public function push($value)
    {
        $this->data[] = $value;
        return ++$this->size;
    }
    
    /**
     * Adds a new element with a user-defined key into the container
     * @param  String/Integer $key
     * @param  Mixed $value
     * @return integer Returns the size of our current container
     */
    public function pushKeyValue($key, $value)
    {
        $this->data[$key] = $value;
        return ++$this->size;
    }

    /**
     * Check if the container contains a specific element
     * @param  Mixed $element
     * @return boolean
     */
    public function contains($element)
    {
        return in_array($this->data, $element);
    }

    /**
     * Return the index of found item.
     * @param  Mixed $element
     * @return Mixed
     */
    public function indexOf($element)
    {
        return array_search($element, $this->data);
    }

    /**
     * Checks for a given offset in the container and returns true of false if 
     * it is found
     * @param  Mixed $offset
     * @return boolean Returns true or false if the element is found
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }
    
    /**
     * Returns the element from the container for the given offset
     * @param  Mixed $offset
     * @return Mixed Returns the element
     */
    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }
    
    /**
     * Adds a new element with a given offset(key) or not.
     * @param  Mixed $offset
     * @param  Mixed $value
     * @return integer Returns the new size.
     */
    public function offsetSet($offset, $value)
    {
        if ($offset == null)
        {
            $this->data[] = $offset;
        }
        else
        {
            $this->data[$offset] = $value;
        }
        $this->size++;
    }
    
    /**
     * Removes a element for a given offset. It's triggered when we use unset(); function
     * @param  Mixed $offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset))
        {
            unset($this->data[$offset]);
        }
    }
    
    /**
     * Change the cursor posion. It's used with SeekableIterator.
     * @param  Mixed $position
     * @return void
     */
    public function seek($position)
    {
        if ( ! isset($this->data[$position]))
        {
            throw \OutOfBoundsException('Out of bounds error !');
        }
        $this->position = $position;
    }
    
    /**
     * Gets the element for the given cursor.
     * @return Mixed The element
     */
    public function current()
    {
        return $this->data[$this->position];
    }
    
    /**
     * Gets the current cursor position
     * @return Mixed
     */
    public function key()
    {
        return $this->position;
    }
    
    /**
     * Moves the cursor to the next element
     * @return function void
     */
    public function next()
    {
        ++$this->position;
    }
    
    /**
     * Resets the cursor to the first element
     * @return void
     */
    public function rewind()
    {
        $this->position = 0;
    }
    
    /**
     * Check if the cursor position is valid
     * @return boolean
     */
    public function valid()
    {
        return isset($this->data[$this->position]);
    }
}