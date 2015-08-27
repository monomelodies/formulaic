[API Index](ApiIndex.md)


Formulaic\Post
---------------


**Class name**: Post

**Namespace**: Formulaic

**This is an abstract class**

**Parent class**: [Formulaic\Form](Formulaic-Form.md)





    

    





Properties
----------


**$attributes**





    protected  $attributes = array()






**$source**





    private  $source = array()






Methods
-------


public **__toString** (  )











--

public **offsetSet** ( $index, $newvalue )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $index | mixed |  |
| $newvalue | mixed |  |

--

public **name** (  )


Return the form name if set, or null.








--

public **getArrayCopy** (  )


Returns the current form as an array of key/value pairs with data.








--

public **bind** ( $model )


Binds a $model object to this form.

$model can be any object. All its public properties are looped over, and
the values are bound to those of the form if they exist on the form.
For form elements that have not been initialized from user input, the
value is set to the current model&#039;s value too. This allows you to provide
defaults a user can edit (e.g. update the property &quot;name&quot; on a User
model).






**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $model | mixed |  |

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

public **valid** (  )











--

public **errors** (  )











--

private **privateErrors** (  )











--

public **offsetGet** ( $index )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $index | mixed |  |

--

public **append** ( $newvalue )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $newvalue | mixed |  |

--

[API Index](ApiIndex.md)
