<?php

namespace Formulaic;

class Textarea extends Element
{
    public function __construct($name = null)
    {
        parent::__construct($name);
        unset($this->attributes['value']);
    }

    public function __toString()
    {
        return '<textarea'.$this->attributes().'>'
            .htmlentities($this->value, ENT_COMPAT, 'UTF-8')
            .'</textarea>';
    }

    /** The maximum length of the field. */                                                                                                                      public function maxLength($length)
    {
        $this->attributes['maxlength'] = (int)$length;
        return $this->addTest('maxlength', function($value) use ($length) {
            return mb_strlen(trim($value), 'UTF-8') <= (int)$length;
        });
    }
}

