<?php

namespace Formulaic;

class Text extends Element
{
    protected $attributes = ['type' => 'text'];

    public function size($size)
    {
        $this->attributes['size'] = $size;
        return $this;
    }

    /** The field must match the pattern supplied. */
    public function matchPattern($pattern)
    {
        $this->attributes['pattern'] = $pattern;
        return $this->addTest('pattern', function ($value) use ($pattern) {
            return preg_match("@^$pattern$@", trim($value));
        });
    }
    
    /** The maximum length of the field. */
    public function maxLength($length)
    {
        $this->attributes['maxlength'] = (int)$length;
        return $this->addTest('maxlength', function($value) use ($length) {
            return mb_strlen(trim($value), 'UTF-8') <= (int)$length;
        });
    }
}

