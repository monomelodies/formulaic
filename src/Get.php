<?php

namespace Formulaic;

class Get extends Form
{
    protected $attributes = ['method' => 'get'];

/*
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->addSource($_GET);
    }
*/

    public function cancelled()
    {
        return isset($_GET['act_cancel']);
    }

    public function getMethod()
    {
        return 'get';
    }
}

