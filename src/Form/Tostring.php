<?php

namespace Formulaic\Form;
use ArrayObject;
use ErrorException;

trait Tostring
{
    public function __toString()
    {
        $out = '<form'.$this->attributes().'>';
        $fields = (array)$this;
        if ($fields) {
            $out .= "\n".implode("\n", $fields)."\n";
        }
        $out .= '</form>';
        return $out;
    }
}

