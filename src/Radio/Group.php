<?php

namespace Formulaic\Radio;

use Formulaic\Attributes;
use Formulaic\Validate;
use Formulaic\Radio;
use Formulaic\Checkbox;
use Formulaic\Element;
use Formulaic\Label;
use Formulaic\InputHelper;

class Group extends Element\Group
{
    use Attributes;
    use Validate\Group;
    use Validate\Test;
    use Group\Tostring;
    use InputHelper;
    
    protected $attributes = [];
    protected $tests = [];
    protected $source = [];
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
                if ($this instanceof Checkbox\Group) {
                    $option = new Checkbox($value);
                    $idx = count($this);
                } else {
                    $option = new Radio;
                    $idx = $value;
                }
                $option->setValue($value);
                foreach ($this->prefix as $prefix) {
                    $option->prefix($prefix);
                }
                $option->prefix($name);
                $this[$idx] = new Label($txt, $option);
            }
        }
        $this->prefix[] = $name;
    }

    public function name()
    {
        return $this->id();
    }
    
    public function id()
    {
        return $this->prefix[0];
    }
    
    public function populate()
    {
        parent::populate();
        foreach ($this->source as $name => $value) {
            $field = $this[$name];
            if (!isset($field)) {
                continue;
            }
            if ($value) {
                $field->check();
            }
            // Radio groups can only have one option selected.
            if (!($this instanceof Checkbox\Group)) {
                break;
            }
        }
    }
    
    public function isRequired()
    {
        return $this->addTest('required', function ($value) {
            foreach ($value as $option) {
                if ($option->checked()) {
                    return true;
                }
            }
            return false;
        });
    }
}

