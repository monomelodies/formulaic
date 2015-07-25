<?php

class FormTest extends PHPUnit_Framework_TestCase
{
    public function testEmptyForm()
    {
        $this->expectOutputString('<form action="" method="get"></form>');
        $form = new Form;
        echo $form;
    }

    public function testFormWithInputAndButton()
    {
        $this->expectOutputString(<<<EOT
<form action="" method="get">
<div><input type="text"></div>
<div><button type="submit"></button></div>
</form>
EOT
        );
        $form = new Form;
        $form[] = new Formulaic\Text;
        $form[] = new Formulaic\Button\Submit;
        echo $form;
    }

    public function testFormWithFieldset()
    {
        $this->expectOutputString(<<<EOT
<form action="" method="get">
<fieldset>
<legend>Hello world!</legend>
<div><input type="text"></div>
</fieldset>
</form>
EOT
        );
        $form = new Form;
        $form[] = new Formulaic\Fieldset('Hello world!', function($fieldset) {
            $fieldset[] = new Formulaic\Text;
        });
        echo $form;
    }

    public function testReferenceByName()
    {
        $this->expectOutputString(<<<EOT
<input id="mytextfield" name="mytextfield" type="text">
EOT
        );
        $form = new Form;
        $form[] = new Formulaic\Text('mytextfield');
        echo $form['mytextfield'];
    }

    public function testPostForm()
    {
        $this->expectOutputString(<<<EOT
<form action="" method="post"></form>
EOT
        );
        $form = new PostForm;
        echo $form;
    }

    public function testPostFormWithFile()
    {
        $this->expectOutputString(<<<EOT
<form action="" enctype="multipart/form-data" method="post">
<div><input type="file"></div>
</form>
EOT
        );
        $form = new PostForm;
        $form[] = new Formulaic\File;
        echo $form;
    }

    public function testNamedFormInherits()
    {
        $this->expectOutputString(<<<EOT
<form action="" id="test" method="get" name="test">
<div><input id="test-bla" name="bla" type="text"></div>
</form>
EOT
        );
        $form = new NamedForm;
        $form[] = new Formulaic\Text('bla');
        $form[0]->prefix('test');
        echo $form;
    }

    public function testPopulateGet()
    {
        $_GET['q'] = 'query';
        $form = new Form;
        $form[] = new Formulaic\Search('q');
        $this->assertEquals('query', $form['q']->getValue());
    }

    public function testPopulatePost()
    {
        $_POST['q'] = 'query';
        $form = new PostForm;
        $form[] = new Formulaic\Search('q');
        $this->assertEquals('query', $form['q']->getValue());
    }

    public function testPopulateGrouped()
    {
        $_POST['foo'] = ['bar' => 'baz'];
        $form = new PostForm;
        $form[] = new Formulaic\Element\Group('foo', function($group) {
            $group[] = new Formulaic\Text('bar');
        });
        $this->assertEquals('baz', $form['foo']['bar']->getValue());
    }

    public function testErrors()
    {
        $_POST = [];
        $form = new PostForm;
        $form[] = (new Formulaic\Text('foo'))->isRequired();
        $form[] = (new Formulaic\Text('bar'))->isRequired();
        $this->assertNotTrue($form->valid());
        $this->assertEquals(
            [
                'foo' => ['required'],
                'bar' => ['required'],
            ],
            $form->errors()
        );
        $_POST = ['foo' => 1, 'bar' => 2];
        $form = new PostForm;
        $form[] = (new Formulaic\Text('foo'))->isRequired();
        $form[] = (new Formulaic\Text('bar'))->isRequired();
        $this->assertTrue($form->valid());
        $this->assertEquals(1, $form['foo']->getValue());
        $this->assertEquals(2, $form['bar']->getValue());
    }

    public function testComplexForm()
    {
        $_POST = [];
        $form = new ComplexForm;
        $this->assertNotTrue($form->valid());
        $_POST = ['foo' => 'Foo', 'radios' => 1, 'checkboxes' => [2, 3]];
        $form = new ComplexForm;
        $this->assertTrue($form->valid());
    }
}

