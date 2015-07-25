<?php

namespace Formulaic;

use ArrayObject;

abstract class Form extends ArrayObject
{
    use Attributes;
    use Form\Tostring;
    use Validate\Group;
    use InputHelper;
    use QueryHelper;

    protected $attributes = [];
    private $source = [];

    public function name()
    {
        return isset($this->attributes['name']) ?
            $this->attributes['name'] :
            null;
    }

    /**
     * Returns the current form as an array of key/value pairs with data.
     *
     * @return array
     */
    public function getArrayCopy()
    {
        $copy = [];
        foreach ((array)$this as $key => $value) {
            $element = $value->getElement();
            if (is_object($element)
                and method_exists($element, 'name')
                and $name = $element->name()
                and !($element instanceof Button)
            ) {
                $copy[$name] = $element->getValue();
            }
        }
        return $copy;
    }

    public function bind($model)
    {
        if (is_null($model)) {
            return $this;
        }
        if (is_callable($model)) {
            $model = $model();
        }
        if (is_scalar($model)) {
            throw new DomainException(
                <<<EOT
Form::bind must be called with an object, a callable returning an array
or an object, or an array that can be casted to StdClass. The resulting object
must contain publicly accessible key/value pairs of data.
EOT
            );
        }
        if (is_array($model)) {
            $model = (object)$model;
        }
        foreach ($model as $name => $value) {
            if ($field = $this[$name] and $element = $field->getElement()) {
                if (!$element->valueSuppliedByUser()) {
                    $element->setValue($value);
                }
                $model->$name =& $field->getValue();
            }
        }
        return $this;
    }
}

