# Forms

## `Form`

`Form` is an abstract, generic form class. Usually, you'll want to use either
`Get` or `Post`.

### `protected Form::name`

Returns the name of the form, if supplied.

## `Get`

Implements a GET-form. The method and source default to that and cannot be
overriden.

## `Post`

Implements a POST-form. The method and source default to that and cannot be
overriden. Also, it sets an `enctype="multipart/form-data"` attribute if the
form contains one or more file inputs.
