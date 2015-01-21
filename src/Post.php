<?php

namespace Formulaic;

abstract class Post extends Form
{
    use Form\Tostring {
        Form\Tostring::__toString as private __parentToString;
    }

    protected $attributes = ['method' => 'post'];

    /*
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->addSource($_POST);
    }
    
    public function cancelled()
    {
        return isset($_POST['act_cancel']);
    }
    */

    public function __toString()
    {
        $files = false;
        foreach ((array)$this as $element) {
            if ($element instanceof Fieldset) {
                foreach ((array)$element as $field) {
                    if ($field instanceof File) {
                        $files = true;
                        break 2;
                    }
                }
            } elseif ($element instanceof Label
                && $element->element() instanceof File
            ) {
                $files = true;
            } elseif ($element instanceof File) {
                $files = true;
                break;
            }
        }
        if ($files) {
            $this->attributes += ['enctype' => 'multipart/form-data'];
        }
        return $this->__parentToString();
    }
}

