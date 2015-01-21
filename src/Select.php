<?php

namespace Formulaic;

use ArrayObject;

class Select extends ArrayObject
{
    use Attributes;
    use Validate\Test;
    use Validate\Required;
    use Validate\Element;
    use Select\Tostring;

    protected $attributes = [];

    public function __construct($name, $options)
    {
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

    /*
    public function getChoices()
    {
        return $this->choices;
    }

    public function __set($name, $value)
    {
        if ($name != 'value') {
            return null;
        }
        if (isset($this->options['required']) && $this->options['required']) {
            if (!strlen(trim($value))) {
                $value = null;
            }
        }
        $this->value = $value;
        foreach ($this->choices as $choice) {
            if ("{$choice->value}" == "$value") {
                $choice->selected();
            } else {
                $choice->unselected();
            }
        }
        return $value;
    }

    public function notNull()
    {
        if (isset($this->choices[0]) && $this->choices[0]->value === '') {
            unset($this->choices[0]);
        }
    }
    */
}

