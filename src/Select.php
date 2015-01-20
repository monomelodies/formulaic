<?php

namespace Formulaic;

class Select extends Element
{
    public $_Option;
    protected $type = 'select', $renderOptions = ['id', 'name'], $choices = [];

    protected $attributes = ['type' => 'select'];

    public function __construct($name, $options)
    {
        if (is_callable($options)) {
            $options($this);
        } else {
            foreach ($options as $value => $txt) {
                $option = new Option($txt);
                $option->setValue($value);
                $this[] = $option;
            }
        }
    }

    /*
    public function getChoices()
    {
        return $this->choices;
    }

    public function __set($name, $value)
    {
        if ($name != 'value') {
            return null;
        }
        if (isset($this->options['required']) && $this->options['required']) {
            if (!strlen(trim($value))) {
                $value = null;
            }
        }
        $this->value = $value;
        foreach ($this->choices as $choice) {
            if ("{$choice->value}" == "$value") {
                $choice->selected();
            } else {
                $choice->unselected();
            }
        }
        return $value;
    }

    public function notNull()
    {
        if (isset($this->choices[0]) && $this->choices[0]->value === '') {
            unset($this->choices[0]);
        }
    }
    */
}

