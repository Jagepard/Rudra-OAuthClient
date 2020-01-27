<?php

require_once './vendor/autoload.php';

use OAuthClient\OAuthClient;
use OAuthClient\Provider\Github;
use OAuthClient\Provider\Google;
use OAuthClient\Provider\ProviderInterface;
use OAuthClient\Provider\Yandex;

$providers = [
    new Yandex([
        'client_id'     => 'your_client_id',
        'client_secret' => 'your_client_secret',
        'redirect_uri'  => 'your_redirect_uri'
    ]),    
    new Github([
        'client_id'     => 'your_client_id',
        'client_secret' => 'your_client_secret',
        'redirect_uri'  => 'your_redirect_uri'
    ]),    
    new Google([
        'client_id'     => 'your_client_id',
        'client_secret' => 'your_client_secret',
        'redirect_uri'  => 'your_redirect_uri'
    ])
];

$oauthClient = new OAuthClient($providers);

(new Whoops\Run)->appendHandler(new Whoops\Handler\PrettyPageHandler)->register();

$extraOptions = [
    'google'   => ['scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'],
    'facebook' => ['scope' => 'email']
];

function handle(OAuthClient $oauthClient, $getRequest = null, ProviderInterface $provider, $extraOptions = []) {
    if (!isset($getRequest['code'])) {
        printf("<p><a href=\"%s\">Authentication: {$provider->getName()}</a>", $oauthClient->provider($provider->getName())->url($extraOptions));
    } else {
        if (isset($getRequest['provider']) && $getRequest['provider'] === $provider->getName()) {
            $oauthClient->provider($provider->getName())->authenticate($getRequest['code']);
            var_dump($oauthClient->provider($provider->getName())->user());
        }
    }
}

foreach ($providers as $provider) {
    if ($provider->getName() === 'google') {
        handle($oauthClient, $_GET, $provider, $extraOptions['google']);
    } else {
        handle($oauthClient, $_GET, $provider);
    }
}
