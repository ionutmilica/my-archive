<?php
namespace PHPData;

class Comparator {
    
    /**
     * First stored item to be comparated
     * @var Mixed
     */
    protected $itemA;

    /**
     * Second stored item to be comparated
     * @var Mixed
     */
    protected $itemB;
    
    /**
     * Init the comparator object
     * @param Mixed $a
     * @param Mixed $b
     */
    public function __construct($a, $b)
    {
        $this->itemA = $a;
        $this->itemB = $b;
    }
    
    /**
     * Resets the Comparator with new values
     * @param  Mixed $a
     * @param  Mixed $b
     * @return void
     */
    public function reset($a, $b)
    {
        $this->itemA = $a;
        $this->itemB = $b;    
    }

    /**
     * For the current comparator object checks
     * if a given condition is convenient
     * Ex:
     * (new Comparator(10, 20))->expect('!='); returns true because 10 and 20 are different.
     * 
     * @param  Comparation Operator $expect
     * @return boolean
     */
    public function expect($expect)
    {
        $cmp = Comparator::compare($this->itemA, $this->itemB);

        switch ($expect)
        {
            case '=': 
                return $cmp === 0;
            break;
            case '!=': 
                return $cmp != 0;
            break;
            case '>=': 
                return $cmp >= 0;
            break;
            case '<=': 
                return $cmp <= 0;
            break;
            case '>': 
                return $cmp > 0;
            break;
            case '<': 
                return $cmp < 0;
            break;
            default: 
                throw new Exception('Invalid comparator operation.');
        }
        return 0;
    }

    /**
     * An helper method used to compare different type items.
     * @param  Mixed $a
     * @param  Mixed $b
     * @return -1 if the first item is smaller
     *          0 if both items are equal
     *          1 if the second item is smaller
     */
    public static function compare($a, $b)
    {
        if (is_numeric($a) && is_numeric($b))
        {
            $result = $a - $b;
            
            if ($result < 0)
            {
                return -1;
            }
            
            if ($result > 0)
            {
                return 1;
            }
            
            return 0;
        }
        else
        {
            return strcmp($a, $b);
        }
    }    
}