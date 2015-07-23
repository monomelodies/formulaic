<?php

namespace Formulaic\Checkbox;

use Formulaic\Radio;

class Group extends Radio\Group
{
    use Group\Tostring;

    public function populate()
    {
        parent::populate();
        $source = end($this->source);
        if (!$source) {
            return;
        }
        foreach ((array)$this as $element) {
            if (in_array($element->getValue(), $source->{$this->name()})) {
                $element->check();
            } else {
                $element->check(false);
            }
        }
    }
}

