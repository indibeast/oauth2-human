<?php
namespace Human\OAuth2\Client\Provider;

class HumanTask {

    protected $data;


    public function __construct($response)
    {
        $this->data =  $response;
    }


} 