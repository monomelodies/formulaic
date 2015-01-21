<?php

namespace Formulaic\Element;

use ErrorException;
use Exception as E;

trait Tostring
{
    public function __toString()
    {
        if ($id = $this->id()) {
            $this->attributes['id'] = $id;
        }
        return '<input'.$this->attributes().'>';
    }
}

