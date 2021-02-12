<?php

require_once './vendor/autoload.php';

use Rudra\OAuthClient\OAuthClient;
use Rudra\OAuthClient\Provider\Github;
use Rudra\OAuthClient\Provider\Google;
use Rudra\OAuthClient\Provider\ProviderInterface;
use Rudra\OAuthClient\Provider\Yandex;

$providers = [
    new Yandex([
        'client_id'     => 'e3b9c11ee34d4a129f73cb87a9bfa1a0',
        'client_secret' => 'a38ecb63d43d4674a10b0c825450b82d',
        'redirect_uri'  => 'https://auth.jagepard.ru?provider=yandex',
    ]),
    new Github([
        'client_id'     => 'dba33dc28d96b911858f',
        'client_secret' => '4f1dd3f08e87f6163fa8d5030ab4c1ba8e20cc4b',
        'redirect_uri'  => 'https://auth.jagepard.ru?provider=github',
    ]),
    new Google([
        'client_id'     => '970354010809-vmlpko7hdq397fhpmhvgqmnvb18d8gdf.apps.googleusercontent.com',
        'client_secret' => 'qdZbFUbAPTjMbOgRjfDouoOu',
        'redirect_uri'  => 'https://auth.jagepard.ru?provider=google',
    ])
];

$oauthClient = new OAuthClient($providers);

//(new Whoops\Run)->appendHandler(new Whoops\Handler\PrettyPageHandler)->register();

$extraOptions = [
    'google'   => ['scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'],
    'facebook' => ['scope' => 'email']
];

function handle(OAuthClient $oauthClient, $request, ProviderInterface $provider, $extraOptions = [])
{
    if (!isset($request['code'])) {
        printf("<p><a href=\"%s\">Authentication: {$provider->getName()}</a>", $oauthClient->provider($provider->getName())->url($extraOptions));
    } else {
        if (isset($request['provider']) && $request['provider'] === $provider->getName()) {
            $oauthClient->provider($provider->getName())->authenticate($request['code']);
            var_dump($oauthClient->provider($provider->getName())->user());die;
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
