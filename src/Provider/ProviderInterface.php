<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\OAuthClient\Provider;

interface ProviderInterface
{
    /**
     * Authenticates the user using the provided authorization code.
     * The method should handle the logic for exchanging the code for an access token
     * and retrieving the user's information from the provider's API.
     * -------------------------
     * Аутентифицирует пользователя с использованием предоставленного кода авторизации.
     * Метод должен обрабатывать логику обмена кода на токен доступа
     * и получение информации о пользователе из API провайдера.
     *
     * @param  string|null $code
     * @return void
     */
    public function authenticate(string $code = null): void;
}
