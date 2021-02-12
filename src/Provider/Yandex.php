<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\OAuthClient\Provider;

class Yandex extends AbstractProvider
{
    public function __construct(array $config)
    {
        parent::__construct($config);

        $this->name = 'yandex';
        $this->urls = [
            'auth'         => 'https://oauth.yandex.ru/authorize',
            'access_token' => 'https://oauth.yandex.ru/token',
            'remote_api'   => 'https://login.yandex.ru/info',
        ];
    }

    public function authenticate(string $code = null): void
    {
        if (isset($code)) {
            $params = [
                'grant_type' => 'authorization_code',
                'code'       => $code,
            ];

            $token = $this->request($params);

            if (array_key_exists('access_token', $token)) {
                $params = [
                    'format'      => 'json',
                    'oauth_token' => $token['access_token'],
                ];

                $this->urls['remote_api'] = $this->urls['remote_api'].'?'.http_build_query($params);
                $this->user               = $this->request();
            }
        }
    }    
}
