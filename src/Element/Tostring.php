<?php

namespace Formulaic\Element;

trait Tostring
{
    public function __toString()
    {
        if ($id = $this->id()) {
            $this->attributes['id'] = $id;
        }
        if (isset($this->attributes['name'])
            && !is_bool($this->attributes['name'])
        ) {
            $old = $this->attributes['name'];
            $parts = $this->prefix;
            array_shift($parts);
            $parts[] = $old;
            $start = array_shift($parts);
            $this->attributes['name'] = $start;
            foreach ($parts as $part) {
                if (!is_bool($part)) {
                    $this->attributes['name'] .= "[$part]";
                }
            }
        }
        if (isset($this->attributes['name'])
            && is_bool($this->attributes['name'])
        ) {
            $old = $this->attributes['name'];
            unset($this->attributes['name']);
        }
        $out = $this->htmlBefore;
        $out .= '<input'.$this->attributes().'>';
        $out .= $this->htmlAfter;
        if (isset($old)) {
            $this->attributes['name'] = $old;
        }
        return $out;
    }
}

