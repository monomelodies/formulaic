<?php

use Formulaic\Get;
use Formulaic\Simple;
use Formulaic\Text;
use Formulaic\Button\Submit;

class EmptyForm extends Get implements Simple
{
}

class SimpleForm extends Get implements Simple
{
    public function __construct()
    {
        $this[] = new Text;
        $this[] = new Submit;
    }
}

