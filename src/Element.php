<?php

namespace Formulaic;

abstract class Element implements Labelable
{
    use Element\Tostring;
    use Element\Identify;
    use Element\Wrap;
    use Attributes;
    use Validate\Test;
    use Validate\Required;
    use Validate\Element;
    use Bindable;

    private $tests = [];
    private $userInput = false;
    protected $prefix = [];
    protected $attributes = [];
    protected $value = null;

    /**
     * Constructor. The element's name is optional, but is usually something
     * you'll want to provide.
     *
     * @param string $name The element's name.
     */
    public function __construct($name = null)
    {
        if (isset($name)) {
            $this->attributes['name'] = $name;
        }
        $this->attributes['value'] =& $this->value;
    }

    public function getName()
    {
        return isset($this->attributes['name']) ?
            $this->attributes['name'] :
            'UNNAMED';
    }

    /**
     * Sets the current value of this element.
     *
     * @param mixed $value The new value.
     * @return Element $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        if (isset($this->model)) {
            $this->model->{$this->attributes['name']} = $value;
        }
        return $this;
    }

    /**
     * Sets the current value of this element, but only if not yet supplied.
     *
     * @param mixed $value The new (default) value.
     * @return Element $this
     */
    public function setDefaultValue($value)
    {
        if (!$this->userInput) {
            $this->setValue($value);
        }
        return $this;
    }

    /**
     * Gets or sets the origin of the current value (user input or bound).
     * Normally, you won't need to call this directly since Formulaic handles
     * data binding transparently.
     *
     * @param mixed $status null to get, true or false to set.
     * @return boolean The current status (true for user input, false for
     *                 undefined or bound from a model object).
     */
    public function valueSuppliedByUser($status = null)
    {
        if (isset($status)) {
            $this->userInput = (bool)$status;
        }
        return $this->userInput;
    }

    /**
     * Gets a reference to the current value.
     *
     * @return mixed The value.
     */
    public function & getValue()
    {
        return $this->value;
    }

    /**
     * This is here to avoid the need to check instanceof Label.
     *
     * @return Element $this
     */
    public function getElement()
    {
        return $this;
    }

    /**
     * Sets the elements disabled state. Note that this doesn't necessarily
     * make sense for all elements, always (e.g. type="hidden").
     *
     * @param boolean $state True for disabled, false for enabled.
     * @return Element $this
     */
    public function disabled($state = true)
    {
        $this->attributes['disabled'] = $state;
        return $this;
    }

    /**
     * Sets the placeholder text. Note that this doesn't necessarily make sense
     * for all elements (e.g. type="radio").
     *
     * @param string $text The placeholder text.
     * @return Element $this
     */
    public function placeholder($text)
    {
        $this->attributes['placeholder'] = $text;
        return $this;
    }

    /**
     * Sets the tabindex. Note that the element can't know if the supplied value
     * makes sense (e.g. is unique in the form), that's up to you.
     *
     * @param int $tabindex The tabindex to use.
     * @return Element $this
     */
    public function tabindex($tabindex)
    {
        $this->attributes['tabindex'] = (int)$tabindex;
        return $this;
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

