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
            if ($error = $element->errors()) {
                $errors = array_merge($errors, $error);
            }
        }
        return $errors;
    }
}

