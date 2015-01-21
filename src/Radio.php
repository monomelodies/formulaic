<?php

namespace Formulaic;

class Radio extends Element
{
    protected $attributes = ['type' => 'radio', 'value' => 1];

    public function checked()
    {
        $this->attributes['checked'] = 'checked';
    }

    public function unchecked()
    {
        unset($this->attributes['checked']);
    }

    public function setValue($value)
    {
        if ($value == $this->attributes['value']) {
            $this->checked();
        } else {
            $this->unchecked();
        }
    }

    public function isChecked()
    {
        return isset($this->attributes['checked']);
    }

    /** This is a required field. */
    public function isRequired()
    {
        $this->attributes['required'] = true;
        return $this->addTest('required', function($value) {
            return $this->isChecked();
        });
    }
}

