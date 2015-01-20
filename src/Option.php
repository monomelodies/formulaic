<?php

namespace Formulaic;

class Option extends Element
{
    protected $label;

    public function __construct($value, $label)
    {
        $this->value = $value;
        $this->label = $label;
    }

    public function selected()
    {
        $this->renderOptions[] = 'selected';
        $this->options['selected'] = 'selected';
    }

    public function unselected()
    {
        unset($this->options['selected']);
        foreach ($this->renderOptions as $key => $value) {
            if ($value == 'selected') {
                unset($this->renderOptions[$key]);
            }
        }
    }

    public function __toString()
    {
        return '<option value="'
            .$this->value
            .'"'
            .$this->attributes()
            .'">'
            .$this->label
            .'</option>';
    }
}

