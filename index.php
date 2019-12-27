<?php

require_once './vendor/autoload.php';

$oauthClient = new OAuthClient\OAuthClient(
    new OAuthClient\Provider\Yandex(
        [
            'client_id'     => 'your client_id',
            'client_secret' => 'your client_secret',
            'redirect_uri'  => 'your redirect_uri',
        ]
    ),
    new OAuthClient\Provider\Github(
        [
            'client_id'     => 'your client_id',
            'client_secret' => 'your client_secret',
            'redirect_uri'  => 'your redirect_uri',
        ]
    )
);

if (!isset($_GET['code'])) {
    printf("<p><a href=\"%s\">Authentication</a>", $oauthClient->provider(\OAuthClient\Provider\Github::class)->url());
} else {
    $oauthClient->provider(\OAuthClient\Provider\Github::class)->authenticate($_GET['code']);
    print_r($oauthClient->provider(\OAuthClient\Provider\Github::class)->user());
}

