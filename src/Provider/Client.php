<?php
namespace Human\OAuth2\Client\Provider;

use Human\OAuth2\Client\Exception\HumanClientException;
use League\OAuth2\Client\Token\AccessToken;

class Client {

    static protected $baseUrl = 'http:/human.dev/api/v1/';
    protected $guzzleClient;
    public $accessToken;

    public function __construct($accessToken)
    {
        $this->guzzleClient = new \GuzzleHttp\Client([
                'base_uri' => static::$baseUrl,
                'headers'  =>[
                    'Oauth-Token' => $accessToken
                ]
            ]

        );
    }

    public function getResourceOwner()
    {
        $path   = 'me';
        $output = $this->output($this->guzzleClient->get($path));

        if($output->status){

            return new HumanUser($output->result);
        }

        throw new HumanClientException($output->errors->message);
    }

    public function postTask($user,$duedate,$startdate,$desc)
    {
        $path   = 'tasks';
        $output = $this->output($this->guzzleClient->post($path,[
            'form_params' =>[
                'user-id' => $user,
                'due-date'=> $duedate,
                'start-date' => $startdate,
                'task-desc'  => $desc,
            ]
        ]));

        if($output->status){
            return new HumanTask($output->result);
        }

        throw new HumanClientException($output->errors->message);
    }

    protected function output($response, $body=true)
    {
        return $body ? json_decode($response->getBody()) : $response;
    }
} 