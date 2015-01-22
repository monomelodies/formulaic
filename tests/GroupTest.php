<?php

class GroupTest extends PHPUnit_Framework_TestCase
{
    public function testGroupInGroup()
    {
        $this->expectOutputString(<<<EOT
<form method="post">
<input id="foo-bar-baz" name="foo[bar][baz]" type="text" value="fizzbuz">
</form>
EOT
        );
        $form = new PostForm;
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
        $form = new PostForm;
        $form[] = (new Formulaic\Checkbox\Group(
            'test',
            [1 => 'foo', 2 => 'bar']
        ))->isRequired();
        $this->assertNotTrue($form->valid());
        $_POST['test'] = [1 => 1];
        $form->populate();
        $this->assertTrue($form->valid());
    }
}

