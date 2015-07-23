<?php

namespace Human\OAuth2\Client\Test;


use Human\OAuth2\Client\Provider\Human;

class HumanTest extends \PHPUnit_Framework_TestCase{

    protected $provider;

    protected function setUp()
    {
        $this->provider = new Human(
            [
                'clientId'      => '123456789',
            ]
        );
    }

    public function testHumanUrl()
    {

        $provider = new Human(
            [
                'clientId'      => '123456789',
            ]
        );

        $this->assertEquals([],$provider->getHeaders());
    }
} 