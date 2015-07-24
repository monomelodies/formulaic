<?php

namespace Formulaic;

abstract class Get extends Form
{
    public function __toString()
    {
        $this->attributes['method'] = 'get';
        return parent::__toString();
    }

    public function offsetGet($index)
    {
        if ($field = parent::offsetGet($index)
            and array_key_exists($index, $_GET)
        ) {
            $field->setValue($_GET[$index], $index);
        }
        return $field;
    }
}

