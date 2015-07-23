<?php

namespace Formulaic;

class Bitflag extends Checkbox\Group
{
    public function populate()
    {
        parent::populate();
        foreach ((array)$this as $element) {
            if ((is_array($this->source)
                    && in_array($element->getValue(), $this->source)
                )
                || (!is_array($this->source)
                    && $this->source & $element->getValue()
                )
            ) {
                $element->check();
            } else {
                $element->check(false);
            }
        }
    }

    public function setValue($value)
    {
        foreach ((array)$this as $element) {
            if ($value & $element->getValue()) {
                $element->check();
            } else {
                $element->check(false);
            }
        }
    }

    public function getValue()
    {
        $bit = 0;
        foreach ((array)$this as $element) {
            $bit |= $element->getValue();
        }
        return $bit;
    }
}

