<?php

class PersistanceTest extends PHPUnit_Framework_TestCase
{
    public function testDataPersists()
    {
        $_POST['name'] = 'Linus';
        $user = new TestUserModel;
        $this->assertEquals('Marijn', $user->name);
        $form = new PersistantForm;
        $form->bind($user);
        $this->assertEquals('Linus', $user->name);
        $form['name']->getElement()->setValue('Chuck Norris');
        $this->assertEquals('Chuck Norris', $user->name);
    }
}

