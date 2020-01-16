<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2020, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace OAuthClient\Provider;

abstract class AbstractProvider implements ProviderInterface
{
    /**
     * @var array
     */
    protected $user;
    /**
     * @var array
     */
    protected $urls;
        /**
         * @var array
         */
    protected $config;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function user(): array
    {
        return $this->user;
    }

    /**
     * @param array $params
     * @param array $headers
     * @return array
     */
    protected function request(array $params = [], array $headers = []): array
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

        return json_decode($content, true);
    }

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
}
