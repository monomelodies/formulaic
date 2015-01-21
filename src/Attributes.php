<?php

namespace Formulaic;

trait Attributes
{
    public function attributes()
    {
        $return = [];
        foreach ($this->attributes as $name => $value) {
            if (is_null($value)) {
                if ($name == 'value') {
                    continue;
                }
                $return[] = $name;
            } else {
                $return[] = sprintf(
                    '%s="%s"',
                    $name,
                    htmlentities($value, ENT_COMPAT, 'UTF-8')
                );
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

