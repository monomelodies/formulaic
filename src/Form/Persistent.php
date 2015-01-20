<?php

namespace Formulaic;

class Persistent extends Post
{
    public function __construct()
    {
        parent::__construct();
        if (is_null(self::session()->get('Form'))) {
            self::session()->set('Form', []);
        }
        self::session()->set('Form', $_POST + self::session()->get('Form'));
        $this->addSource(self::session()->get('Form'));
        return parent::prepare();
    }
}

