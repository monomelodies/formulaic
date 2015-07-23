<?php

namespace Formulaic;

class Bitflag extends Checkbox\Group
{
    protected $value = 0;

    public function setValue($value)
    {
        if (is_array($value)) {
            $bit = 0;
            foreach ($value as $one) {
                $bit |= $one;
            }
            $value = $bit;
        }
        $this->value = $value;
        foreach ((array)$this as $element) {
            if ($value & $element->getValue()) {
                $element->check();
            } else {
                $element->check(false);
            }
        }
    }
}

