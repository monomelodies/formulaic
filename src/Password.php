<?php

namespace Formulaic;

use ErrorException;

class Password extends Text
{
    protected $attributes = ['type' => 'password'];

    public function __toString()
    {
        $this->value = null;
        return parent::__toString();
    }
}

