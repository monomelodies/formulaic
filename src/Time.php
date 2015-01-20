<?php

namespace Formulaic;

class Time extends Element
{
    protected $attributes = ['type' => 'time'];

    public function isValidTime()
    {
        return $this->addTest(function ($value) {
            $current = str_replace(':', '', $value);
            return $current > '000000' && $current < '235959' ?
                null :
                'error.invalid';
        });
    }

    public function isTimeInPast()
    {
        return $this->addTest(function ($value) { 
            return str_replace(':', '', $value) < date('His') ?
                null :
                'error.notinpast';
        });
    }

    public function isTimeInFuture()
    {
        return $this->addTest(function ($value) {
            return str_replace(':', '', $value) > date('His') ?
                null :
                'error.notinfuture';
        });
    }
}

