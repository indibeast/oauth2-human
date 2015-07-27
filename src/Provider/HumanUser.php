<?php
/**
 * Created by PhpStorm.
 * User: virajabayarathna
 * Date: 7/27/15
 * Time: 1:27 PM
 */

namespace Human\OAuth2\Client\Provider;


use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class HumanUser implements ResourceOwnerInterface{

    protected $data;


    public function __construct(array $response)
    {
        $this->data =  $response;
    }

    /**
     * Get the identifier of the authorized resource owner.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->getField('id');
    }

    private function getField($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }
}