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
| public | `__construct(array $providers)`<br>Initializes the OAuthClient with an array of providers.<br>Each provider is stored in the `$providers` array with its name as the key.<br>-------------------------<br>Инициализирует OAuthClient массивом провайдеров.<br>Каждый провайдер сохраняется в массиве `$providers` с его именем в качестве ключа. |
| public | `provider(string $key): Rudra\OAuthClient\Provider\ProviderInterface`<br>Retrieves a provider by its name.<br>If the provider exists, it is returned; otherwise, an exception is thrown.<br>-------------------------<br>Извлекает провайдер по его имени.<br>Если провайдер существует, он возвращается; в противном случае выбрасывается исключение. |


<a id="rudra_oauthclient_provider_abstractprovider"></a>

### Class: Rudra\OAuthClient\Provider\AbstractProvider
| Visibility | Function |
|:-----------|:---------|
| public | `__construct(array $config)`<br> |
| public | `user(): array`<br> |
| protected | `request(array $params, array $headers,  $json)`<br>Sends an HTTP request using cURL with optional parameters and headers.<br>The method supports both GET and POST requests and can return the response as JSON or raw data.<br>-------------------------<br>Отправляет HTTP-запрос с использованием cURL с необязательными параметрами и заголовками.<br>Метод поддерживает как GET, так и POST запросы и может возвращать ответ в формате JSON или в сыром виде. |
| public | `url( $extraOptions): string`<br>Generates a URL for authentication with optional additional parameters.<br>The method constructs a query string by merging default parameters with any extra options provided.<br>The resulting URL is used for redirecting users to the authentication endpoint.<br>-------------------------<br>Генерирует URL для аутентификации с возможностью добавления дополнительных параметров.<br>Метод создает строку запроса, объединяя параметры по умолчанию с любыми дополнительными опциями.<br>Полученный URL используется для перенаправления пользователей на конечную точку аутентификации. |
| public | `getName(): string`<br> |
| abstract public | `authenticate(?string $code): void`<br>Authenticates the user using the provided authorization code.<br>The method should handle the logic for exchanging the code for an access token<br>and retrieving the user's information from the provider's API.<br>-------------------------<br>Аутентифицирует пользователя с использованием предоставленного кода авторизации.<br>Метод должен обрабатывать логику обмена кода на токен доступа<br>и получение информации о пользователе из API провайдера. |


<a id="rudra_oauthclient_provider_github"></a>

### Class: Rudra\OAuthClient\Provider\Github
| Visibility | Function |
|:-----------|:---------|
| public | `__construct(array $config)`<br>Initializes the GitHub authentication class with default configuration and URLs.<br>The constructor sets up the necessary endpoints for authentication and API access.<br>-------------------------<br>Инициализирует класс аутентификации GitHub с базовой конфигурацией и URL-адресами.<br>Конструктор настраивает необходимые конечные точки для аутентификации и доступа к API. |
| public | `authenticate(?string $code): void`<br>Authenticates the user using the provided authorization code.<br>The method exchanges the code for an access token and retrieves the user's information from the GitHub API.<br>If the access token is successfully obtained, the user's data is fetched and stored in the `$user` property.<br>-------------------------<br>Аутентифицирует пользователя с использованием предоставленного кода авторизации.<br>Метод обменивает код на токен доступа и получает информацию о пользователе из API GitHub.<br>Если токен доступа успешно получен, данные пользователя извлекаются и сохраняются в свойстве `$user`. |
| public | `user(): array`<br> |
| protected | `request(array $params, array $headers,  $json)`<br>Sends an HTTP request using cURL with optional parameters and headers.<br>The method supports both GET and POST requests and can return the response as JSON or raw data.<br>-------------------------<br>Отправляет HTTP-запрос с использованием cURL с необязательными параметрами и заголовками.<br>Метод поддерживает как GET, так и POST запросы и может возвращать ответ в формате JSON или в сыром виде. |
| public | `url( $extraOptions): string`<br>Generates a URL for authentication with optional additional parameters.<br>The method constructs a query string by merging default parameters with any extra options provided.<br>The resulting URL is used for redirecting users to the authentication endpoint.<br>-------------------------<br>Генерирует URL для аутентификации с возможностью добавления дополнительных параметров.<br>Метод создает строку запроса, объединяя параметры по умолчанию с любыми дополнительными опциями.<br>Полученный URL используется для перенаправления пользователей на конечную точку аутентификации. |
| public | `getName(): string`<br> |


<a id="rudra_oauthclient_provider_google"></a>

