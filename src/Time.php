<?php

namespace Formulaic;

class Time extends Element
{
    protected $attributes = ['type' => 'time'];

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->addTest(function ($value) {
            if (is_null($value)) {
                return null;
            }
            $current = str_replace(':', '', $value);
            return $current > '000000' && $current < '235959' ?
                null :
                'error.invalid';
        });
    }

    public function setValue($value)
    {
        $totime = is_numeric($value) ? $value : strtotime($value);
        if (!$totime) {
            return parent::setValue($value);
        }
        return parent::setValue(date('H:i:s', $totime));
    }

    public function isInPast()
    {
        return $this->addTest(function ($value) { 
            return str_replace(':', '', $value) < date('His') ?
                null :
                'error.notinpast';
        });
    }

    public function isInFuture()
    {
        return $this->addTest(function ($value) {
            return str_replace(':', '', $value) > date('His') ?
                null :
                'error.notinfuture';
        });
    }
}

