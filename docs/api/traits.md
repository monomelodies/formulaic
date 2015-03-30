# Traits

The various supplied `Tostring` traits are not documented since they're pretty
self-explanatory we think.

## `Attributes`

### `Attributes::attributes(void)`

Render a string of `name="value"` attributes based on the current element's
settings. Returns the rendered string.

### `Attributes::attribute(string $name, mixed $value)`

Set the attribute `$name` to `$value`. Use `false` to unset the attribute.

## `Element\Identify`

### `Element\Identify::prefix(string $prefix)`

Prefix the element name with a string. Useful when grouping elements, but mostly
should get called automatically.

### `Element\Identify::prefixId(string $prefix)`

Prefix the element ID with a string. Useful to ensure unique IDs on a page,
usually by prepending the form name.

### `Element\Identify::name(void)`

Returns the element's name.

### `Element\Identify::id(void)`

Returns the element's ID. This is essentially the name with illegal characters
replaced by hyphens, e.g. `my[element][name]` becomes `my-element-name`.

## `InputHelper`

### `InputHelper::populate(void)`

(Re)populate all elements in a form or group with the supplied data.

### `InputHelper::source(mixed $source)`

Set the source for this group of elements. Keys should match element names,
except for instances of `Formulaic\Radio\Group` where they don't matter.

You can pass a callable with will first get executed and should return a hash.

In rare cases (like a `Radio\Group`), `$source` should be a scalar, not an array
(since only one radio button in a group can be checked at the same time anyway).

## `QueryHelper`

### `QueryHelper::offsetGet(mixed $index)`

Attempt to get an element in the group that matches `$index`. Classes
implementing this trait allow accessing elements by name, e.g.

    <?php

    $form[] = new Text('foo');
    echo $form['foo'];

## `Validate\Required`

### `Validate\Required::isRequired(void)`

Marks the element as required.

## `Validate\Element`

### `Validate\Element::valid(void)`

Returns `true` if the element passes all its tests, `false` otherwise.

### `Validate\Element::errors(void)`

Returns an array of errors, or `null` if all tests passed.

## `Validate\Group`

### `Validate\Group::valid(void)`

Returns `true` if all elements in the group pass all tests, `false` otherwise.

### `Validate\Group::errors(void)`

Returns an array of errors, or `null` if all tests passed.

## `Validate\Test`

### `Validate\Test::addTest(string $name, callable $fn)`

Add the test `$fn` to the element under the name `$name`. The callback takes a
single argument (the element's current value) and should return `true` if the
test passed, `false` otherwise.
