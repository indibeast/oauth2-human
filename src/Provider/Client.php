<?php
namespace Human\OAuth2\Client\Provider;

use Human\OAuth2\Client\Exception\HumanClientException;
use League\OAuth2\Client\Token\AccessToken;

class Client {

    static protected $baseUrl = 'http://{account}.rype3.net/';
    static protected $apipath = 'human/api/v1';
    protected $guzzleClient;
    public $accessToken;

    public function __construct($accessToken,$domain)
    {
        if(!isset($domain)) {
            throw new HumanClientException('Rype3 account domain required');
        }
        $this->guzzleClient = new \GuzzleHttp\Client([
                'base_uri' => str_replace('{account}',$domain,static::$baseUrl),
                'headers'  =>[
                    'Oauth-Token' => $accessToken
                ]
            ]

        );
    }

    public function getResourceOwner()
    {
        $path   = self::$apipath.'/me';
        $output = $this->output($this->guzzleClient->get($path));

        if($output->status){

            return new HumanUser($output->result);
        }

        throw new HumanClientException($output->errors->message);
    }

    public function getUsers(array $data)
    {
         $path = self::$apipath.'/people/tags?';
         $query = implode('&', array_map(function ($v, $k) { return $k . '=' . $v; }, $data, array_keys($data)));
         $output = $this->output($this->guzzleClient->get($path.$query));

        if($output->status) {
             $users = [];
             foreach ($output->result->users as $user) {
                 array_push($users,new HumanUser($user));
             }

            return $users;
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