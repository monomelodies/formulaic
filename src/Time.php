<?php

namespace Formulaic;

class Time extends Datetime
{
    protected $attributes = ['type' => 'time'];
    protected $format = 'H:i:s';
}

