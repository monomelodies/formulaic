<?php

namespace Formulaic\Element;

use ErrorException;
use Exception as E;

trait Tostring
{
    public function __toString()
    {
        return '<input'.$this->attributes().'>';
    }
}

