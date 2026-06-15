## Table of contents
- [Rudra\OAuthClient\OAuthClient](#rudra_oauthclient_oauthclient)
- [Rudra\OAuthClient\Provider\AbstractProvider](#rudra_oauthclient_provider_abstractprovider)
- [Rudra\OAuthClient\Provider\Github](#rudra_oauthclient_provider_github)
- [Rudra\OAuthClient\Provider\Google](#rudra_oauthclient_provider_google)
- [Rudra\OAuthClient\Provider\ProviderInterface](#rudra_oauthclient_provider_providerinterface)
- [Rudra\OAuthClient\Provider\Yandex](#rudra_oauthclient_provider_yandex)


---



<a id="rudra_oauthclient_oauthclient"></a>

### Class: Rudra\OAuthClient\OAuthClient
| Visibility | Function |
|:-----------|:---------|
| public | `__construct(array $providers)`<br> |
| public | `provider(string $key): Rudra\OAuthClient\Provider\ProviderInterface`<br>Retrieves a provider by its name.<br>If the provider exists, it is returned; otherwise, an exception is thrown. |


<a id="rudra_oauthclient_provider_abstractprovider"></a>

### Class: Rudra\OAuthClient\Provider\AbstractProvider
| Visibility | Function |
|:-----------|:---------|
| public | `__construct(array $config)`<br> |
| abstract public | `authenticate(?string $code): void`<br> |
| public | `user(): array`<br> |
| protected | `request(array $params, array $headers, $json): array\|string\|false`<br>Sends an HTTP request using cURL with optional parameters and headers.<br>The method supports both GET and POST requests and can return the response as JSON or raw data. |
| public | `url(array $extraOptions): string`<br>Generates a URL for authentication with optional additional parameters.<br>The method constructs a query string by merging default parameters with any extra options provided.<br>The resulting URL is used for redirecting users to the authentication endpoint. |
| public | `getName(): string`<br> |


<a id="rudra_oauthclient_provider_github"></a>

### Class: Rudra\OAuthClient\Provider\Github
| Visibility | Function |
|:-----------|:---------|
| public | `__construct(array $config)`<br>Initializes the GitHub authentication class with default configuration and URLs.<br>The constructor sets up the necessary endpoints for authentication and API access. |
| public | `authenticate(?string $code): void`<br>Authenticates the user using the provided authorization code.<br>The method exchanges the code for an access token and retrieves the user's information from the GitHub API.<br>If the access token is successfully obtained, the user's data is fetched and stored in the `$user` property. |
| public | `user(): array`<br> |
| protected | `request(array $params, array $headers, $json): array\|string\|false`<br>Sends an HTTP request using cURL with optional parameters and headers.<br>The method supports both GET and POST requests and can return the response as JSON or raw data. |
| public | `url(array $extraOptions): string`<br>Generates a URL for authentication with optional additional parameters.<br>The method constructs a query string by merging default parameters with any extra options provided.<br>The resulting URL is used for redirecting users to the authentication endpoint. |
| public | `getName(): string`<br> |


<a id="rudra_oauthclient_provider_google"></a>

### Class: Rudra\OAuthClient\Provider\Google
| Visibility | Function |
|:-----------|:---------|
| public | `__construct(array $config)`<br>Initializes the Google authentication class with default configuration and URLs.<br>The constructor sets up the necessary endpoints for authentication and API access. |
| public | `authenticate(?string $code): void`<br>Authenticates the user using the provided authorization code.<br>The method exchanges the code for an access token and retrieves the user's information from the Google API.<br>If the access token is successfully obtained, the user's data is fetched and stored in the `$user` property. |
| public | `user(): array`<br> |
| protected | `request(array $params, array $headers, $json): array\|string\|false`<br>Sends an HTTP request using cURL with optional parameters and headers.<br>The method supports both GET and POST requests and can return the response as JSON or raw data. |
| public | `url(array $extraOptions): string`<br>Generates a URL for authentication with optional additional parameters.<br>The method constructs a query string by merging default parameters with any extra options provided.<br>The resulting URL is used for redirecting users to the authentication endpoint. |
| public | `getName(): string`<br> |


<a id="rudra_oauthclient_provider_providerinterface"></a>

### Class: Rudra\OAuthClient\Provider\ProviderInterface
| Visibility | Function |
|:-----------|:---------|
| abstract public | `authenticate(?string $code): void`<br> |


<a id="rudra_oauthclient_provider_yandex"></a>

### Class: Rudra\OAuthClient\Provider\Yandex
| Visibility | Function |
|:-----------|:---------|
| public | `__construct(array $config)`<br>Initializes the Yandex authentication class with default configuration and URLs.<br>The constructor sets up the necessary endpoints for authentication and API access. |
| public | `authenticate(?string $code): void`<br>Authenticates the user using the provided authorization code.<br>The method exchanges the code for an access token and retrieves the user's information from the Yandex API.<br>If the access token is successfully obtained, the user's data is fetched and stored in the `$user` property. |
| public | `user(): array`<br> |
| protected | `request(array $params, array $headers, $json): array\|string\|false`<br>Sends an HTTP request using cURL with optional parameters and headers.<br>The method supports both GET and POST requests and can return the response as JSON or raw data. |
| public | `url(array $extraOptions): string`<br>Generates a URL for authentication with optional additional parameters.<br>The method constructs a query string by merging default parameters with any extra options provided.<br>The resulting URL is used for redirecting users to the authentication endpoint. |
| public | `getName(): string`<br> |


---

###### created with [Rudra-Documentation-Collector](https://github.com/Jagepard/Rudra-Documentation-Collector)
