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

### `Element\Identify::name(void)`
Returns the element's name.

### `Element\Identify::id(void)`
Returns the element's ID. This is essentially the name with illegal characters
replaced by hyphens, e.g. `my[element][name]` becomes `my-element-name`.

## `QueryHelper`

### `QueryHelper::offsetGet(mixed $index)`
Attempt to get an element in the group that matches `$index`. Classes
implementing this trait allow accessing elements by name, e.g.

```php
<?php

$form[] = new Text('foo');
echo $form['foo'];

```

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

