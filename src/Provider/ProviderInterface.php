<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2020, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace OAuthClient\Provider;

interface ProviderInterface
{
    /**
     * @param string $code     *
     * @return void
     */
    public function authenticate(string $code = null): void;
}
