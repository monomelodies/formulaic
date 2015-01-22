<?php

namespace Formulaic;

class File extends Element
{
    protected $attributes = ['type' => 'file'];

    public function isRequired()
    {
        $this->attributes['required'] = true;
        return $this->addTest('required', function ($value) {
            return strlen(trim($value)) || isset($_FILES[$this->name]);
        });
    }

    public function __toString()
    {
        $old = $this->value;
        $this->value = null;
        $out = parent::__toString();
        $this->value = $old;
        return $out;
    }
}

