<?php

namespace Formulaic;

abstract class Get extends Form
{
    public function __toString()
    {
        $this->attributes['method'] = 'get';
        return parent::__toString();
    }

    public function populate()
    {
        $this->source($_GET);
        parent::populate();
    }
}

