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
