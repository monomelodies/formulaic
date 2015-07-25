<?php

namespace Formulaic\Checkbox;

use Formulaic\Radio;

class Group extends Radio\Group
{
    use Group\Tostring;

    private $value;

    public function populate()
    {
        parent::populate();
        $source = end($this->source);
        if (!$source) {
            return;
        }
        foreach ((array)$this as $element) {
            if (in_array($element->getValue(), $source->{$this->name()})) {
                $element->check();
            } else {
                $element->check(false);
            }
        }
    }

    public function setValue($value)
    {
        if (is_scalar($value)) {
            $value = [$value];
        }
        foreach ((array)$this as $element) {
            if (in_array($element->getElement()->getValue(), $value)) {
                $element->getElement()->check();
            } else {
                $element->getElement()->check(false);
            }
        }
    }
    
    public function & getValue()
    {
        $this->value = [];
        foreach ((array)$this as $element) {
            if ($element->getElement()->checked()) {
                $this->value[] = $element->getElement()->getValue();
            }
        }
        return $this->value ? $this->value : null;
    }
}

