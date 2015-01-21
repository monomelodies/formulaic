<?php

namespace Formulaic\Form;

use ArrayObject;

trait Tostring
{
    public function __toString()
    {
        if ($name = $this->name()) {
            $this->attributes['id'] = $name;
        }
        $out = '<form'.$this->attributes().'>';
        $fields = (array)$this;
        if ($fields) {
            $out .= "\n";
            foreach ($fields as $field) {
                $field->prefix($name);
                if ($field instanceof ArrayObject) {
                    $out .= "$field\n";
                } else {
                    $out .= "<div>$field</div>\n";
                }
            }
        }
        $out .= '</form>';
        return $out;
    }
}

