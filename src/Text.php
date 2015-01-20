<?php

namespace Formulaic;

class Text extends Element
{
    protected $attributes = ['type' => 'text'];

    public function size($size)
    {
        $this->attributes['size'] = $size;
        return $this;
    }
}

