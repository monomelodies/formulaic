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
            $element = $this[$element->name()];
            if (!$element->valid()) {
                return false;
            }
        }
        return true;
    }
    
    public function errors()
    {
        $errors = $this->privateErrors();
        foreach ((array)$this as $element) {
            $element = $this[$element->name()];
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

