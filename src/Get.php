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
        $name = $item->getElement()->name();
        if (array_key_exists($name, $_GET)) {
            $item->getElement()->setValue($_GET[$name]);
            $item->getElement()->valueSuppliedByUser(true);
        }
        return parent::offsetSet($index, $item);
    }
}

