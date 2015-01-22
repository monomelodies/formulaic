<?php

use Formulaic\Get;
use Formulaic\Post;

class Form extends Get
{
}

class PostForm extends Post
{
}

class NamedForm extends Get
{
    protected $attributes = ['name' => 'test'];
}

class ComplexForm extends Post
{
    public function __construct()
    {
        $this[] = new Formulaic\Label(
            'Test',
            (new Formulaic\Text('foo'))->isRequired()
        );
        $this[] = new Formulaic\Label(
            'Group of radio buttons',
            (new Formulaic\Radio\Group('radios', [1 => 'foo', 2 => 'bar']))
        );
        $this[] = new Formulaic\Label(
            'Group of checkboxes',
            (new Formulaic\Checkbox\Group(
                'checkboxes',
                [1 => 'foo', 2 => 'bar', 3 => 'baz']
            ))
        );
    }
}

