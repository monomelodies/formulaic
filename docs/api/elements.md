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

### `Element::isEqualTo(mixed $test)`
Succeeds when the value of the element matches `$test`.

### `Element::isNotEqualTo(mixed $test)`
Succeeds when the value of the element is different from `$test`.

## `Bitflag`
A group of checkboxes intended to work as a bitflag.

## `Checkbox`
An HTML checkbox.

## `Date`
An input with `type="date"`. The date format is `Y-m-d`. Extends `Datetime`.

## `Datetime`
An input with `type="datetime"`. The format is `Y-m-d H:i:s`.

### `Datetime::setValue(mixed $value)`
Set the value. Accepts a UNIX timestamp or a string parseable by `strtotime`.

### `Datetime::isInPast(void)`
Success when the value of the element is in the past.

### `Datetime::isInFuture(void)`
Succeeds when the value of the element is in the future.

### `Datetime::setMin(mixed $min)`
Minimal value for the element. Accepts the same types as `Datetime::setValue`.

### `Datetime::setMax(mixed $max)`
Maximum value for the element. Accepts the same types as `Datetime::setValue`.

## `Email`
An email input. Emails are considered valid when they pass
`filter_var($value, FILTER_VALIDATE_EMAIL)` _and_ they match `"/.*@.*\..*/"`.
The latter regex is not formally part of the specification (email addresses may
be local to a machine), but in practice is virtually always a check you'll want
to perform.

## `File`
A file input. Obviously only relevant on `Post` forms. The `enctype` attribute
is automatically set to `multipart/form-data`.

### `File::__toString(void)`
Custom `__toString` that prevents the current value being outputted (this is a
security risk and is ignored by sane browsers anyway).

## `Hidden`
Element with `type="hidden"`.

## `Number`
Element with `type="number"`.

### `Number::setMin(mixed $min)`
Set the minimum value for the element.

### `Number::setMax(mixed $max)`
Set the maximum value for the element.

### `Number::setStep(mixed $step)`
Set the step size for the element. Values are validated based on the minimum
value (or zero, if not set) increment by steps of `$step`. Hence, a minimum
value of `1` with a step size of `0.3` would give valid values of `1`, `1.3`,
`1.6`, `1.9`, `2.1`, `2.4` etc.

### `Number::isInteger(void)`
Succeeds if the value is an integer.

### `Number::isGreaterThanZero(void)`
Succeeds if the value is greater than zero.

## `Password`
Element with `type="password"`. Like `File`, the value is not outputted.

### `Password::__toString(void)`
Custom `__toString` that prevents the current value being outputted. You should
let the browser handle password autofilling.

## `Radio`
Element with `type="radio"`.

### `Radio::check(mixed $value)`
Set the checked state of the element. Usually you should use `null` (the
default) to check it, or `false` to uncheck.

### `Radio::checked(void)`
Returns `true` if the element is checked, `false` otherwise.

## `Search`
Element with `type="search"`.

## `Select`
An HTML select box.

### `Select::__construct(string $name, array|callable $options)`
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

## `Tel`
Element with `type="tel"`. Values are stripped of all non-integer characters,
and prepended with a single zero if not present yet.

## `Textarea`
Textarea element.

### `Textarea::maxlength(integer $length)`
Set the maximum length for the textarea's contents.

## `Text`
Element with `type="text"`.

### `Text::size(integer $size)`
Size of the text element.

### `Text::matchPattern(string $pattern)`
Requires the element's value to match the regular expression in `$pattern`.
Matches constrained to start/end of the value are implied, so don't wrap your
pattern in `^` and `$`.

### `Text::maxLength(integer $length)`
Maximum length of the value.

## `Url`
Element with `type="url"`. Contains a default placeholder `http://`. URLs are
considered valid if they pass `filter_var($value, FILTER_VALIDATE_URL)`. Values
are automatically prepended with `http://` if they do not contain a scheme. (You
should use Javascript to handle this on the client side; most browser
implementations require a scheme, but you can't seriously expect users to add
it).

