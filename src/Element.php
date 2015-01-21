<?php

namespace Formulaic;

use ErrorException;
use Exception as E;

abstract class Element
{
    use Element\Tostring;
    use Attributes;

    protected $name, $id, $basename, $label, $type, $options = [],
        $renderOptions = ['id', 'name', 'value', 'type'],
        $original, $parent;
    private $tests = [];
    public $selfClosing = false, $expandAttributes = false, $_Label,
           $language, $config;

    protected $attributes = [];
    protected $value = null;

    public function __construct($name = null)
    {
        if (isset($name)) {
            $this->attributes['name'] = $name;
        }
        $this->attributes['value'] =& $this->value;
    }

    public function name()
    {
        return isset($this->attributes['name']) ?
            $this->attributes['name'] :
            null;
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

    public function addTest($name, callable $fn)
    {
        $this->tests[$name] = $fn;
        return $this;
    }

    public function nullAllowed()
    {
        return !(isset($this->attributes['required'])
            && $this->attributes['required']);
    }

    public function isDisabled()
    {
        return isset($this->attributes['disabled'])
            && $this->attributes['disabled'];
    }

    /**
     * {{{ Some default tests, for use in Forms. These can all be chained,
     *     e.g. $element->isRequired()->isInteger()->isGreaterThanZero();
     *     The isSomething methods therefore all return $this.
     */

    /** This is a required field. */
    public function isRequired()
    {
        $this->attributes['required'] = true;
        return $this->addTest('required', function ($value) {
            if (is_array($value)) {
                return $value;
            }
            return strlen(trim($value));
        });
    }

    /** The field must contain an integer. */
    public function isInteger()
    {
        return $this->addTest('integer', function ($value) {
            return $value === (int)$value;
        });
    }

    /** The field must contain a number greater than zero. */
    public function isGreaterThanZero()
    {
        return $this->addTest('positive', function ($value) {
            return (float)$value > 0;
        });
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

    /** The field must match the pattern supplied. */
    public function matchPattern($pattern)
    {
        $this->attributes['pattern'] = $pattern;
        return $this->addTest('pattern', function ($value) use ($pattern) {
            if (!isset($value)) {
                return true;
            }
            return preg_match("@^$pattern$@", trim($value));
        });
    }

    /** The maximum length of the field. */
    public function maxLength($length, $size = null)
    {
        if (!isset($size)) {
            $size = min(32, $length);
        }
        $this->attributes['maxlength'] = (int)$length;
        $this->attributes['size'] = (int)$size;
        return $this->addTest('maxlength', function($value) use ($length) {
            return mb_strlen(trim($value), 'UTF-8') <= (int)$length;
        });
    }
    /** }}} */

    public function valid()
    {
        return $this->errors() ? false : true;
    }

    public function errors()
    {
        $errors = [];
        foreach ($this->tests as $error => $test) {
            if (!$test($this->value)) {
                $errors[] = $error;
            }
        }
        return $errors ? $errors : null;
    }
}

