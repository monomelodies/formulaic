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

    public function __call($function, array $arguments)
    {
        return call_user_func_array([$this->element, $function], $arguments);
    }

    public function errors()
    {
        return $this->element->errors();
    }
    
    public function valid()
    {
        return $this->element->valid();
    }

    public function raw()
    {
        return $this->txt;
    }
}

