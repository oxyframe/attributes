<?php

use Oxyframe\Attributes;
use PHPUnit\Framework\TestCase;

class SingleAttributable
{
    use Attributes;
    public function __construct($data = "default")
    {
        $this->hasAttribute("data", $data);
    }
}

class MultiAttributable
{
    use Attributes;
    public function __construct($x = null, $y = null)
    {
        $this->hasAttribute("x");
        $this->hasAttribute("y");
    }
}

class AttributesTest extends TestCase
{
    public function testStringAttribute()
    {
        $attribute = new SingleAttributable;
        $attribute->setData("Hello World");
        $attribute->setSomethingNotAllowed("Foobar");
        $this->assertTrue($attribute->getData() == "Hello World");
        $this->assertFalse($attribute->getSomethingNotAllowed() == "Foobar");
    }
    public function testMultipleAttributes()
    {
        $attribute = new MultiAttributable;
        $attribute->setX(10);
        $attribute->setY(50);
        $this->assertTrue($attribute->getX() == 10);
        $this->assertTrue($attribute->getY() == 50);
    }
    public function testDefaultAttribute()
    {
        $attribute = new SingleAttributable;
        $this->assertTrue($attribute->getData() == "default");
    }
}
