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

    private $prefix;
    private $source = [];

    public function __construct($prefix = null, callable $callback)
    {
        $this->prefix = $prefix;
        $callback($this);
    }

    public function name()
    {
        return isset($this->prefix) ? $this->prefix : null;
    }

    public function __toString()
    {
        foreach ((array)$this as $element) {
            $element->prefix($this->prefix);
            echo "$element\n";
        }
    }
}

