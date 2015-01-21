<?php

namespace Formulaic\Radio;

use Formulaic;
use ArrayObject;

class Group extends ArrayObject
{
    use Formulaic\Attributes;
    use Formulaic\Validate\Group;
    use Group\Tostring;
    
    protected $attributes = [];
    
    public function __construct($name, $options)
    {
        if (is_callable($options)) {
            $options($this);
        } else {
            foreach ($options as $value => $txt) {
                $option = new Formulaic\Radio;
                $option->setValue($value);
                $this[] = new Formulaic\Label($txt, $option);
            }
        }
    }
}

