<?php

namespace Formulaic;

use ErrorException;

class Password extends Text
{
    protected $attributes = ['type' => 'password'];

    public function __toString()
    {
        $old = $this->value;
        $this->value = null;
        $out = parent::__toString();
        $this->value = $old;
        return $out;
    }
}

