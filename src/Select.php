<?php

namespace Formulaic;

use ArrayObject;

class Select extends ArrayObject
{
    use Attributes;
    use Element\Identify;
    use Validate\Test;
    use Validate\Required;
    use Validate\Element;
    use Select\Tostring;

    protected $attributes = [];
    protected $value;
    protected $name;
    protected $prefix = [];

    public function __construct($name, $options)
    {
        if (isset($name)) {
            $this->attributes['name'] = $name;
        }
        if (is_callable($options)) {
            $options($this);
        } else {
            foreach ($options as $value => $txt) {
                $option = new Select\Option($value, $txt);
                $this[] = $option;
            }
        }
        $this->addTest('valid', function ($value) {
            foreach ((array)$this as $option) {
                if ($option->getValue() == $value) {
                    return true;
                }
            }
            return false;
        });
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
        foreach ((array)$this as $option) {
            if ($option->getValue() == $value) {
                $option->selected();
            } else {
                $option->unselected();
            }
        }
    }
}

