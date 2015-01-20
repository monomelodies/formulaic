<?php

namespace Formulaic;

use ArrayObject;

class Fieldset extends ArrayObject
{
    use Attributes;

    private $legend;

    public function __construct($legend = null, callable $callback)
    {
        $this->legend = $legend;
        $callback($this);
    }

    public function __toString()
    {
        $out = '<fieldset'.$this->attributes().'>';
        if (isset($this->legend)) {
            $out .= "\n<legend>{$this->legend}";
        }
        $fields = (array)$this;
        if ($fields) {
            $out .= "\n".implode("\n", $fields)."\n";
        }
        $out .= '</fieldset>';
        return $out;
    }
}

