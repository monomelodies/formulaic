<?php

namespace Formulaic;

class Button extends Element
{
    protected $text;
    protected $attributes = ['type' => 'button'];

    public function __construct($text = null, $name = null)
    {
        if (isset($name)) {
            $this->attributes['name'] = $name;
        }
        $this->text = $text;
    }

    public function __toString()
    {
        return '<button'.$this->attributes().'>'.$this->text.'</button>';
    }
}

