<?php

namespace Formulaic;

class Fieldset extends Element\Group
{
    use Attributes;
    use Fieldset\Tostring;
    use Element\Identify;

    protected $attributes = [];
    private $legend;
    private $prefix = [];
    private $prefixId = null;

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

