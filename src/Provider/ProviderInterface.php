<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace OAuthClient\Provider;

interface ProviderInterface
{
    /**
     * @param  string|null  $code
     * @return mixed
     */
    public function authenticate(string $code = null): void;
}
