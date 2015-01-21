<?php

namespace Formulaic\Checkbox;

use Formulaic;
use Formulaic\Element;
use Formulaic\Attributes;
use Formulaic\Validate;
use Formulaic\Checkbox;
use Formulaic\Label;
use ArrayObject;

class Group extends Element\Group
{
    use Attributes;
    use Validate\Group;
    use Group\Tostring;
    
    protected $attributes = [];
    private $prefix = [];
    private $prefixId = null;
    
    public function __construct($name, $options)
    {
        if (is_callable($options)) {
            $options($this);
            foreach ((array)$this as $option) {
                foreach ($this->prefix as $prefix) {
                    $option->prefix($prefix);
                }
                $option->prefix($name);
            }
        } else {
            foreach ($options as $value => $txt) {
                $option = new Checkbox($value);
                $option->setValue($value);
                foreach ($this->prefix as $prefix) {
                    $option->prefix($prefix);
                }
                $option->prefix($name);
                $this[] = new Label($txt, $option);
            }
        }
    }

    public function isRequired()
    {
        return $this->addTest(function ($value) {
            foreach ((array)$this as $option) {
                if ($option->checked()) {
                    return true;
                }
            }
            return false;
        });
    }
}

