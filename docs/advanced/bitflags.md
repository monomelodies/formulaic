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

