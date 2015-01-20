<?php

namespace Formulaic;

use Improse\Render\Html;

class View
{
    protected $form;

    public function __construct($language, $class)
    {
        $class = str_replace('-', '\\', $class);
        $this->form = new $class;
    }

    public function __invoke()
    {
        $html = new Html($_GET['view'].'.php');
        $html(['form' => $this->form]);
    }
}

