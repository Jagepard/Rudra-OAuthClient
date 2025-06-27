<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\OAuthClient;

use Rudra\OAuthClient\Provider\ProviderInterface;

class OAuthClient
{
    protected array $providers;

    /**
     * Initializes the OAuthClient with an array of providers.
     * Each provider is stored in the `$providers` array with its name as the key.
     * -------------------------
     * Инициализирует OAuthClient массивом провайдеров.
     * Каждый провайдер сохраняется в массиве `$providers` с его именем в качестве ключа.
     *
     * @param  array $providers
     */
    public function __construct(array $providers)
    {
        foreach ($providers as $provider) {
            $this->providers[$provider->getName()] = $provider;
        }
    }

    /**
     * Retrieves a provider by its name.
     * If the provider exists, it is returned; otherwise, an exception is thrown.
     * -------------------------
     * Извлекает провайдер по его имени.
     * Если провайдер существует, он возвращается; в противном случае выбрасывается исключение.
     *
     * @param  string $key
     * @return ProviderInterface
     * @throws \InvalidArgumentException
     */
    public function provider(string $key): ProviderInterface
    {
        if (array_key_exists($key, $this->providers)) {
            return $this->providers[$key];
        }

        throw new \InvalidArgumentException("$key is not installed");
    }
}
