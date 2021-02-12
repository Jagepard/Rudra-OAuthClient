<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\OAuthClient\Provider;

class Github extends AbstractProvider
{
    public function __construct(array $config)
    {
        parent::__construct($config);

        $this->name = 'github';
        $this->urls = [
            'auth'         => 'https://github.com/login/oauth/authorize',
            'access_token' => 'https://github.com/login/oauth/access_token',
            'remote_api'   => 'https://api.github.com/user',
        ];
    }

    public function authenticate(string $code = null): void
    {
        $token = $this->request(['code' => $code]);
        if (array_key_exists('access_token', $token)) {
            $headers    = ["Authorization: token {$token['access_token']}", 'User-Agent: Awesome-Octocat-App'];
            $this->user = $this->request([], $headers);
        }
    }
}
