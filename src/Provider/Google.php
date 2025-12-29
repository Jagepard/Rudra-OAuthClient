<?php declare(strict_types=1);

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
 */

namespace Rudra\OAuthClient\Provider;

class Google extends AbstractProvider
{
    /**
     * Initializes the Google authentication class with default configuration and URLs.
     * The constructor sets up the necessary endpoints for authentication and API access.
     * -------------------------
     * Инициализирует класс аутентификации Google с базовой конфигурацией и URL-адресами.
     * Конструктор настраивает необходимые конечные точки для аутентификации и доступа к API.
     *
     * @param  array $config
     */
    public function __construct(array $config)
    {
        parent::__construct($config);

        $this->name = 'google';
        $this->urls = [
            'auth'         => 'https://accounts.google.com/o/oauth2/auth',
            'access_token' => 'https://accounts.google.com/o/oauth2/token',
            'remote_api'   => 'https://www.googleapis.com/oauth2/v1/userinfo',
        ];
    }

    /**
     * Authenticates the user using the provided authorization code.
     * The method exchanges the code for an access token and retrieves the user's information from the Google API.
     * If the access token is successfully obtained, the user's data is fetched and stored in the `$user` property.
     * -------------------------
     * Аутентифицирует пользователя с использованием предоставленного кода авторизации.
     * Метод обменивает код на токен доступа и получает информацию о пользователе из API Google.
     * Если токен доступа успешно получен, данные пользователя извлекаются и сохраняются в свойстве `$user`.
     *
     * @param  string|null
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
