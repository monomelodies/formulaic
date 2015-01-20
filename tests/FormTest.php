<?php

class FormTest extends PHPUnit_Framework_TestCase
{
    public function testEmptyForm()
    {
        $this->expectOutputString('<form method="get"></form>');
        $form = new EmptyForm;
        echo $form;
    }

    public function testFormWithInputAndButton()
    {
        $this->expectOutputString(<<<EOT
<form method="get">
<input type="text">
<button type="submit"></button>
</form>
EOT
        );
        $form = new SimpleForm;
        echo $form;
    }

    public function testFormWithFieldset()
    {
        $this->expectOutputString(<<<EOT
<form method="get">
<fieldset>
<legend>Hello world!</legend>
<input type="text">
</fieldset>
</form>
EOT
        );
        $form = new FieldsetForm;
        echo $form;
    }
}

