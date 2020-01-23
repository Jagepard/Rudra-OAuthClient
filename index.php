<?php

require_once './vendor/autoload.php';

$oauthClient = new OAuthClient\OAuthClient(
    new OAuthClient\Provider\Yandex(
        [
            'client_id'     => 'your client_id',
            'client_secret' => 'your client_secret',
            'redirect_uri'  => 'yoor redirect_uri',
        ]
    ),
    new OAuthClient\Provider\Github(
        [
            'client_id'     => 'your client_id',
            'client_secret' => 'your client_secret',
            'redirect_uri'  => 'yoor redirect_uri',
        ]
    ),
    new OAuthClient\Provider\Google(
        [
            'client_id'     => 'your client_id',
            'client_secret' => 'your client_secret',
            'redirect_uri'  => 'yoor redirect_uri',
        ]
    ),
    new OAuthClient\Provider\Facebook(
        [
            'client_id'     => 'your client_id',
            'client_secret' => 'your client_secret',
            'redirect_uri'  => 'yoor redirect_uri',
        ]
    )
);

$googleExtraOptions = [
    'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
];

if (!isset($_GET['code'])) {
    printf("<p><a href=\"%s\">Authentication</a>", $oauthClient->provider(\OAuthClient\Provider\Facebook::class)->url());
} else {
    $oauthClient->provider(\OAuthClient\Provider\Facebook::class)->authenticate($_GET['code']);
    var_dump($oauthClient->provider(\OAuthClient\Provider\Facebook::class)->user());
}
