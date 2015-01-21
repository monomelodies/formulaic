<?php

namespace Formulaic;

class Time extends Element
{
    protected $attributes = ['type' => 'time'];

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->addTest('valid', function ($value) {
            if (is_null($value)) {
                return true;
            }
            $current = str_replace(':', '', $value);
            return $current > '000000' && $current < '235959';
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
        return $this->addTest('inpast', function ($value) { 
            return str_replace(':', '', $value) < date('His');
        });
    }

    public function isInFuture()
    {
        return $this->addTest('infuture', function ($value) {
            return str_replace(':', '', $value) > date('His');
        });
    }
}

