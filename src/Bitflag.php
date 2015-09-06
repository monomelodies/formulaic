<?php

namespace Formulaic;

class Bitflag extends Checkbox\Group
{
    protected $value = 0;

    public function setValue($value)
    {
        if (is_array($value)) {
            $value = array_reduce(
                $value,
                function ($carry, $item) {
                    return $carry | $item;
                },
                0
            );
        }
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

