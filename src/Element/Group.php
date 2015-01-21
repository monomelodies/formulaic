<?php

namespace Formulaic\Element;

use Formulaic\Validate;
use ArrayObject;
use Formulaic\InputHelper;
use Formulaic\QueryHelper;

class Group extends ArrayObject
{
    use Validate\Group;
    use InputHelper;
    use QueryHelper;

    private $prefix = [];
    private $prefixId = null;
    private $source = [];
    private $name;

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

    public function __toString()
    {
        return trim(implode("\n", (array)$this));
    }
}

