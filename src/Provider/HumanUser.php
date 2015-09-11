<?php
namespace Human\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class HumanUser implements ResourceOwnerInterface{

    protected $data;


    public function __construct($response)
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

    public function getFirstName()
    {
        return $this->getField('first_name');
    }

    public function getLastName()
    {
        return $this->getField('last_name');
    }

    public function getEmail()
    {
        return $this->getField('email');
    }

    private function getField($key)
    {
        return isset($this->data->$key) ? $this->data->$key : null;
    }

    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray()
    {
        // TODO: Implement toArray() method.

        return json_decode($this->data);
    }
}