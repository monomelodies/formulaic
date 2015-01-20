<?php

namespace Formulaic;

class Tel extends Text
{
    protected $attributes = ['type' => 'tel'];

    public function setValue($value)
    {
        $value = preg_replace('/^\d/', '', $value);
        if (strlen($value)) {
            if ($value{0} != '0') {
                $value = "0$value";
            }
        }
        return parent::setValue($name, $value);
    }
}