### Class: Rudra\OAuthClient\Provider\Google
| Visibility | Function |
|:-----------|:---------|
| public | `__construct(array $config)`<br>Initializes the Google authentication class with default configuration and URLs.<br>The constructor sets up the necessary endpoints for authentication and API access.<br>-------------------------<br>Инициализирует класс аутентификации Google с базовой конфигурацией и URL-адресами.<br>Конструктор настраивает необходимые конечные точки для аутентификации и доступа к API. |
| public | `authenticate(?string $code): void`<br>Authenticates the user using the provided authorization code.<br>The method exchanges the code for an access token and retrieves the user's information from the Google API.<br>If the access token is successfully obtained, the user's data is fetched and stored in the `$user` property.<br>-------------------------<br>Аутентифицирует пользователя с использованием предоставленного кода авторизации.<br>Метод обменивает код на токен доступа и получает информацию о пользователе из API Google.<br>Если токен доступа успешно получен, данные пользователя извлекаются и сохраняются в свойстве `$user`. |
| public | `user(): array`<br> |
| protected | `request(array $params, array $headers,  $json)`<br>Sends an HTTP request using cURL with optional parameters and headers.<br>The method supports both GET and POST requests and can return the response as JSON or raw data.<br>-------------------------<br>Отправляет HTTP-запрос с использованием cURL с необязательными параметрами и заголовками.<br>Метод поддерживает как GET, так и POST запросы и может возвращать ответ в формате JSON или в сыром виде. |
| public | `url( $extraOptions): string`<br>Generates a URL for authentication with optional additional parameters.<br>The method constructs a query string by merging default parameters with any extra options provided.<br>The resulting URL is used for redirecting users to the authentication endpoint.<br>-------------------------<br>Генерирует URL для аутентификации с возможностью добавления дополнительных параметров.<br>Метод создает строку запроса, объединяя параметры по умолчанию с любыми дополнительными опциями.<br>Полученный URL используется для перенаправления пользователей на конечную точку аутентификации. |
| public | `getName(): string`<br> |


<a id="rudra_oauthclient_provider_providerinterface"></a>

### Class: Rudra\OAuthClient\Provider\ProviderInterface
| Visibility | Function |
|:-----------|:---------|
| abstract public | `authenticate(?string $code): void`<br>Authenticates the user using the provided authorization code.<br>The method should handle the logic for exchanging the code for an access token<br>and retrieving the user's information from the provider's API.<br>-------------------------<br>Аутентифицирует пользователя с использованием предоставленного кода авторизации.<br>Метод должен обрабатывать логику обмена кода на токен доступа<br>и получение информации о пользователе из API провайдера. |


<a id="rudra_oauthclient_provider_yandex"></a>

### Class: Rudra\OAuthClient\Provider\Yandex
| Visibility | Function |
|:-----------|:---------|
| public | `__construct(array $config)`<br>Initializes the Yandex authentication class with default configuration and URLs.<br>The constructor sets up the necessary endpoints for authentication and API access.<br>-------------------------<br>Инициализирует класс аутентификации Yandex с базовой конфигурацией и URL-адресами.<br>Конструктор настраивает необходимые конечные точки для аутентификации и доступа к API. |
| public | `authenticate(?string $code): void`<br>Authenticates the user using the provided authorization code.<br>The method exchanges the code for an access token and retrieves the user's information from the Yandex API.<br>If the access token is successfully obtained, the user's data is fetched and stored in the `$user` property.<br>-------------------------<br>Аутентифицирует пользователя с использованием предоставленного кода авторизации.<br>Метод обменивает код на токен доступа и получает информацию о пользователе из API Yandex.<br>Если токен доступа успешно получен, данные пользователя извлекаются и сохраняются в свойстве `$user`. |
| public | `user(): array`<br> |
| protected | `request(array $params, array $headers,  $json)`<br>Sends an HTTP request using cURL with optional parameters and headers.<br>The method supports both GET and POST requests and can return the response as JSON or raw data.<br>-------------------------<br>Отправляет HTTP-запрос с использованием cURL с необязательными параметрами и заголовками.<br>Метод поддерживает как GET, так и POST запросы и может возвращать ответ в формате JSON или в сыром виде. |
| public | `url( $extraOptions): string`<br>Generates a URL for authentication with optional additional parameters.<br>The method constructs a query string by merging default parameters with any extra options provided.<br>The resulting URL is used for redirecting users to the authentication endpoint.<br>-------------------------<br>Генерирует URL для аутентификации с возможностью добавления дополнительных параметров.<br>Метод создает строку запроса, объединяя параметры по умолчанию с любыми дополнительными опциями.<br>Полученный URL используется для перенаправления пользователей на конечную точку аутентификации. |
| public | `getName(): string`<br> |
<hr>

###### created with [Rudra-Documentation-Collector](#https://github.com/Jagepard/Rudra-Documentation-Collector)
