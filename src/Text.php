<?php

namespace Formulaic;

class Text extends Element
{
    protected $type = 'text',
        $renderOptions = ['id', 'name', 'type', 'value', 'size', 'maxlength'];

    protected $attributes = ['type' => 'text'];

    public function size($size)
    {
        $this->attributes['size'] = $size;
        return $this;
    }
}

