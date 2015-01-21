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
    public function __construct()
    {
        $this->attributes['name'] = 'test';
    }
}

