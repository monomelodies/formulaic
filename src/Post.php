<?php

namespace Formulaic;

abstract class Post extends Form
{
    public function __toString()
    {
        foreach ((array)$this as $field) {
            if ($field->getElement() instanceof File) {
                $this->attributes['enctype'] = 'multipart/form-data';
            }
        }
        $this->attributes['method'] = 'post';
        return parent::__toString();
    }

    public function offsetSet($index, $item)
    {
        $name = $item->getElement()->name();
        if ($item->getElement() instanceof File) {
            $this->attributes['enctype'] = 'multipart/form-data';
            if (array_key_exists($name, $_FILES)) {
                $item->getElement()->setValue($_FILES[$name]);
            }
        } elseif (array_key_exists($name, $_POST)) {
            $item->getElement()->setValue($_POST[$name]);
        }
        return parent::offsetSet($index, $item);
    }
}

