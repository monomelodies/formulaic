<?php

namespace Formulaic;

/**
 * Trait to make something bindable.
 */
trait Bindable
{
    private $model;

    /**
     * Binds the element to a model.
     *
     * @param object $model The model to bind to.
     */
    public function bind($model)
    {
        $this->model = $model;
    }
}

