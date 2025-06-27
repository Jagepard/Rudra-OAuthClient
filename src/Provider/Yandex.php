<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\OAuthClient\Provider;

class Yandex extends AbstractProvider
{
    /**
     * Initializes the Yandex authentication class with default configuration and URLs.
     * The constructor sets up the necessary endpoints for authentication and API access.
     * -------------------------
     * Инициализирует класс аутентификации Yandex с базовой конфигурацией и URL-адресами.
     * Конструктор настраивает необходимые конечные точки для аутентификации и доступа к API.
     *
     * @param  array $config
     */
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

    /**
     * Authenticates the user using the provided authorization code.
     * The method exchanges the code for an access token and retrieves the user's information from the Yandex API.
     * If the access token is successfully obtained, the user's data is fetched and stored in the `$user` property.
     * -------------------------
     * Аутентифицирует пользователя с использованием предоставленного кода авторизации.
     * Метод обменивает код на токен доступа и получает информацию о пользователе из API Yandex.
     * Если токен доступа успешно получен, данные пользователя извлекаются и сохраняются в свойстве `$user`.
     *
     * @param  string|null $code
     * @return void
     */
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
