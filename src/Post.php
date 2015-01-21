<?php

namespace Formulaic;

abstract class Post extends Form
{
    public function __toString()
    {
        if ($this->hasFiles()) {
            $this->attributes['enctype'] = 'multipart/form-data';
        }
        $this->attributes['method'] = 'post';
        return parent::__toString();
    }

    public function populate()
    {
        $this->source($_POST);
        if ($this->hasFiles()) {
            $this->source($_FILES);
        }
        parent::populate();
    }

    private function hasFiles()
    {
        foreach ((array)$this as $element) {
            if (is_array($element)) {
                foreach ((array)$element as $field) {
                    if ($field instanceof File) {
                        return true;
                    }
                }
            } elseif ($element instanceof Label
                && $element->element() instanceof File
            ) {
                return true;
            } elseif ($element instanceof File) {
                return true;
            }
        }
        return false;
    }
}

