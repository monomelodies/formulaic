<?php

namespace Formulaic\Validate;

trait Test
{
    public function addTest($name, callable $fn)
    {
        $this->tests[$name] = function ($value) use ($name, $fn) {
            if (strlen(trim($value)) || $name == 'required') {
                return $fn($value);
            }
            return true;
        };
        return $this;
    }
}

