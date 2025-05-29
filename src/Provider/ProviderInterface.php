<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\OAuthClient\Provider;

interface ProviderInterface
{
    public function authenticate(string $code = null): void;
}
