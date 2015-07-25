# Forms

## `Form`
`Form` is an abstract, generic form class. Usually, you'll want to use either
`Get` or `Post`.

### `protected Form::name`
Returns the name of the form, if supplied.

### `public Form::getArrayCopy`
Return an array of key/value pairs of the form's current state. Useful is you're
not working with bound models.

### `public Form::bind(object $model)`
Binds the `$model` to the form, so that values supplied to the form are
persisted to the corresponding public members in the model. Returns `$this`.

## `Get`

Implements a GET-form. The method and source default to that and cannot be
overriden.

## `Post`

Implements a POST-form. The method and source default to that and cannot be
overriden. Also, it sets an `enctype="multipart/form-data"` attribute if the
form contains one or more file inputs.
