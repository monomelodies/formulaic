<?php

namespace Formulaic;

use ArrayObject;

class Fieldset extends ArrayObject
{
    use Attributes;
    use Fieldset\Tostring;
    use Validate\Group;

    protected $attributes = [];
    private $legend;

    public function __construct($legend = null, callable $callback)
    {
        $this->legend = $legend;
        $callback($this);
    }

    public function name()
    {
        return isset($this->legend) ? $this->legend : null;
    }
}

