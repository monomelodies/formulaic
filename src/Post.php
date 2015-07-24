<?php

namespace Formulaic;

abstract class Post extends Form
{
    public function __toString()
    {
        foreach ((array)$this as $field) {
            if ($field instanceof File
                or $field instanceof Label
                    && $field->getElement() instanceof File
            ) {
                $this->attributes['enctype'] = 'multipart/form-data';
            }
        }
        $this->attributes['method'] = 'post';
        return parent::__toString();
    }

    public function offsetGet($index)
    {
        if ($field = parent::offsetGet($index)) {
            if ($field instanceof File
                or ($field instanceof Label
                    && $field->getElement() instanceof File
                )
                && array_key_exists($index, $_FILES)
            ) {
                $field->setValue($_FILES[$index], $index);
            } elseif (array_key_exists($index, $_POST)) {
                $field->setValue($_POST[$index], $index);
            }
        }
        return $field;
    }
}

