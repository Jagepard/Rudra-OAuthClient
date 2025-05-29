## Table of contents
- [Rudra\OAuthClient\OAuthClient](#rudra_oauthclient_oauthclient)
- [Rudra\OAuthClient\Provider\AbstractProvider](#rudra_oauthclient_provider_abstractprovider)
- [Rudra\OAuthClient\Provider\Github](#rudra_oauthclient_provider_github)
- [Rudra\OAuthClient\Provider\Google](#rudra_oauthclient_provider_google)
- [Rudra\OAuthClient\Provider\ProviderInterface](#rudra_oauthclient_provider_providerinterface)
- [Rudra\OAuthClient\Provider\Yandex](#rudra_oauthclient_provider_yandex)
<hr>

<a id="rudra_oauthclient_oauthclient"></a>

### Class: Rudra\OAuthClient\OAuthClient
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>__construct</strong>( array $providers )</em><br>|
|public|<em><strong>provider</strong>( string $key ): Rudra\OAuthClient\Provider\ProviderInterface</em><br>|


<a id="rudra_oauthclient_provider_abstractprovider"></a>

### Class: Rudra\OAuthClient\Provider\AbstractProvider
##### implements [Rudra\OAuthClient\Provider\ProviderInterface](#rudra_oauthclient_provider_providerinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>__construct</strong>( array $config )</em><br>|
|public|<em><strong>user</strong>(): array</em><br>|
|protected|<em><strong>request</strong>( array $params  array $headers   $json )</em><br>|
|public|<em><strong>url</strong>(  $extraOptions ): string</em><br>|
|public|<em><strong>getName</strong>(): string</em><br>|
|abstract public|<em><strong>authenticate</strong>( ?string $code ): void</em><br>|


<a id="rudra_oauthclient_provider_github"></a>

### Class: Rudra\OAuthClient\Provider\Github
##### extends [Rudra\OAuthClient\Provider\AbstractProvider](#rudra_oauthclient_provider_abstractprovider)
##### implements [Rudra\OAuthClient\Provider\ProviderInterface](#rudra_oauthclient_provider_providerinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>__construct</strong>( array $config )</em><br>|
|public|<em><strong>authenticate</strong>( ?string $code ): void</em><br>|
|public|<em><strong>user</strong>(): array</em><br>|
|protected|<em><strong>request</strong>( array $params  array $headers   $json )</em><br>|
|public|<em><strong>url</strong>(  $extraOptions ): string</em><br>|
|public|<em><strong>getName</strong>(): string</em><br>|


<a id="rudra_oauthclient_provider_google"></a>

### Class: Rudra\OAuthClient\Provider\Google
##### extends [Rudra\OAuthClient\Provider\AbstractProvider](#rudra_oauthclient_provider_abstractprovider)
##### implements [Rudra\OAuthClient\Provider\ProviderInterface](#rudra_oauthclient_provider_providerinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>__construct</strong>( array $config )</em><br>|
|public|<em><strong>authenticate</strong>( ?string $code ): void</em><br>|
|public|<em><strong>user</strong>(): array</em><br>|
|protected|<em><strong>request</strong>( array $params  array $headers   $json )</em><br>|
|public|<em><strong>url</strong>(  $extraOptions ): string</em><br>|
|public|<em><strong>getName</strong>(): string</em><br>|


<a id="rudra_oauthclient_provider_providerinterface"></a>

### Class: Rudra\OAuthClient\Provider\ProviderInterface
| Visibility | Function |
|:-----------|:---------|
|abstract public|<em><strong>authenticate</strong>( ?string $code ): void</em><br>|


<a id="rudra_oauthclient_provider_yandex"></a>

### Class: Rudra\OAuthClient\Provider\Yandex
##### extends [Rudra\OAuthClient\Provider\AbstractProvider](#rudra_oauthclient_provider_abstractprovider)
##### implements [Rudra\OAuthClient\Provider\ProviderInterface](#rudra_oauthclient_provider_providerinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>__construct</strong>( array $config )</em><br>|
|public|<em><strong>authenticate</strong>( ?string $code ): void</em><br>|
|public|<em><strong>user</strong>(): array</em><br>|
|protected|<em><strong>request</strong>( array $params  array $headers   $json )</em><br>|
|public|<em><strong>url</strong>(  $extraOptions ): string</em><br>|
|public|<em><strong>getName</strong>(): string</em><br>|
<hr>

###### created with [Rudra-Documentation-Collector](#https://github.com/Jagepard/Rudra-Documentation-Collector)
