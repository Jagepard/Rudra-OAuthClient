<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\OAuthClient\Provider;

abstract class AbstractProvider implements ProviderInterface
{
    protected array $user;
    protected array $urls;
    protected string $name;
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function user(): array
    {
        return $this->user;
    }

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

    public function getName(): string
    {
        return $this->name;
    }
}
