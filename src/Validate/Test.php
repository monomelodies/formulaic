<?php

namespace Formulaic\Validate;

trait Test
{
    public function addTest($name, callable $fn)
    {
        $this->tests[$name] = $fn;
        return $this;
    }
}

