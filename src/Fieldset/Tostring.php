<?php

namespace Formulaic\Fieldset;

trait Tostring
{
    public function __toString()
    {
        $out = '<fieldset'.$this->attributes().'>';
        if (isset($this->legend)) {
            $out .= "\n<legend>{$this->legend}</legend>";
        }
        $fields = (array)$this;
        if ($fields) {
            $out .= "\n".implode("\n", $fields)."\n";
        }
        $out .= '</fieldset>';
        return $out;
    }
}

