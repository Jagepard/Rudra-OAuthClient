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

class Github extends AbstractProvider
{
    /**
     * Initializes the GitHub authentication class with default configuration and URLs.
     * The constructor sets up the necessary endpoints for authentication and API access.
     */
    public function __construct(array $config)
    {
        parent::__construct($config);

        $this->name = 'github';
        $this->urls = [
            'auth'         => 'https://github.com/login/oauth/authorize',
            'access_token' => 'https://github.com/login/oauth/access_token',
            'remote_api'   => 'https://api.github.com/user',
        ];
    }

    /**
     * Authenticates the user using the provided authorization code.
     * The method exchanges the code for an access token and retrieves the user's information from the GitHub API.
     * If the access token is successfully obtained, the user's data is fetched and stored in the `$user` property.
     */
    #[\Override]
    public function authenticate(?string $code = null): void
    {
        $token = $this->request(['code' => $code]);
        if (array_key_exists('access_token', $token)) {
            $headers    = ["Authorization: token {$token['access_token']}", 'User-Agent: Awesome-Octocat-App'];
            $this->user = $this->request([], $headers);
        }
    }
}
