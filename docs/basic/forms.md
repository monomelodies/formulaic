# Create forms

Create a form by defining and instantiating a class extending one of the
supplied template classes `Formulaic\Get` or `Formulaic\Post`:

    <?php

    class MyForm extends Formulaic\Get
    {
    }

Formulaic forms extend the `ArrayObject` class, so to add fields simply assign
them (this could also be done "on the fly" after instantiation). Formulaic
places no restrictions on _what_ you add to the form, but usually you'll want to
either use or extend one of the supplied types. But in theory it could be
anything offering a similar interface. Note that some utility methods type check
the fields added, though.

    <?php

    // ...inside class definition of course...
    public function __construct()
    {
        // We usually do this in the constructor, since normally forms have a
        // fixed amount of fields.
        $this[] = new Formulaic\Text('mytextfield');
    }

Have a browse through all the types supplied. Formulaic won't complain if you do
something illegal (like adding a `Formulaic\Option` outside of a
`Formulaic\Select`) so it's up to you to add sensible stuff.

At the most basic level, you can now do a `__toString` on your form instance:

    <?php

    $form = new MyForm;
    echo $form;

## Adding fieldsets

Adding fieldsets works similar. The first argument to the `Fieldset` constructor
is the legend (set to `null` to ignore), the second argument is a callback
taking a single parameter: your new fieldset. Hence:

    <?php

    public function __construct()
    {
        $this[] = new Formulaic\Fieldset('The legend', function($fieldset) {
            $fieldset[] = new Formulaic\Text('mytextfield');
        });
    }

## Adding labels

Adding a label to a form element is good practice from a usability perspective.
Formulaic makes this, of course, easy:

    <?php

    // ...in constructor...
    $this[] = new Formulaic\Label(
        'Check out this field!',
        new Formulaic\Text('mytextfield')
    );

Now, this will work as expected:

    <?php

    echo $form['mytextfield']; // echoes label with input
    echo $form['Check out this field!']; // same

The default `__toString` implementation is to echo the label first, then the
field, except for checkbox-style elements which are inverted.

## Manual output

Quite often, the extremely simple `__toString` Formulaic supplies for forms
won't cut it. Luckily, you can directly access your `$form` instance:

    <form>
        <?=$form[0]?>
    </form>

Or, which is usually more convenient:

    <form>
        <?=$form['mytextfield']?>
    </form>

This recurses through any fieldsets your form has.

## Custom attributes

Form elements offer a variety of useful helpers depending on their type, but
they also all expose a lower level helper call `Element::attribute`. Simply use
this to register HTML attributes on your form, fieldset, button or element:

    <?php

    //... in constructor...
    $this[] = (new Text)->attribute('data-something', 'foo');

Most helper methods are _chainable_, meaning they simply return `$this`. (The
validation test methods are a notable exception.)
