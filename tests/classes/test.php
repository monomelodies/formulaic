<?php

use Formulaic\Get;
use Formulaic\Simple;
use Formulaic\Text;
use Formulaic\Button\Submit;
use Formulaic\Fieldset;

class EmptyForm extends Get
{
}

class SimpleForm extends Get
{
    public function __construct()
    {
        $this[] = new Text;
        $this[] = new Submit;
    }
}

class FieldsetForm extends Get
{
    public function __construct()
    {
        $this[] = new Fieldset('Hello world!', function($fieldset) {
            $fieldset[] = new Text;
        });
    }
}

class SimpleFormWithName extends Get
{
    public function __construct()
    {
        $this[] = new Text('mytextfield');
    }
}

