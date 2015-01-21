<?php

namespace Formulaic;

trait InputHelper
{
    public function populate()
    {
        foreach ($this->source as $name => $value) {
            $field = $this[$name];
            if (!isset($field)) {
                continue;
            }
            if ($field instanceof Element) {
                $field->setValue($value);
            } elseif ($field instanceof Element\Group && is_array($value)) {
                $field->source($value);
                $field->populate();
            }
        }
    }

    public function source($source)
    {
        if (is_null($source)) {
            return $this;
        }
        if (is_callable($source)) {
            $source = $source();
        }
        if (!is_array($source) && is_object($source)) {
            $source = (array)$source;
        }
        $this->source = $source + $this->source;
        return $this;
    }
}
