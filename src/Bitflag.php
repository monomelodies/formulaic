<?php

namespace Formulaic;

class Bitflag extends Checkbox\Group
{
    protected $value = 0;

    public function setValue($value)
    {
        $this->value |= $value;
        foreach ((array)$this as $element) {
            if ($value & $element->getElement()->getValue()) {
                $element->getElement()->check();
            } else {
                $element->getElement()->check(false);
                $this->value &= ~$element->getElement()->getValue();
            }
        }
    }

    public function & getValue()
    {
        return $this->value;
    }
}

