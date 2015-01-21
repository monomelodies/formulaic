<?php

namespace Formulaic\Validate;

trait Element
{
    public function valid()
    {
        return $this->errors() ? false : true;
    }

    public function errors()
    {
        $errors = [];
        foreach ($this->tests as $error => $test) {
            if (!$test($this->value)) {
                $errors[] = $error;
            }
        }
        return $errors ? $errors : null;
    }
}

