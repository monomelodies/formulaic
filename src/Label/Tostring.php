<?php

namespace Formulaic\Label;

use Formulaic\Radio;

trait Tostring
{
    public function __toString()
    {
        /*
        if ($id = $this->element->getId()) {
            $this->attributes['for'] = $id;
        }
        */
        $out = '<label'.$this->attributes().'>';
        if ($this->element instanceof Radio) {
            $out .= "{$this->element} {$this->label}";
        } else {
            $out .= "{$this->label} {$this->element}";
        }
        $out .= '</label>';
        return $out;
    }
}

