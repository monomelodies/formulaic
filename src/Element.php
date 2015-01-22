<?php

namespace Formulaic;

abstract class Element
{
    use Element\Tostring;
    use Element\Identify;
    use Attributes;
    use Validate\Test;
    use Validate\Required;
    use Validate\Element;

    private $tests = [];
    private $prefixId = null;
    protected $prefix = [];
    protected $attributes = [];
    protected $value = null;

    public function __construct($name = null)
    {
        if (isset($name)) {
            $this->attributes['name'] = $name;
        }
        $this->attributes['value'] =& $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function disabled($set = true)
    {
        $this->attributes['disabled'] = $set;
        return $this;
    }

    public function placeholder($text)
    {
        $this->attributes['placeholder'] = $text;
        return $this;
    }

    public function tabindex($tabindex)
    {
        $this->attributes['tabindex'] = (int)$tabindex;
    }

    /** The field must equal the value supplied. */
    public function isEqualTo($test)
    {
        return $this->addTest('equals', function ($value) use ($test) {
            return $value == $test;
        });
    }

    /** The field must NOT equal the value supplied. */
    public function isNotEqualTo($test)
    {
        return $this->addTest('differs', function ($value) use ($test) {
            return $value != $test;
        });
    }
}

