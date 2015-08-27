[API Index](ApiIndex.md)


Formulaic\Bitflag
---------------


**Class name**: Bitflag

**Namespace**: Formulaic


**Parent class**: [Formulaic\Checkbox\Group](Formulaic-Checkbox-Group.md)





    

    



Constants
----------


### WRAP_GROUP

    const WRAP_GROUP = 1





### WRAP_LABEL

    const WRAP_LABEL = 2





### WRAP_ELEMENT

    const WRAP_ELEMENT = 4





Properties
----------


**$value**





    private  $value = array()






**$model**





    private  $model






**$attributes**





    protected  $attributes = array()






**$tests**





    protected  $tests = array()






**$source**





    protected  $source = array()






**$prefix**





    private  $prefix = array()






**$name**





    private  $name






**$htmlBefore**





    protected  $htmlBefore = null






**$htmlAfter**





    protected  $htmlAfter = null






**$htmlGroup**





    protected  $htmlGroup = 4






Methods
-------


public **setValue** ( $value )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $value | mixed |  |

--

public **getValue** (  )











--

public **bind** ( object $model )


Binds the element to a model.








**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $model | object | <p>The model to bind to.</p> |

--

public **isRequired** (  )











--

public **__construct** ( $name,  $callback )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $name | mixed |  |
| $callback | callable |  |

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

public **valid** (  )











--

public **errors** (  )











--

private **privateErrors** (  )











--

public **addTest** ( $name,  $fn )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $name | mixed |  |
| $fn | callable |  |

--

public **__toString** (  )











--

public **prefix** ( $prefix )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $prefix | mixed |  |

--

public **setDefaultValue** ( $value )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $value | mixed |  |

--

public **getElement** (  )


Convenience method to keep our interface consistent.








--

public **valueSuppliedByUser** ( $status )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $status | mixed |  |

--

public **wrap** ( string $before, string $after, boolean $group )


Specify HTML to wrap this element in. Sometimes this is needed for
fine-grained output control, e.g. when styling checkboxes.








**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $before | string | <p>HTML to prepend.</p> |
| $after | string | <p>HTML to append.</p> |
| $group | boolean | <p>Bitflag stating what to wrap. Use any of the
Element\Group::WRAP_* constants. Defaults to
WRAP_ELEMENT.</p> |

--

public **offsetGet** ( $index )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $index | mixed |  |

--

public **offsetSet** ( $index, $newvalue )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $index | mixed |  |
| $newvalue | mixed |  |

--

public **append** ( $newvalue )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $newvalue | mixed |  |

--

[API Index](ApiIndex.md)
