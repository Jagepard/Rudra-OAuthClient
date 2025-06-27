<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\OAuthClient\Provider;

class Github extends AbstractProvider
{
    /**
     * Initializes the GitHub authentication class with default configuration and URLs.
     * The constructor sets up the necessary endpoints for authentication and API access.
     * -------------------------
     * Инициализирует класс аутентификации GitHub с базовой конфигурацией и URL-адресами.
     * Конструктор настраивает необходимые конечные точки для аутентификации и доступа к API.
     *
     * @param  array $config
     */
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

    /**
     * Authenticates the user using the provided authorization code.
     * The method exchanges the code for an access token and retrieves the user's information from the GitHub API.
     * If the access token is successfully obtained, the user's data is fetched and stored in the `$user` property.
     * -------------------------
     * Аутентифицирует пользователя с использованием предоставленного кода авторизации.
     * Метод обменивает код на токен доступа и получает информацию о пользователе из API GitHub.
     * Если токен доступа успешно получен, данные пользователя извлекаются и сохраняются в свойстве `$user`.
     *
     * @param  string|null $code
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
