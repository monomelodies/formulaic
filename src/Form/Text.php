<?php

namespace Formulaic;

class Text extends Element
{
    protected $type = 'text',
        $renderOptions = ['id', 'name', 'type', 'value', 'size', 'maxlength'];

    public function size($size)
    {
        $this->options['size'] = $size;
        return $this;
    }
}

