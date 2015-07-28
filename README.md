# Human Provider for OAuth 2.0 Client

[![Build Status](https://travis-ci.org/indibeast/oauth2-human.svg)](https://travis-ci.org/indibeast/oauth2-human)

This package provides Human OAuth 2.0 support for the PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

## Usage

### Authorization Code Flow

```php
$provider = new \Human\OAuth2\Client\Provider\Human([
    'clientId'      => 'XXXXXXXX',
    'clientSecret'  => 'XXXXXXXX',
    'redirectUri'   => 'https://your-registered-redirect-uri/',

]);

if (!isset($_GET['code'])) {

    $authurl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: '.$authUrl);
    exit;

 }  (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])){

    unset($_SESSION['oauth2state']);
    exit('Invalid state');

 } else {

     $token = $provider->getAccessToken('authorization_code', [
                 'code' => $_GET['code']
     ]);

     try {

        $client = new Client($token);
        $user   = $client->getResourceOwner();
        echo $user->getFirstName();

     } catch (Exception $e) {

        echo "Oops!..."
     }

 }
```

## License

The MIT License (MIT). Please see [License File](https://github.com/indibeast/oauth2-human/blob/master/LICENSE) for more information.