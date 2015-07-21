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

    public function getArrayCopy()
    {
        $copy = [];
        foreach ((array)$this as $key => $value) {
            if ($value instanceof Label) {
                $value = $value->getElement();
            }
            if (is_object($value)
                and method_exists($value, 'name')
                and $name = $value->name()
                and !($value instanceof Button)
            ) {
                $copy[$name] = $value->getValue();
            }
        }
        return $copy;
    }
}

