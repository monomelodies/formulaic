# formulaic
Object-oriented form utilities for PHP5.4+

HTML forms suck. Well, no, they're superduper handy, but writing them and
validating them server-side can be a pain. Formulaic offers a set of utilities
to ease that pain.

## Basic usage

Define a form with some fields and other requirements:

    <?php

    use Formulaic\Get;
    use Formulaic\Simple;

    class MyForm extends Get implements Simple
    {
        public function __construct()
        {
            $this->add(new Search('q'))->isRequired();
            $this->add(new Submit('Go!'));
        }
    }

In your template, either use the API to manually tweak your output, or simply
`__toString` the form to use the defaults:

    <?php

    $form = new MyForm;
    echo $form;

