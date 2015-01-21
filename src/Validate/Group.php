<?php

namespace Formulaic\Validate;

trait Group
{
    public function valid()
    {
        foreach ((array)$this as $element) {
            if (!$element->valid()) {
                return false;
            }
        }
        return true;
    }
    
    public function errors(array $errors = null)
    {
        $errors = [];
        foreach ((array)$this as $element) {
            $errors = array_merge($error, $element->errors());
        }
        return $errors;
    }
}

