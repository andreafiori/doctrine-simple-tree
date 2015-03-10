<?php

namespace Entity;

use Doctrine\Common\Collections\Collection;

/**
 * Class CategoryRecursiveIterator
 */
class CategoryRecursiveIterator implements \RecursiveIterator
{
    private $_data;
    
    /**
     * @param Collection $data
     */
    public function __construct(Collection $data)
    {
        $this->_data = $data;
    }
    
    /**
     * @return bool
     */
    public function hasChildren()
    {
        return ( ! $this->_data->current()->getChildCategories()->isEmpty());
    }

    /**
     * @return CategoryRecursiveIterator
     */
    public function getChildren()
    {
        return new CategoryRecursiveIterator($this->_data->current()->getChildCategories());
    }

    public function current()
    {
        return $this->_data->current();
    }

    public function next()
    {
        $this->_data->next();
    }

    /**
     * @return int|string
     */
    public function key()
    {
        return $this->_data->key();
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return $this->_data->current() instanceof \Entity\Category;
    }

    public function rewind()
    {
        $this->_data->first();
    }
}
