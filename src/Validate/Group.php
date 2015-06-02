<?php

namespace Formulaic\Validate;

trait Group
{
    public function valid()
    {
        if ($this->privateErrors()) {
            return false;
        }
        foreach ((array)$this as $element) {
            if (!$element->valid()) {
                return false;
            }
        }
        return true;
    }
    
    public function errors()
    {
        $errors = $this->_errors();
        foreach ((array)$this as $element) {
            if ($error = $element->errors()) {
                $errors = array_merge($errors, [$element->name() => $error]);
            }
        }
        return $errors;
    }

    private function privateErrors()
    {
        $errors = [];
        if (isset($this->tests)) {
            foreach ($this->tests as $error => $test) {
                if (!$test((array)$this)) {
                    $errors[] = $error;
                }
            }
        }
        return $errors;
    }
}

