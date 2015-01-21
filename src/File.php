<?php

namespace Formulaic;

class File extends Element
{
    protected $attributes = ['type' => 'file'];

    public function setValue($value)
    {
    }

    public function isRequired()
    {
        $this->attributes['required'] = true;
        return $this->addTest('required', function ($value) {
            return strlen(trim($value)) || isset($_FILES[$this->name]);
        });
    }

    public function __toString()
    {
        unset($this->attributes['value']);
        return parent::__toString();
    }
}

