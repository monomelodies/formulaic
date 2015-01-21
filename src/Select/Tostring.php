<?php

namespace Formulaic\Select;

trait Tostring
{
    public function __toString()
    {
        $out = '<select'.$this->attributes().'>';
        if (count((array)$this)) {
            $out .= "\n";
            foreach ((array)$this as $option) {
                $out .= "$option\n";
            }
        }
        $out .= '</select>';
        return $out;
    }
}

