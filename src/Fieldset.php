<?php

namespace Formulaic;

use ArrayObject;

class Fieldset extends ArrayObject
{
    use Attributes;
    use Fieldset\Tostring;
    use Validate\Group;
    use Element\Identify;

    protected $attributes = [];
    private $legend;
    private $prefix;

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

