# Input and validation

Before doing anything to your form's contents on page load, you'll want to
validate the data passed in. _Never trust user input._ Form validation can
normally be a quite tedious process, but Formulaic makes it easy.

```php
<?php

//...inside constructor...
$this[] = (new Formulaic\Text('mytextfield'))->isRequired();

//...inside handling code, e.g. a Model of sorts:
if ($form->valid()) {
    // All okay! Do something with the form data...
} else {
    $errors = $form->errors();
    // $errors is now an array of errors you can handle accordingly.
}

```

Some tests are shared among all elements, some are element-specific. Refer to
the API documentation for a list of all options.

Tests are added to elements using the `Element::addTest` method, which you can
also call directly to write custom tests with your specific business logic.
Adding a test is simple:

```php
<?php

$this[] = (new Formulaic\Text('mycustomlogic'))->addTest(
    'notokay',
    function($value) {
        return isThisOkay();
    }
);

```

The callback receives the element's current value and should return true if the
test passes, or else false. The name of the test is the error returned, so you
should give it a descriptive value. Note that subsequent tests of the same name
overwrite existing tests.

## Loading data

But how does your form know what data it needs to validate? Remember how we've
been extending the `Formulaic\Get` base class? It won't surprise you to learn
there is also a `Formulaic\Post`. These define `$_GET` and `$_POST` as a
"source", respectively. For Formulaic forms, a "source" is anything that looks
like a hash of key/value pairs.

Whenever you're ready to fill your form with data, call `Form::populate()`. This
will transfer the current contents of the form source into its elements. Prior
to population, all elements will be empty.

## Specifying default values

Another common use-case is to set default values. Imagine a form for an
authenticated user that allows her to change, say, her date of birth. This is
where things normally get a bit tricky:

- The default value should be the currently known date of birth;
- On submission, and when failing validation (e.g. because the date is in the
  future, which unless you're called Michael J. Fox is impossible), we would
  _still_ want to default to the posted value so it's obvious to the user what
  went wrong.

Instead of forcing you to write complicated `if/then/else` statements
everywhere, Formulaic allows you to add your own sources to a form.

```php
<?php

$usermodel = new UserModel;
$myuserform = new UserForm;
$myuserform->source($usermodel);

```

Formulaic doesn't add its default sources `$_GET` and `$_POST` until the very
last second, so you can add as much custom sources as you like. The elements
will get populated with values in order.

You can also specify default values directly when defining the form:

```php
<?php

$this[] = (new Formulaic\Date('dob'))->setValue('1978-07-13');

```

This could be useful for some sort of "ueber-default". Note that the `source`
method _will_ override this if supplied with an identical key and an empty
value.

## Persisting data
When adding your own models as sources, you'll typically also want to push the
submitted form data back so you can save it. Formulaic handles this
automatically for you (well, not the saving, but the persistance):

```php
<?php

$form = new MyForm;
$user = new UserModel($id); // Assuming the constructor loads data for $id
$form->source($user);
// Assuming $user has a $name propery containing "Marijn"
$_POST['name'] = 'Linus';
$form->populate();
echo $user->name; // "Linus"

```

