<?php

namespace Formulaic;

class Get extends Form
{
    public function __toString()
    {
        $this->attributes['method'] = 'get';
        return parent::__toString();
    }
}

