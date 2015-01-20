<?php

namespace Formulaic\Form;

use Formulaic\Fieldset;

trait Tostring
{
    public function __toString()
    {
        $out = '<form'.$this->attributes().'>';
        $fields = (array)$this;
        if ($fields) {
            $out .= "\n";
            foreach ($fields as $field) {
                if ($field instanceof Fieldset) {
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

