<?php

namespace Formulaic;

abstract class Get extends Form
{
    public function __toString()
    {
        $this->attributes['method'] = 'get';
        return parent::__toString();
    }

    public function offsetSet($index, $item)
    {
        $name = $item->name();
        if (array_key_exists($name, $_GET)) {
            $item->setValue($_GET[$name]);
        }
        return parent::offsetSet($index, $item);
    }
}

