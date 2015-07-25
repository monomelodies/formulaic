<?php

namespace Formulaic\Element;

use Formulaic\Validate;
use ArrayObject;
use Formulaic\QueryHelper;

class Group extends ArrayObject
{
    use Validate\Group;
    use QueryHelper;

    private $prefix = [];
    private $name;
    private $value = [];

    public function __construct($name = null, callable $callback)
    {
        if ($name) {
            $this->name = $name;
        }
        $callback($this);
        foreach ((array)$this as $element) {
            $element->prefix($name);
        }
    }

    public function prefix($prefix)
    {
        $this->prefix[] = $prefix;
        foreach ((array)$this as $element) {
            $element->prefix($prefix);
        }
    }

    public function name()
    {
        return isset($this->name) ? $this->name : null;
    }

    public function setValue($value)
    {
        if (is_scalar($value)) {
            return;
        }
        foreach ($value as $name => $val) {
            if ($field = $this[$name]) {
                $field->getElement()->setValue($val);
            }
        }
    }

    public function & getValue()
    {
        $this->value = [];
        foreach ((array)$this as $field) {
            $this->value[] = $field->getElement()->getValue();
        }
        return $this->value;
    }

    /**
     * Convenience method to keep our interface consistent.
     */
    public function getElement()
    {
        return $this;
    }

    public function __toString()
    {
        return trim(implode("\n", (array)$this));
    }

    public function valueSuppliedByUser($status = null)
    {
        $is = false;
        foreach ((array)$this as $field) {
            if (isset($status)) {
                $field->getElement()->valueSuppliedByUser($status);
            }
            if ($field->getElement()->valueSuppliedByUser()) {
                $is = true;
            }
        }
        return $is;
    }
}

