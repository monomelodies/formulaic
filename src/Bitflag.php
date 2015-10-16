<?php

namespace Formulaic;

use StdClass;
use JsonSerializable;

class Bitflag extends Checkbox\Group
{
    protected $value = null;

    public function setValue($value)
    {
        if (is_object($value)) {
            if (isset($this->value)) {
                $old = clone $this->value;
                $work = clone $value;
                if ($work instanceof JsonSerializable) {
                    $work = $work->jsonSerialize();
                }
                foreach ($work as $prop => $status) {
                    $value->$prop = isset($old->$prop) ? $old->$prop : false;
                }
            }
            $this->value = $value;
        }
        if (!isset($this->value)) {
            $this->value = new StdClass;
        }
        if (is_array($value)) {
            $work = clone $this->value;
            if ($work instanceof JsonSerializable) {
                $work = $work->jsonSerialize();
            }
            foreach ($work as $prop => $status) {
                $this->value->$prop = false;
            }
            foreach ($value as $prop) {
                $this->value->$prop = true;
            }
        }
        foreach ((array)$this as $element) {
            $check = $element->getElement()->getValue();
            if (isset($this->value->$check) && $this->value->$check) {
                $element->getElement()->check();
            } else {
                $element->getElement()->check(false);
            }
        }
    }

    public function & getValue()
    {
        return $this->value;
    }
}

