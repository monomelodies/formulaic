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
        if (array_key_exists($item->name(), $_GET)) {
            $field->setValue($_GET[$item->name()]);
        }
        return parent::offsetSet($index, $item);
    }
}

