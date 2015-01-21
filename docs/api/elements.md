# Elements

All elements use these traits: `Element\Tostring`, `Element\Identify`,
`Attributes`, `Validate\Test`, `Validate\Required`, `Validate\Element`.

## Common methods

### `Element::__construct(string $name = null)`

Constructor with optional element name.

### `Element::setValue($value)`

Sets the value of this element.

### `Element::getValue(void)`

Returns the value of this element.

### `Element::disabled(mixed $set = true)`

Set the disabled state of the element. Generally use either `true` or `null`
to disable, or `false` to enable. Elements are enabled by default.

### `Element::placeholder(string $text)`

Set the placeholder for the element. This may not make sense for certain
elements. Also note that older browsers won't support placeholders without some
polyfill.

### `Element::tabindex(integer $tabindex)`

Set the tabindex for the element. Formulaic doesn't do any checking on this, so
if it's not unique in the form the browser will have to sort it out.



## `Checkbox`

An HTML checkbox.

## `Date`

An input with `type="date"`. The date format is `Y-m-d`.

## `Select`

An HTML select box.

### `Select::__construct(string $name, array|callable $options)

`$options` can be either a key/value hash of values/descriptions, or a callable
which receives a single argument (the `Select`) which can then be filled
manually. Note that Formulaic does not check if you're actually adding options!

## `Select\Option`

### `Select\Option::__construct(mixed $value, string $label)`

Construct an option for a select with the supplied value and label. Both are
required, since an option without either would make little sense.

### `Select\Option::getName(void)`

Returns the label.

### `Select\Option::selected(void)`

Sets the option to selected.

### `Select\Option::__toString(void)`

Returns a string version of the option.
