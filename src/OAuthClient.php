<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\OAuthClient;

use Rudra\OAuthClient\Provider\ProviderInterface;

class OAuthClient
{
    protected array $providers;

    public function __construct(array $providers)
    {
        foreach ($providers as $provider) {
            $this->providers[$provider->getName()] = $provider;
        }
    }

    public function provider(string $key): ProviderInterface
    {
        if (array_key_exists($key, $this->providers)) {
            return $this->providers[$key];
        }

        throw new \InvalidArgumentException("This provider is not installed");
    }
}
