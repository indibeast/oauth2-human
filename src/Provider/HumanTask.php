<?php
/**
 * Created by PhpStorm.
 * User: virajabayarathna
 * Date: 7/28/15
 * Time: 7:56 PM
 */

namespace Human\OAuth2\Client\Provider;


class HumanTask {

    protected $data;


    public function __construct($response)
    {
        $this->data =  $response;
    }


} 