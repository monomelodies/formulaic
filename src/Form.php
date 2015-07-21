<?php

namespace Formulaic;

use ArrayObject;

abstract class Form extends ArrayObject
{
    use Attributes;
    use Form\Tostring;
    use Validate\Group;
    use InputHelper;
    use QueryHelper;

    protected $attributes = [];
    private $source = [];

    public function name()
    {
        return isset($this->attributes['name']) ?
            $this->attributes['name'] :
            null;
    }
}

