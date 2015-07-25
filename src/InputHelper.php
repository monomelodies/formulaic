<?php

namespace Formulaic;

use DomainException;

trait InputHelper
{
    public function source($source)
    {
        if (is_null($source)) {
            return $this;
        }
        if (is_callable($source)) {
            $source = $source();
        }
        if (is_scalar($source)) {
            throw new DomainException(
                <<<EOT
InputHelper::source must be called with an object, a callable returning an array
or an object, or an array that can be casted to StdClass. The resulting object
must contain publicly accessible key/value pairs of data.
EOT
            );
        }
        if (is_array($source)) {
            $source = (object)$source;
        }
        foreach ($source as $name => $value) {
            if ($field = $this[$name]) {
                $source->$name =& $field->getValue($name);
            }
        }   
        return $this;
    }
}

