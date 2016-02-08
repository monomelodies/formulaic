<?php

namespace Formulaic;

use ArrayObject;
use DomainException;
use JsonSerializable;

/**
 * The base Form class.
 */
abstract class Form extends ArrayObject implements JsonSerializable
{
    use Attributes;
    use Form\Tostring;
    use Validate\Group;
    use QueryHelper;

    /**
     * Hash of key/value pairs for HTML attributes.
     */
    protected $attributes = [];

    /**
     * Return the form name if set, or null.
     *
     * @return string|null The name, or null.
     */
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

    /**
     * Returns a `json_encode`able hash.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $copy = [];
        foreach ((array)$this as $key => $value) {
            $element = $value->getElement();
            if (is_object($element)
                and method_exists($element, 'name')
                and $name = $element->name()
            ) {
                $copy[$name] = $value;
            }
            $copy[$key] = $value;
        }
        return $copy;
    }

    /**
     * Binds a $model object to this form.
     *
     * $model can be any object. All its public properties are looped over, and
     * the values are bound to those of the form if they exist on the form.
     * For form elements that have not been initialized from user input, the
     * value is set to the current model's value too. This allows you to provide
     * defaults a user can edit (e.g. update the property "name" on a User
     * model).
     *
     * @param object The model to bind.
     * @return Form $this
     */
    public function bind($model)
    {
        if (!is_object($model)) {
            throw new DomainException(
                <<<EOT
Form::bind must be called with an object containing publicly accessible
key/value pairs of data.
EOT
            );
        }
        foreach ($model as $name => $value) {
            if ($field = $this[$name] and $element = $field->getElement()) {
                $curr = $element->getValue();
                $userSupplied = $element->valueSuppliedByUser();
                if ($value) {
                    $element->setValue($value);
                }
                if ($userSupplied) {
                    $element->setValue($curr);
                    $model->$name = $element->getValue();
                }
                $element->bind($model);
            }
        }
        return $this;
    }
}

