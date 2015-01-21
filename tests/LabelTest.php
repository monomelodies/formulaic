<?php

class LabelTest extends PHPUnit_Framework_TestCase
{
    public function testLabelWithElement()
    {
        $this->expectOutputString(<<<EOT
<label>Label</label>
<input type="text">
EOT
        );
        $input = new Formulaic\Text;
        $label = new Formulaic\Label('Label', $input);
        echo $label;
    }

    public function testLabelWithNamedElement()
    {
        $this->expectOutputString(<<<EOT
<label for="test">Label</label>
<input type="text" name="test" id="test">
EOT
        );
        $input = new Formulaic\Text('test');
        $label = new Formulaic\Label('Label', $input);
        echo $label;
    }
}

