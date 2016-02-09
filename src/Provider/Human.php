<?php
namespace Human\OAuth2\Client\Provider;
use Human\OAuth2\Client\Exception\HumanClientException;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\League;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

class Human extends AbstractProvider{

    public $domain = 'http://{account}.rype3.net/human/account';

    public $apiDomain = 'http://api.human.dev';


    public function __construct(array $options = [], array $collaborators = [])
    {
        parent::__construct($options,$collaborators);
        if (!isset($options['account'])) {
            throw new HumanClientException('Account must be supllied');
        }
        $this->changeDomainUrl($options['account']);
    }
    public function getBaseAuthorizationUrl()
    {
        return $this->domain.'/oauth/authorize';
    }

    public function getUserDetailsUrl(AccessToken $token)
    {
        // TODO: Implement getUserDetailsUrl() method.
    }

    /**
     * Get the default scopes used by this provider.
     *
     * This should not be a complete list of all scopes, but the minimum
     * required for the provider user interface!
     *
     * @return array
     */
    protected function getDefaultScopes()
    {
        return [];
    }

    /**
     * Check a provider response for errors.
     *
     * @throws IdentityProviderException
     * @param  ResponseInterface $response
     * @param  string $data Parsed response data
     * @return void
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        // TODO: Implement checkResponse() method.
    }

    /**
     * Generate a user object from a successful user details request.
     *
     * @param object $response
     * @param AccessToken $token
     * @return League\OAuth2\Client\Provider\UserInterface
     */
    protected function createUser(array $response, AccessToken $token)
    {
        // TODO: Implement createUser() method.
    }

    public function getBaseAccessTokenUrl(array $params)
    {
        return $this->domain.'/oauth/access_token';
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        // TODO: Implement getResourceOwnerDetailsUrl() method.
    }

    /**
     * Generate a resource owner object from a successful resource owner details request.
     *
     * @param object $response
     * @param AccessToken $token
     * @return League\OAuth2\Client\Provider\ResourceOwnerInterface
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        //return  new HumanUser($response);
    }

    protected function changeDomainUrl($domain)
    {
        $this->domain = str_replace('{account}',$domain,$this->domain);
    }
}