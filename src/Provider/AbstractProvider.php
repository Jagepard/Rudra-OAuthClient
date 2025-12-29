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
    protected array $user;
    protected array $urls;
    protected string $name;
    protected array $config;

    /**
     * @param  array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function user(): array
    {
        return $this->user;
    }

    /**
     * Sends an HTTP request using cURL with optional parameters and headers.
     * The method supports both GET and POST requests and can return the response as JSON or raw data.
     * -------------------------
     * Отправляет HTTP-запрос с использованием cURL с необязательными параметрами и заголовками.
     * Метод поддерживает как GET, так и POST запросы и может возвращать ответ в формате JSON или в сыром виде.
     * 
     * @param  array   $params
     * @param  array   $headers
     * @param  boolean $json
     * @return void
     */
    protected function request(array $params = [], array $headers = [], $json = true)
    {
        $curlHeaders = ['Accept: application/json'];
        $curlHeaders = array_merge($curlHeaders, $headers);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $curlHeaders);

        if (count($params)) {
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

        if ($json) {
            $content = json_decode($content, true);
        }

        return $content;
    }

    /**
     * Generates a URL for authentication with optional additional parameters.
     * The method constructs a query string by merging default parameters with any extra options provided.
     * The resulting URL is used for redirecting users to the authentication endpoint.
     * -------------------------
     * Генерирует URL для аутентификации с возможностью добавления дополнительных параметров.
     * Метод создает строку запроса, объединяя параметры по умолчанию с любыми дополнительными опциями.
     * Полученный URL используется для перенаправления пользователей на конечную точку аутентификации.
     * 
     * @param  array  $extraOptions
     * @return string
     */
    public function url($extraOptions = []): string
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

        return $this->urls['auth'].'?'.urldecode(http_build_query($params));
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
