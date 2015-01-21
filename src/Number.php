<?php

namespace Formulaic;

class Number extends Text
{
    protected $attributes = ['type' => 'number'];

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->addTest('numeric', 'is_numeric');
    }

    public function setMin($min)
    {
        $this->attributes['min'] = $min;
        return $this;
    }

    public function setMax($max)
    {
        $this->attributes['max'] = $max;
        return $this;
    }

    public function setStep($step)
    {
        $this->attributes['step'] = $step;
    }
}

