[API Index](ApiIndex.md)


Formulaic\Button\Submit
---------------


**Class name**: Submit

**Namespace**: Formulaic\Button


**Parent class**: [Formulaic\Button](Formulaic-Button.md)





    A submit button (`type=&quot;submit&quot;`).

    





Properties
----------


**$attributes**





    protected  $attributes = array()






**$text**

The text to show in the button.



    protected  $text






**$tests**





    private  $tests = array()






**$userInput**





    private  $userInput = false






**$prefix**





    protected  $prefix = array()






**$value**





    protected  $value = null






**$htmlBefore**





    protected  $htmlBefore = null






**$htmlAfter**





    protected  $htmlAfter = null






**$model**





    private  $model






Methods
-------


public **__construct** ( string $name )


Constructor. The element&#039;s name is optional, but is usually something
you&#039;ll want to provide.








**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $name | string | <p>The element&#039;s name.</p> |

--

public **__toString** (  )











--

public **getName** (  )











--

public **setValue** ( mixed $value )


Sets the current value of this element.








**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $value | mixed | <p>The new value.</p> |

--

public **setDefaultValue** ( mixed $value )


Sets the current value of this element, but only if not yet supplied.








**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $value | mixed | <p>The new (default) value.</p> |

--

public **valueSuppliedByUser** ( mixed $status )


Gets or sets the origin of the current value (user input or bound).

Normally, you won&#039;t need to call this directly since Formulaic handles
data binding transparently.






**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $status | mixed | <p>null to get, true or false to set.</p> |

--

public **getValue** (  )


Gets a reference to the current value.








--

public **getElement** (  )


This is here to avoid the need to check instanceof Label.








--

public **disabled** ( boolean $state )


Sets the elements disabled state. Note that this doesn&#039;t necessarily
make sense for all elements, always (e.g. type=&quot;hidden&quot;).








**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $state | boolean | <p>True for disabled, false for enabled.</p> |

--

public **placeholder** ( string $text )


Sets the placeholder text. Note that this doesn&#039;t necessarily make sense
for all elements (e.g. type=&quot;radio&quot;).








**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $text | string | <p>The placeholder text.</p> |

--

public **tabindex** ( integer $tabindex )


Sets the tabindex. Note that the element can&#039;t know if the supplied value
makes sense (e.g. is unique in the form), that&#039;s up to you.








**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $tabindex | integer | <p>The tabindex to use.</p> |

--

public **wrap** ( string $before, string $after )


Specify HTML to wrap this element in. Sometimes this is needed for
fine-grained output control, e.g. when styling checkboxes.








**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $before | string | <p>HTML to prepend.</p> |
| $after | string | <p>HTML to append.</p> |

--

public **isEqualTo** ( $test )


The field must equal the value supplied.








**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $test | mixed |  |

--

public **isNotEqualTo** ( $test )


The field must NOT equal the value supplied.








**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $test | mixed |  |

--

public **prefix** ( $prefix )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $prefix | mixed |  |

--

public **name** (  )











--

public **id** (  )











--

public **attributes** (  )











--

public **attribute** ( $name, $value )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $name | mixed |  |
| $value | mixed |  |

--

public **addTest** ( $name,  $fn )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $name | mixed |  |
| $fn | callable |  |

--

public **isRequired** (  )


This is a required field.








--

public **valid** (  )











--

public **errors** (  )











--

public **bind** ( object $model )


Binds the element to a model.








**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $model | object | <p>The model to bind to.</p> |

--

[API Index](ApiIndex.md)
