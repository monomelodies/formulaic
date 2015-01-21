<?php

namespace Formulaic;

abstract class Post extends Form
{
    public function __toString()
    {
        $files = false;
        foreach ((array)$this as $element) {
            if ($element instanceof Fieldset) {
                foreach ((array)$element as $field) {
                    if ($field instanceof File) {
                        $files = true;
                        break 2;
                    }
                }
            } elseif ($element instanceof Label
                && $element->element() instanceof File
            ) {
                $files = true;
            } elseif ($element instanceof File) {
                $files = true;
                break;
            }
        }
        if ($files) {
            $this->attributes['enctype'] = 'multipart/form-data';
        }
        $this->attributes['method'] = 'post';
        return parent::__toString();
    }
}

