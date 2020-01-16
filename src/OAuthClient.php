<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2020, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace OAuthClient;

use OAuthClient\Provider\ProviderInterface;

class OAuthClient
{
    /**
     * @var array
     */
    protected $providers;

    /**
     * @param Provider\ProviderInterface ...$providers
     */
    public function __construct(ProviderInterface ...$providers)
    {
        foreach ($providers as $provider) {
            $this->providers[get_class($provider)] = $provider;
        }
    }

    /**
     * @param string $key
     * @return Provider\ProviderInterface
     */
    public function provider(string $key): ProviderInterface
    {
        if (array_key_exists($key, $this->providers)) {
            return $this->providers[$key];
        }

        throw new \InvalidArgumentException('This provider is not installed');
    }
}
