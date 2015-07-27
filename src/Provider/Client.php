<?php
/**
 * Created by PhpStorm.
 * User: virajabayarathna
 * Date: 7/27/15
 * Time: 1:45 PM
 */

namespace Human\OAuth2\Client\Provider;


use Human\OAuth2\Client\Exception\HumanClientException;
use League\OAuth2\Client\Token\AccessToken;

class Client {

    static protected $baseUrl = 'http:/human.dev/api/v1';
    protected $guzzleClient;
    public $accessToken;

    public function __construct($accessToken)
    {
        $this->guzzleClient = new \GuzzleHttp\Client([
                'base_url' => [ static::$baseUrl, ['version' => null ] ],
                'defaults' => [
                    'headers' => [
                        'content-type'  => 'application/json',
                        'Authorization' => 'Bearer '.$accessToken
                    ],
                ]
            ]

        );
    }

    public function getResourceOwner()
    {
        $path = '/me';
        return $this->guzzleClient->get($path);
    }

    protected function output($response, $body)
    {
        return $body ? $response->json() : $response;
    }
} 