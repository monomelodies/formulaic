<?php

class FormTest extends PHPUnit_Framework_TestCase
{
    public function testEmptyForm()
    {
        $this->expectOutputString('<form method="get"></form>');
        $form = new Form;
        echo $form;
    }

    public function testFormWithInputAndButton()
    {
        $this->expectOutputString(<<<EOT
<form method="get">
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
<form method="get">
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
<form method="post"></form>
EOT
        );
        $form = new PostForm;
        echo $form;
    }

    public function testPostFormWithFile()
    {
        $this->expectOutputString(<<<EOT
<form enctype="multipart/form-data" method="post">
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
<form id="test" method="get" name="test">
<div><input id="test-bla" name="bla" type="text"></div>
</form>
EOT
        );
        $form = new NamedForm;
        $form[] = new Formulaic\Text('bla');
        echo $form;
    }

    public function testPopulateGet()
    {
        $form = new Form;
        $form[] = new Formulaic\Search('q');
        $_GET['q'] = 'query';
        $form->populate();
        $this->assertEquals('query', $form['q']->getValue());
    }

    public function testPopulatePost()
    {
        $form = new PostForm;
        $form[] = new Formulaic\Search('q');
        $_POST['q'] = 'query';
        $form->populate();
        $this->assertEquals('query', $form['q']->getValue());
    }

    public function testPopulateGrouped()
    {
        $form = new PostForm;
        $form[] = new Formulaic\Element\Group('foo', function($group) {
            $group[] = new Formulaic\Text('bar');
        });
        $_POST['foo'] = ['bar' => 'baz'];
        $form->populate();
        $this->assertEquals('baz', $form['foo']['bar']->getValue());
    }

    public function testErrors()
    {
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
        $form->populate();
        $this->assertTrue($form->valid());
    }

    public function testComplexForm()
    {
        $form = new ComplexForm;
        $_POST = [];
        $form->populate();
        $this->assertNotTrue($form->valid());
        $_POST = ['foo' => 'Foo', 'radios' => 1, 'checkboxes' => [2, 3]];
        $form->populate();
        $this->assertTrue($form->valid());
    }
}

