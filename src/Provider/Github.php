<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2020, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace OAuthClient\Provider;

class Github extends AbstractProvider
{
    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct($config);

        $this->urls = [
            'auth'         => 'https://github.com/login/oauth/authorize',
            'access_token' => 'https://github.com/login/oauth/access_token',
            'remote_api'   => 'https://api.github.com/user',
        ];
    }

    /**
     * @param string $code
     * @return void
     */
    public function authenticate(string $code = null): void
    {
        $token = $this->request(['code' => $code]);
        if (array_key_exists('access_token', $token)) {
            $headers    = ["Authorization: token {$token['access_token']}", 'User-Agent: Awesome-Octocat-App'];
            $this->user = $this->request([], $headers);
        }
    }
}
