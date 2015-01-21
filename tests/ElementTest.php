<?php

class ElementTest extends PHPUnit_Framework_TestCase
{
    public function testDefaultTests()
    {
        $input = new Formulaic\Text;
        $this->assertTrue($input->valid());

        // Required:
        $input->isRequired();
        $input->setValue('foo');
        $this->assertTrue($input->valid());
        $input->setValue(null);
        $this->assertNotTrue($input->valid());
    }

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
        echo $input;
    }

    public function testDate()
    {
        $this->expectOutputString('<input type="date">');
        $input = new Formulaic\Date;
        echo $input;
        $input->setMin('2010-01-01')->setMax('2012-01-01');
        $input->setValue('2009-01-01');
        $this->assertNotTrue($input->valid());
        $input->setValue('2013-01-01');
        $this->assertNotTrue($input->valid());
        $input->setValue('2011-01-01');
        $this->assertTrue($input->valid());
        $input->setValue('something illegal');
        $this->assertNotTrue($input->valid());
    }

    public function testDatetime()
    {
        $this->expectOutputString('<input type="datetime">');
        $input = new Formulaic\Datetime;
        echo $input;
        $input->setMin('2009-01-01 12:00:00')->setMax('2009-01-02 12:00:00');
        $input->setValue('2009-01-01');
        $this->assertNotTrue($input->valid());
        $input->setValue('2009-01-02 13:00:00');
        $this->assertNotTrue($input->valid());
        $input->setValue('2009-01-01 13:59:00');
        $this->assertTrue($input->valid());
        $input->setValue('something illegal');
        $this->assertNotTrue($input->valid());
    }

    public function testEmail()
    {
        $this->expectOutputString('<input type="email">');
        $input = new Formulaic\Email;
        echo $input;
        $input->setValue('not an email');
        $this->assertNotTrue($input->valid());
        $input->setValue('foo@bar.com');
        $this->assertTrue($input->valid());
    }

    public function testFile()
    {
        $this->expectOutputString('<input type="file">');
        $input = new Formulaic\File;
        echo $input;
    }

    public function testNumber()
    {
        $this->expectOutputString('<input type="number" step="1" value="42">');
        $input = new Formulaic\Number;
        $input->setValue('42');
        echo $input;
        $input->setValue('foo');
        $this->assertNotTrue($input->valid());
        $input->setMin(9);
        $input->setValue(8);
        $this->assertNotTrue($input->valid());
        $input->setValue(15);
        $this->assertTrue($input->valid());
        $input->setMax(14);
        $this->assertNotTrue($input->valid());
        $input->setValue(13);
        $this->assertTrue($input->valid());
        $input->setStep(2);
        $this->assertTrue($input->valid());
        $input->setValue(12);
        $this->assertNotTrue($input->valid());
        $input->setStep(.5);
        $input->setValue(12.5);
        $this->assertTrue($input->valid());
        $input->setValue(12.4);
        $this->assertNotTrue($input->valid());
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
        echo $input;
    }

    public function testSearch()
    {
        $this->expectOutputString('<input type="search">');
        $input = new Formulaic\Search;
        echo $input;
    }

    public function testTel()
    {
        $this->expectOutputString('<input type="tel" value="0612345678">');
        $input = new Formulaic\Tel;
        $input->setValue('612345678');
        echo $input;
        $input->setValue('foo');
        $this->assertFalse($input->valid());
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

    public function testTime()
    {
        $this->expectOutputString('<input type="time" value="12:00:00">');
        $input = new Formulaic\Time;
        $input->setValue('bla');
        $this->assertNotTrue($input->valid());
        $input->setValue('12:00:00');
        $this->assertTrue($input->valid());
        echo $input;

        // Test require past time
        $input = new Formulaic\Time;
        $input->isInPast();
        $input->setValue(time() + 100);
        $this->assertNotTrue($input->valid());
        $input->setValue(time() - 100);
        $this->assertTrue($input->valid());

        // Test require future time
        $input = new Formulaic\Time;
        $input->isInFuture();
        $input->setValue(time() - 100);
        $this->assertNotTrue($input->valid());
        $input->setValue(time() + 100);
        $this->assertTrue($input->valid());
    }

    public function testUrl()
    {
        $this->expectOutputString(<<<EOT
<input type="url" placeholder="http://">
<input type="url" value="http://google.com" placeholder="http://">
EOT
        );
        $input = new Formulaic\Url;
        echo $input;
        $input->setValue('not an url');
        $this->assertNotTrue($input->valid());
        $input->setValue('http://google.com');
        $this->assertTrue($input->valid());
        echo "\n$input";
    }
}

