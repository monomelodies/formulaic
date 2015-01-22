<?php

namespace Formulaic;

class Radio extends Element
{
    protected $attributes = ['type' => 'radio'];
    protected $value = 1;

    public function check($value = null)
    {
        if ($value === false) {
            unset($this->attributes['checked']);
        } else {
            $this->attributes['checked'] = $value;
        }
    }

    public function checked()
    {
        return array_key_exists('checked', $this->attributes);
    }

    /** This is a required field. */
    public function isRequired()
    {
        $this->attributes['required'] = true;
        return $this->addTest('required', function($value) {
            return $this->checked();
        });
    }
}

