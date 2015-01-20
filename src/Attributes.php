<?php

namespace Formulaic;

trait Attributes
{
    public function attributes()
    {
        $return = [];
        foreach ($this->attributes as $name => $value) {
            $return[] = sprintf('%s="%s"', $name, htmlentities($value));
        }
        return $return ? ' '.implode(' ', $return) : '';
    }
}

