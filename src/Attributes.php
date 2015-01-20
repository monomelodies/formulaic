<?php

namespace Formulaic;

trait Attributes
{
    public function attributes()
    {
        $return = [];
        foreach ($this->attributes as $name => $value) {
            if (is_null($value)) {
                $return[] = $name;
            } else {
                $return[] = sprintf('%s="%s"', $name, htmlentities($value));
            }
        }
        return $return ? ' '.implode(' ', $return) : '';
    }

    public function attribute($name, $value = null)
    {
        if ($value === false) {
            unset($this->attributes[$name]);
        } else {
            $this->attributes[$name] = $value;
        }
        return $this;
    }
}

