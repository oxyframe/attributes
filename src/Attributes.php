<?php

namespace Oxyframe;

trait Attributes
{
    private $attributes;
    public function hasAttribute($name, $default = null)
    {
        $this->attributes[] = $name;
        // Call me a genius but this is one beautiful hack.
        $this->{ "set" . ucfirst($name) }($default);
    }
    public function __call($function, $arguments)
    {
        $attribute = lcfirst(substr($function, 3));

        if (in_array($attribute, array_values($this->attributes))) {
            switch (substr($function, 0, 3)) {
                case 'get':
                    return $this->{$attribute};
                    break;
                case 'set':
                    $this->{$attribute} = $arguments[0];
                    return $this;
                    break;
                default:
                    break;
            }
        }
    }
}