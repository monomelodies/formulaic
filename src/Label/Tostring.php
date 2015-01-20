<?php

namespace Formulaic\Label;

class Tostring
{
    public function __toString()
    {
        if ($id = $this->element->getId()) {
            $this->attributes['for'] = $id;
        }
        $out = '<label'.$this->attributes().'>';
        if ($this->element instanceof Checkbox) {
            $out .= "{$this->element} {$this->label}";
        } else {
            $out .= "{$this->label} {$this->element}";
        }
        $out .= '</label>';
        return $out;
    }
}

