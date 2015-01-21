<?php

class ElementTest extends PHPUnit_Framework_TestCase
{
    public function testButton()
    {
        $this->expectOutputString('<button type="button">B</button>');
        $button = new Formulaic\Button('B');
        echo $button;
    }

    public function testButtonReset()
    {
        $this->expectOutputString('<button type="reset">B</button>');
        $button = new Formulaic\Button\Reset('B');
        echo $button;
    }

    public function testButtonSubmit()
    {
        $this->expectOutputString('<button type="submit">B</button>');
        $button = new Formulaic\Button\Submit('B');
        echo $button;
    }

    public function testCheckbox()
    {
        $this->expectOutputString('<input type="checkbox" value="1">');
        $input = new Formulaic\Checkbox;
        $input->setValue(1);
        echo $input;
    }

    public function testPassword()
    {
        $this->expectOutputString('<input type="password">');
        $input = new Formulaic\Password;
        $input->setValue('secret');
        echo $input;
    }

    public function testRadio()
    {
        $this->expectOutputString('<input type="radio" value="1">');
        $input = new Formulaic\Radio;
        $input->setValue(1);
        echo $input;
    }

    public function testText()
    {
        $this->expectOutputString('<input type="text" value="&quot;">');
        $input = new Formulaic\Text;
        $input->setValue('"');
        echo $input;
    }

    public function testTextarea()
    {
        $this->expectOutputString('<textarea>&quot;</textarea>');
        $input = new Formulaic\Textarea;
        $input->setValue('"');
        echo $input;
    }
}

