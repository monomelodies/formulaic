<?php

namespace Formulaic\Checkbox;

use Formulaic\Radio;

class Group extends Radio\Group
{
    use Group\Tostring;

    public function populate()
    {
        parent::populate();
        if (!is_array($this->source)) {
            return;
        }
        foreach ((array)$this as $element) {
            if (in_array($element->getValue(), $this->source)) {
                $element->check();
            } else {
                $element->check(false);
            }
        }
    }
}

