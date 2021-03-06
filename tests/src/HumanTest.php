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
                'account'       => 'malkey'
            ]
        );
    }

    public function testHumanUrl()
    {

        $provider = new Human(
            [
                'clientId'      => '123456789',
                'account'       => 'malkey'
            ]
        );

        $this->assertEquals([],$provider->getHeaders());
    }
} 