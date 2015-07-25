<?php

class PersistanceTest extends PHPUnit_Framework_TestCase
{
    public function testDataPersists()
    {
        $_POST['name'] = 'Linus';
        $form = new PersistantForm;
        $user = new TestUserModel;
        $this->assertEquals('Marijn', $user->name);
        $form->bind($user);
        $this->assertEquals('Linus', $user->name);
    }
}

