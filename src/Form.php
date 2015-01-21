<?php

namespace Formulaic;

use ArrayObject;

abstract class Form extends ArrayObject
{
    use Attributes;
    use Form\Tostring;
    use Validate\Group;
    use InputHelper;
    use QueryHelper;

    protected $attributes = [];
    private $source = [];

    public function name()
    {
        return isset($this->attributes['name']) ?
            $this->attributes['name'] :
            null;
    }

    public function offsetGet($index)
    {
        if (!isset($this[$index])) {
            foreach ((array)$this as $element) {
                if ($element->name() == $index) {
                    return $element;
                }
                if ($element instanceof Label
                    && $element->getElement()->name() == $index
                ) {
                    return $element;
                }
                if ($element instanceof ArrayObject) {
                    foreach ((array)$element as $field) {
                        if ($field->name() == $index) {
                            return $field;
                        }
                    }
                }
            }
        }
    }
}

