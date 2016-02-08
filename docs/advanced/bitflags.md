# Bitflags
A common operation is to have a group of checkboxes with related settings, which
are internally stored as a _bitflag_. We're not going to go into details here on
what those are, but if you don't already know:

> A byte is composed of bits, i.e. 0 or 1 values. Each zero means "no", each one
> means "yes". Hence, the operation `385 & 1` evaluates to `true`, since `1` is
> the result. Via this technique you can efficiently store a bunch of yes/no
> settings in one big integer. Computers like that kind of stuff.

Formulaic supports the special `Bitflag` element to handles these cases. It's
essentially an extension of `Checkbox\Group`.

Let's look at a quick example:

```php
<?php

use Formulaic\Post;
use Formulaic\Bitflag;

class MyForm extends Post
{
    public function __construct()
    {
        $this[] = new Bitflag('superhero', [
            1 => 'Batman',
            2 => 'Superman',
            4 => 'Spiderman',
            8 => 'The Hulk',
            16 => 'Daredevil',
        ]);
    }
}
```

With the above example, you could do the following in your code:

```php
<?php

$form = new MyForm;
// Bits 1, 2 and 4 are on:
$form['superhero']->setValue([1, 2, 4]);
$form['superhero'][0]->checked(); // true
// Or reference by label:
$form['superhero']['Batman']->checked(); // true
```

## Binding models
If a model was bound, it is its own responsibility to convert the bound
`superhero` back into a byte if needed (Formulaic doesn't actually care about
bit values, you could use `'batman'` etc. as keys just as well).

After form submit, `$_POST` or `$_GET` would be passed like so:

```php
<?php

$_POST['superhero'] = [1, 2, 4];
```

It is a good idea for the model to be leading in this conversion so the rest of
your code doesn't have to worry about "magic" numbers.

## Undefined values
A bitflag element silently ignores unknown values tossed at it:

```php
<?php

// We want a form that just asks if we prefer Batman or Superman (e.g. for some
// poll module), but elsewhere the user is able to choose all 5 heroes (e.g. on
// a settings page).

class PollForm extends Post
{
    public function __construct()
    {
        $this[] = new Bitflag('superhero', [
            'batman' => 'Batman',
            'superman' => 'Superman',
        ]);
    }
}

// On posting, the user only selected Batman from the two options:
$_POST['superhero'] = ['batman'];
$form = new PollForm;
// Assuming the user previously selected Batman, Superman and Spiderman:
$form['superhero']->setValue(['batman', 'superman', 'spiderman']);
var_dump(isset($form['superhero']->getValue()->spiderman)); // false
```

The underlying idea is that typically a bitflag will contain multiple yes/no
choices, but users won't want to edit them all in one form per se. So you just
pass in the complete value containing all flags, allow the user to edit those
supplied in the form, and your handler or model can just persist the resulting
value object back to your storage, using only defined properties.

Note that "known" bits are available as booleans, i.e. if in the previous
example `'superman'` wasn't set, it _will_ be available as a property, only
false:

```php
<?php

var_dump(isset($form['superhero']->getValue()->superman)); // true
var_dump($form['superhero']->getValue()->superman); // false
```

