<?php

namespace Formulaic;

class Label extends Element
{
    use Label\Tostring;

    protected $label;
    protected $element;

    public function __construct($label, Element $element)
    {
        $this->label = $label;
        $this->element = $element;
    }

    public function name()
    {
        return $this->label;
    }

    public function getElement()
    {
        return $this->element;
    }

    public function raw()
    {
        return $this->txt;
    }
}

