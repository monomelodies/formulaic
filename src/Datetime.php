<?php

namespace Formulaic;

class Datetime extends Text
{
    const ERROR_DATENOTINPAST = 'notinpast';
    const ERROR_DATENOTINFUTURE = 'notinfuture';
    const ERROR_MIN = 'min';
    const ERROR_MAX = 'max';

    protected $attributes = ['type' => 'datetime'];
    protected $format = 'Y-m-d H:i:s';

    public function setValue($value)
    {
        if (!($value = strtotime($value))) {
            $value = null;
        } else {
            $value = date($this->format, $value);
        }
        return parent::setValue($value);
    }

    public function isValidDate()
    {
        $error = self::ERROR_INVALID;
        return $this->addTest(function ($value) use ($error) {
            if (!$value) {
                return null;
            }
            return strtotime($value) ? null : 'error.invalid';
        });
    }

    public function isDateInPast()
    {
        $error = self::ERROR_DATENOTINPAST;
        return $this->addTest(function ($value) use ($error) {
            return strtotime($value) < time() ?
                null :
                'error.notinpast';
        });
    }

    public function isDateInFuture()
    {
        $error = self::ERROR_DATENOTINFUTURE;
        return $this->addTest(function ($value) use ($error) {
            $e = $this->getElements();
            return strtotime($value) > time() ?
                null :
                'error.notinfuture';
        });
    }

    public function min($min)
    {
        $this->attributes['min'] = $min;
        $error = self::ERROR_MIN;
        return $this->addTest(function ($value) use ($min) {
            return $value >= $min ? null : 'error.min';
        });
    }

    public function max($max)
    {
        $this->attributes['max'] = $max;
        $error = self::ERROR_MAX;
        return $this->addTest(function ($value) use ($max) {
            return $value <= $max ? null : 'error.max';
        });
    }
}

