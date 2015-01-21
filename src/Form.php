<?php

namespace Formulaic;
use ArrayObject;
use ErrorException;

abstract class Form extends ArrayObject
{
    use Attributes;
    use Form\Tostring;

    /*
    protected $errors = [], $action = '', $class = null, $sources = [],
              $placeholders = false;
    */
    protected $attributes = [];

    public function prepare()
    {
        if ($this->hasFiles()) {
            $this->attributes += ['enctype' => 'multipart/form-data'];
        }
        if ($class = $this->classname()) {
            $this->attributes += compact('class');
        }
        return $this->load();
    }

    public function load()
    {
        $data = [];
        $r = function(&$source, $keys, $key, &$values) use(&$r) {
            $keys[] = "[$key]";
            $skey = implode('', $keys);
            if (isset($this[$skey]) || !is_array($values)) {
                $source[$skey] = $values;
                return;
            }
            foreach ($values as $skey => $svalues) {
                $r($source, $keys, $skey, $svalues);
            }
        };
        foreach ($this->sources as $source) {
            if ($source != $_FILES) {
                foreach ($source as $name => $value) {
                    if (is_array($value)
                        && (!isset($this[$name])
                            || $this[$name] instanceof Media
                        )
                    ) {
                        $reduced = false;
                        foreach ($value as $key => $v) {
                            $reduced = true;
                            $r($source, [$name], $key, $v);
                        }
                        if ($reduced) {
                            unset($source[$name]);
                        }
                    }
                }
            }
            $data += $source;
        }
        foreach ($data as $name => $value) {
            if (!isset($this[$name])
                || !($this[$name] instanceof Element)
            ) {
                continue;
            }
            if ($this[$name] instanceof Radio) {
                if ($value == $this[$name]->__get('value')) {
                    $this[$name]->checked();
                } else {
                    $this[$name]->unchecked();
                }
            } else {
                $this[$name]->__set('value', $value);
            }
        }
        return $this;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function hasFiles()
    {
        foreach ($this as $key => $value) {
            if ($value instanceof File) {
                return true;
            }
        }
        return false;
    }

    public function addSource($source)
    {
        if (is_null($source)) {
            return $this;
        }
        if (is_callable($source)) {
            $source = $source();
        }
        if (!is_array($source) && is_object($source)) {
            $source = $source->getArrayCopy();
        }
        $this->sources[] = $source;
        return $this;
    }

    public function validate()
    {
        $errors = [];
        foreach ((array)$this as $name => $field) {
            if ($fielderrors = $field->getErrors()) {
                $errors[$name] = $fielderrors;
            }
        }
        return $errors ? $errors : null;
    }

    public function errors(array $errors = null)
    {
        if ($errors) {
            $this->errors = $errors;
        }
        return $this->errors;
    }

    public function offsetGet($index)
    {
        if (!isset($this[$index])) {
            foreach ((array)$this as $element) {
                if ($element->name() == $index) {
                    return $element;
                }
                if ($element instanceof Label
                    && $element->getElement()->name() == $index
                ) {
                    return $element;
                }
                if ($element instanceof Fieldset) {
                    foreach ((array)$element as $field) {
                        if ($field->name() == $index) {
                            return $field;
                        }
                    }
                }
            }
        }
    }
}

