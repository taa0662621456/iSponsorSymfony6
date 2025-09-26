<?php

class BaseTestCase extends PHPUnit_Test_Case
{
    public function setUp()
    {
        $this->loadFixtures([]);
    }
}
