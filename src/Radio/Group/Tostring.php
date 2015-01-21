<?php

namespace Formulaic\Radio\Group;

trait Tostring
{
    public function __toString()
    {
        $out = '<div>';
        if (count((array)$this)) {
            $out .= "\n";
            foreach ((array)$this as $element) {
                $out .= "$element\n";
            }
        }
        $out .= '</div>';
        return $out;
    }
}

