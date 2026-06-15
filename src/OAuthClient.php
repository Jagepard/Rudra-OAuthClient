<?php declare(strict_types=1);

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
 */

namespace Rudra\OAuthClient;

use Rudra\OAuthClient\Provider\ProviderInterface;

class OAuthClient
{
    protected array $providers = [];

    public function __construct(array $providers)
    {
        foreach ($providers as $provider) {
            $this->providers[$provider->getName()] = $provider;
        }
    }

    /**
     * Retrieves a provider by its name.
     * If the provider exists, it is returned; otherwise, an exception is thrown.
     *
     * @throws \InvalidArgumentException
     */
    public function provider(string $key): ProviderInterface
    {
        return $this->providers[$key] ?? throw new \InvalidArgumentException("$key is not installed");
    }
}
