<?php

namespace Formulaic;

class Email extends Text
{
    protected $attributes = ['type' => 'email'];

    public function __construct($name = null)
    {
        parent::prepare($name);
        $this->addTest('valid', function ($value) {
            if (is_null($value)) {
                return true;
            }
            return filter_var($value, FILTER_VALIDATE_EMAIL)
                && preg_match("/.*@.*\..*/", $value);
        });
    }
}

