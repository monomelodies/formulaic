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
<input type="text" name="mytextfield">
EOT
        );
        $form = new Form;
        $form[] = new Formulaic\Text('mytextfield');
        echo $form['mytextfield'];
    }
}

