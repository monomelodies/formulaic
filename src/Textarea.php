<?php

namespace Formulaic;

class Textarea extends Element
{
    public function __toString()
    {
        return '<textarea'.$this->attributes().'>'
            .htmlentities($this->value, ENT_COMPAT, 'UTF-8')
            .'</textarea>';
    }
}

