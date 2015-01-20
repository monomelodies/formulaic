<?php

namespace Formulaic;

class Checkbox extends Radio
{
    protected $type = 'checkbox';

    public function getValue()
    {
        return $this->options['value'];
    }
}

