<?php

namespace Formulaic;

class Email extends Text
{
    protected $attributes = ['type' => 'email'];

    public function __construct($name = null)
    {
        parent::prepare($name);
        $this->addTest(function($value) {
            if (!strlen(trim($value))) {
                return null;
            }
            return filter_var($value, FILTER_VALIDATE_EMAIL)
                && preg_match("/.*@.*\..*/", $value) ?
                    null :
                    'error.filter';
        });
    }
}

