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

    public function prepare($name, array $options = [])
    {
        $this->name = $name;
        $this->id = isset($options['id']) ?
            $options['id'] :
            self::nameToId($name);
        $options += ['name' => $name, 'id' => $this->id];
        $this->attributes = $options + $this->attributes;
    }

    public function prependFormname($id)
    {
        if (isset($this->attributes['id'])) {
            $this->id = $this->attributes['id'] = "$id-{$this->attributes['id']}";
        } else {
            $this->id = self::nameToId("{$id}[{$this->name}]");
        }
    }

    public function __get($name)
    {
        if ($name != 'value') {
            return null;
        }
        if (!(isset($this->attributes['required'])
            && $this->attributes['required']
        )) {
            if (is_scalar($this->value) && !strlen(trim($this->value))) {
                return null;
            }
            if (is_array($this->value) && !strlen(implode('', $this->value))) {
                return null;
            }
        }
        return $this->value;
    }

    public function __set($name, $value)
    {
        if ($name != 'value') {
            return null;
        }
        if (!(isset($this->attributes['required'])
            && $this->attributes['required']
        )) {
            if ((is_array($value) && !$value)
                || (!is_array($value) && !strlen(trim($value)))
            ) {
                $value = null;
            }
        }
        $this->original = $this->value;
        $this->value = $value;
        unset($this->attributes[$name]);
        return $value;
    }

    public static function nameToId($name)
    {
        $name = preg_replace('/[\W]+/', '-', $name);
        return trim(preg_replace('/[-]+/', '-', $name), '-');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function disabled($set = true)
    {
        return $this->setOption('disabled', $set);
    }

    public function addClass($class)
    {
        $classes = [];
        if (isset($this->attributes['class'])) {
            $classes = explode(' ', $this->attributes['class']);
        }
        $classes = array_unique(array_merge($classes, explode(' ', $class)));
        $this->attributes['class'] = implode(' ', $classes);
    }

    public function setPlaceholder($text)
    {
        $this->attributes['placeholder'] = $text;
        return $this;
    }

    public function setParent($form)
    {
        $this->parent = is_object($form) ? get_class($form) : $form;
    }

    public function setTabindex($tabindex)
    {
        $this->attributes['tabindex'] = (int)$tabindex;
    }

    public function addTest($fn)
    {
        $this->tests[] = $fn;
        return $this;
    }

    public function null()
    {
        $this->nullAllowed = true;
        return $this;
    }

    public function nullAllowed()
    {
        return !(isset($this->attributes['required'])
            && $this->attributes['required']);
    }

    public function isDisabled()
    {
        return isset($this->attributes['disabled']) && $this->attributes['disabled'];
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
        $this->renderOptions[] = 'required';
        $error = self::ERROR_MISSING;
        return $this->addTest(function($value) use ($error) {
            if (is_array($value)) {
                return $value ? null : $error;
            }
            return strlen(trim($value)) ? null : $error;
        });
    }

    /** The field must contain an integer. */
    public function isInteger()
    {
        $error = self::ERROR_INVALID;
        return $this->addTest(function($value) use ($error) {
            return $value == (int)$value ? null : $error;
        });
    }

    /** The field must contain a number greater than zero. */
    public function isGreaterThanZero()
    {
        $error = self::ERROR_INVALID;
        return $this->addTest(function($value) use ($error) {
            return (float)$value > 0 ? null : $error;
        });
    }

    /** The field must equal the value supplied. */
    public function isEqualTo($test)
    {
        $error = self::ERROR_NOMATCH;
        return $this->addTest(function($value) use ($error, $test) {
            return $value == $test ? null : $error;
        });
    }

    /** The field must NOT equal the value supplied. */
    public function isNotEqualTo($test)
    {
        $error = self::ERROR_MATCH;
        return $this->addTest(function($value) use ($error, $test) {
            return $value != $test ? null : $error;
        });
    }

    /** The field must match another field in the supplied form. */
    public function matchesField(Form $form, $name)
    {
        $error = self::ERROR_NOMATCH;
        $this->attributes['data-equals'] = $form[$name]->getName();
        return $this->addTest(function($value) use ($error, $form, $name) {
            return $value == $form[$name]->value ? null : $error;
        });
    }

    /** The field shouldn't match another field in the supplied form. */
    public function differsFromField(Form $form, $name)
    {
        $error = self::ERROR_MATCH;
        $this->attributes['data-notequals'] = $form[$name]->getName();
        return $this->addTest(function($value) use ($error, $form, $name) {
            if (!isset($form[$name]->value)) {
                return null;
            }
            return $value != $form[$name]->value ? null : $error;
        });
    }

    /** The field must match the pattern supplied. */
    public function mustMatch($pattern)
    {
        $error = self::ERROR_INVALID;
        $this->attributes['pattern'] = $pattern;
        return $this->addTest(function($value) use ($error, $pattern) {
            if (!strlen(trim($value))) {
                return null;
            }
            return preg_match("@^$pattern$@", trim($value)) ? null : $error;
        });
    }

    /** The maximum length of the field. */
    public function maxLength($length, $size = null)
    {
        $error = self::ERROR_INVALID;
        if (!isset($size)) {
            $size = min(32, $length);
        }
        $this->attributes['maxlength'] = (int)$length;
        $this->attributes['size'] = (int)$size;
        return $this->addTest(function($value) use ($error, $length) {
            return mb_strlen(trim($value), 'UTF-8') <= (int)$length ?
                null :
                $error;
        });
    }
    /** }}} */

    public function hasMaxLength()
    {
        return isset($this->attributes['maxlength']) ?
            $this->attributes['maxlength'] :
            null;
    }

    public function valid()
    {
        return $this->errors() ? false : true;
    }

    public function errors()
    {
        $errors = [];
        foreach ($this->tests as $test) {
            if ($error = $test($this->value)) {
                if ($error != 'missing' && !isset($this->value)) {
                    // Empty elements that aren't required shouldn't
                    // throw errors.
                    continue;
                }
                $errors[] = $error;
            }
        }
        return $errors ? $errors : null;
    }
}

