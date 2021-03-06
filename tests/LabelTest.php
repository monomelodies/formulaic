<?php

namespace Formulaic\Test;

use Formulaic;

/**
 * Label tests
 */
class LabelTest
{
    /**
     * Labels can have an element.
     */
    public function testLabelWithElement()
    {
        $input = new Formulaic\Text;
        $label = new Formulaic\Label('Label', $input);
        yield assert("$label" == <<<EOT
<label>Label</label>
<input type="text">
EOT
        );
    }

    /**
     * Labels can have a named element.
     */
    public function testLabelWithNamedElement()
    {
        $input = new Formulaic\Text('test');
        $label = new Formulaic\Label('Label', $input);
        yield assert("$label" == <<<EOT
<label for="test">Label</label>
<input id="test" name="test" type="text">
EOT
        );
    }
}

