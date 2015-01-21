<?php

namespace Formulaic\Element;

use ErrorException;
use Exception as E;

trait Tostring
{
    public function __toString()
    {
        if ($id = $this->id()) {
            $this->attributes['id'] = $id;
        }
        if ($this->prefix && isset($this->attributes['name'])) {
            $parts = $this->prefix;
            $old = $this->attributes['name'];
            $parts[] = $old;
            $start = array_shift($parts);
            $this->attributes['name'] = $start;
            foreach ($parts as $part) {
                $this->attributes['name'] .= "[$part]";
            }
        }
        $out = '<input'.$this->attributes().'>';
        if (isset($old)) {
            $this->attributes['name'] = $old;
        }
        return $out;
    }
}

