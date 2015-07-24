<?php

class PersistanceTest extends PHPUnit_Framework_TestCase
{
    public function testDataPersists()
    {
        $form = new PersistantForm;
        $_POST['name'] = 'Linus';
        $user = new TestUserModel;
        $this->assertEquals('Marijn', $user->name);
        $form->source($user);
        $this->assertEquals('Linus', $user->name);
    }
}

