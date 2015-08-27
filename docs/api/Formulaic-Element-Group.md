[API Index](ApiIndex.md)


Formulaic\Element\Group
---------------


**Class name**: Group

**Namespace**: Formulaic\Element


**Parent class**: ArrayObject





    

    



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


**$prefix**





    private  $prefix = array()






**$name**





    private  $name






**$value**





    private  $value = array()






**$htmlBefore**





    protected  $htmlBefore = null






**$htmlAfter**





    protected  $htmlAfter = null






**$htmlGroup**





    protected  $htmlGroup = 4






Methods
-------


public **__construct** ( $name,  $callback )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $name | mixed |  |
| $callback | callable |  |

--

public **prefix** ( $prefix )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $prefix | mixed |  |

--

public **name** (  )











--

public **setValue** ( $value )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $value | mixed |  |

--

public **setDefaultValue** ( $value )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $value | mixed |  |

--

public **getValue** (  )











--

public **getElement** (  )


Convenience method to keep our interface consistent.








--

public **__toString** (  )











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
