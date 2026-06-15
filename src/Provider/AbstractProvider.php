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

abstract class AbstractProvider implements ProviderInterface
{
    protected array $user = [];
    protected array $urls = [];
    protected string $name = '';

    public function __construct(protected array $config)
    {
    }

    #[\Override]
    abstract public function authenticate(?string $code = null): void;

    public function user(): array
    {
        return $this->user;
    }

    /**
     * Sends an HTTP request using cURL with optional parameters and headers.
     * The method supports both GET and POST requests and can return the response as JSON or raw data.
     */
    protected function request(array $params = [], array $headers = [], $json = true): array|string|false
    {
        $curlHeaders = array_merge(['Accept: application/json'], $headers);
        $curl        = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER     => $curlHeaders,
        ]);

        if ($params) {
            $params = array_merge(
                $params,
                [
                    'client_id'     => $this->config['client_id'],
                    'client_secret' => $this->config['client_secret'],
                    'redirect_uri'  => $this->config['redirect_uri'],
                ]
            );

            curl_setopt($curl, CURLOPT_URL, $this->urls['access_token']);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
        } else {
            curl_setopt($curl, CURLOPT_URL, $this->urls['remote_api']);
        }

        $content = curl_exec($curl);
        curl_close($curl);

        if ($json && is_string($content)) {
            $content = json_decode($content, true) ?? $content;
        }

        return $content;
    }

    /**
     * Generates a URL for authentication with optional additional parameters.
     * The method constructs a query string by merging default parameters with any extra options provided.
     * The resulting URL is used for redirecting users to the authentication endpoint.
     */
    public function url(array $extraOptions = []): string
    {
        $params = array_merge(
            $extraOptions,
            [
                'response_type' => 'code',
                'client_id'     => $this->config['client_id'],
                'display'       => 'popup',
                'redirect_uri'  => $this->config['redirect_uri'],
            ]
        );

        return $this->urls['auth'] .'?'. urldecode(http_build_query($params));
    }

    public function getName(): string
    {
        return $this->name;
    }
}
