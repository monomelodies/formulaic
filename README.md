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
            $this[] = (new Search)->isRequired();
            $this[] = new Submit('submit', 'Go!');
        }
    }

In your template, either use the API to manually tweak your output, or simply
`__toString` the form to use the defaults:

    <?php

    $form = new MyForm;
    echo $form;

You can `__toString` individual fields:

    <?php

    $form = new MyForm;

    ?>
    <form name="search" method="get">
        <!-- These two yield identical output: -->
        <?=$form[0]?>
        <?=$form->field('q')?>
    </form>

To validate your form:

    <?php

    $form = new MyForm;
    if ($form->valid()) {
        // ...Perform the search...
    }

To get a list of errors:

    <?php

    $form = new MyForm;
    if ($errors = $form->errors()) {
        // ...Do error handling, or give feedback...
    }

Forms can contain fieldsets:

    <?php

    use Formulaic\Get;
    use Formulaic\Simple;

    class MyForm extends Get implements Simple
    {
        public function __construct()
        {
            $this[] = new Fieldset('Global search', function($fieldset) {
                $fieldset[] = new Search('q');
            });
            $this[] = new Fieldset('Search by ID', function($fieldset) {
                $fieldset[] = new Search('id');
            });
            $this[] = new Submit('Go!');
        }
    }

And in your output:

    <form method="get">
        <?=$form->fieldset('Global search')?>
        <?=$form->fieldset('Search by ID')?>
        <?=$form->button('submit')?>
    </form>

See the full documentation for all other options: (link)
