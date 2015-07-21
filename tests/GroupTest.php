<?php

class GroupTest extends PHPUnit_Framework_TestCase
{
    public function testGroupInGroup()
    {
        $this->expectOutputString(<<<EOT
<form action="" id="test" method="post">
<input id="test-foo-bar-baz" name="foo[bar][baz]" type="text" value="fizzbuz">
</form>
EOT
        );
        $form = new PostForm;
        $form->attribute('id', 'test');
        $form[] = new Formulaic\Element\Group('foo', function ($group) {
            $group[] = new Formulaic\Element\Group('bar', function ($group) {
                $group[] = new Formulaic\Text('baz');
            });
        });
        $_POST['foo'] = ['bar' => ['baz' => 'fizzbuz']];
        $form->populate();
        $this->assertEquals('fizzbuz', $form['foo']['bar']['baz']->getValue());
        echo $form;
    }

    public function testCheckboxGroup()
    {
        $this->expectOutputString(<<<EOT
<form action="" method="post">
<div>
<label for="test-1"><input checked id="test-1" name="test[]" type="checkbox" value="1"> foo</label>
<label for="test-2"><input id="test-2" name="test[]" type="checkbox" value="2"> bar</label>
</div>
</form>
EOT
        );
        $form = new PostForm;
        $form[] = (new Formulaic\Checkbox\Group(
            'test',
            [1 => 'foo', 2 => 'bar']
        ))->isRequired();
        $this->assertNotTrue($form->valid());
        $_POST['test'] = [1];
        $form->populate();
        $this->assertTrue($form->valid());
        echo $form;
    }

    public function testRadioGroup()
    {
        $this->expectOutputString(<<<EOT
<form action="" method="post">
<div>
<label for="test-1"><input checked id="test-1" name="test" type="radio" value="1"> foo</label>
<label for="test-2"><input id="test-2" name="test" type="radio" value="2"> bar</label>
</div>
</form>
EOT
        );
        $form = new PostForm;
        $form[] = (new Formulaic\Radio\Group(
            'test',
            [1 => 'foo', 2 => 'bar']
        ))->isRequired();
        $this->assertNotTrue($form->valid());
        $_POST['test'] = 1;
        $form->populate();
        $this->assertTrue($form->valid());
        echo $form;
    }
}

