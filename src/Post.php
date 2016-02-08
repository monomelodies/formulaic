<?php

namespace Formulaic;

/**
 * Implements a POST-form. The method and source default to that. You could
 * override the method, but that would not make sense. Elements are
 * automatically populated from `$_POST` and/or `$_FILES`.
 */
abstract class Post extends Form
{
    /**
     * Returns the default string representation of this form.
     *
     * @return string The form as '<form>...</form>'.
     * @see Formulaic\Form::__toString
     */
    public function __toString()
    {
        foreach ((array)$this as $field) {
            if ($field->getElement() instanceof File) {
                $this->attributes['enctype'] = 'multipart/form-data';
            }
        }
        $this->attributes['method'] = 'post';
        return parent::__toString();
    }

    /**
     * Adds an item to the form, checking to see if its $_POST or $_FILES
     * variant exists and if so, uses that as the value.
     *
     * @param integer|string|null $index The index to set the new item at.
     * @param mixed $item An element or a label containing one.
     * @return void
     */
    public function offsetSet($index, $item)
    {
        $name = $item->getElement()->name();
        if ($item->getElement() instanceof File) {
            if (array_key_exists($name, $_FILES)) {
                $item->getElement()->setValue($_FILES[$name]);
                $item->getElement()->valueSuppliedByUser(true);
            }
        } elseif (array_key_exists($name, $_POST)) {
            $item->getElement()->setValue($_POST[$name]);
            $item->getElement()->valueSuppliedByUser(true);
        }
        parent::offsetSet($index, $item);
    }
}

