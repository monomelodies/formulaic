# Bitflags
A common operation is to have a group of checkboxes with related settings, which
are internally stored as a _bitflag_. We're not going to go into details here on
what those are, but if you don't already know:

> A byte is composed of bits, i.e. 0 or 1 values. Each zero means "no", each one
> means "yes". Hence, the operation `385 & 1` evaluates to `true`, since `1` is
> the result. Via this technique you can efficiently store a bunch of yes/no
> settings in one big integer. Computers like that kind of stuff.

Formulaic supports the special `Bitflag` element to handles these cases. It's
essentially an extension of `Checkbox\Group`, but automatically handles the
bitwise operations for all its elements.

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
$form['superhero']->setValue(7);
$form['superhero'][0]->checked(); // true
// Or reference by label:
$form['superhero']['Batman']->checked(); // true

```

## Binding models
If a model was bound, its `superhero` property will contain the "flattened"
value, i.e. `7` in the above example.

After form submit, `$_POST` or `$_GET` would be passed like so:

```php
<?php

$_POST['superhero'] = [1, 2, 4];

```

The `Bitflag` element internally turns this into a single value using binary
arithmetic.

## Skipping or combining bits
Note the `Bitflag` element does _not_ check if all supplied values are "clean"
binary numbers. This is by design; sometimes you might want to set multiple
bits in one operation (trivial example: "I have read your terms and
conditions, and also agree with occasionally receiving email" which is stored
as bits `1` and `2`, but `2` can later be turned off seperately by the user
when you're spamming them. ;)

In the same vein, your form can also "skip" bits. These bits _are_ set on the
value property, but simply cannot be turned off using the form. To clarify:

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
            1 => 'Batman',
            2 => 'Superman',
        ]);
    }
}

// On posting, the user only selected Batman from the two options:
$_POST['superhero'] = [1];
$form = new PollForm;
// Assuming the user previously selected Batman, Superman and Spiderman:
$form['superhero']->setDefaultValue(7);
echo $form['superhero']->getValue(); // 5

```

What happened is that the form _only_ caters for bits `1` and `2`, so all bits
set for `4`, `8` and `16` are ignored. Bit `2` wasn't posted, so this gets
turned off. And of course `7 & ~2 == 5`.

The underlying idea is that typically a bitflag will contain multiple yes/no
choices, but users won't want to edit them all in one form per se. So you just
pass in the complete value containing all flags, allow the user to edit those
supplied in the form, and your handler or model can just persist the resulting
value back to your storage without needing to bother about binary arithmetic
itself.

