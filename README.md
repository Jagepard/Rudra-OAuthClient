[![CodeFactor](https://www.codefactor.io/repository/github/jagepard/rudra-oauthclient/badge)](https://www.codefactor.io/repository/github/jagepard/rudra-oauthclient)
-----

# OAuthClient | [API](https://github.com/Jagepard/Rudra-OAuthClient/blob/master/docs.md "Documentation API")

A lightweight, extensible OAuth 2.0 client for the [Rudra Framework](https://github.com/Jagepard/Rudra). Follows the KISS principle: no unnecessary abstractions, no hidden magic — just a straightforward way to integrate social login.

## Requirements
- PHP 8.3+ (uses `#[\Override]` attribute and typed properties)
- cURL extension enabled

## Installation
```bash
composer require rudra/oauth-client
```

## Configuration
In your Rudra application settings file (`setting.($env).yml`), define your providers. The top-level key (e.g., `yandex`) is the provider identifier used in callbacks:

```yml
oauth:
    yandex:
        class: Rudra\OAuthClient\Provider\Yandex
        client_id: "your_client_id"
        client_secret: "your_client_secret"
        redirect_uri: "https://your-site.com/oauth?provider=yandex"
```

You can add as many providers as you need:

```yml
oauth:
    yandex:
        class: Rudra\OAuthClient\Provider\Yandex
        client_id: "yandex_id"
        client_secret: "yandex_secret"
        redirect_uri: "https://your-site.com/oauth?provider=yandex"
    vk:
        class: Rudra\OAuthClient\Provider\VK
        client_id: "vk_id"
        client_secret: "vk_secret"
        redirect_uri: "https://your-site.com/oauth?provider=vk"
```

> 💡 **Note:** The `redirect_uri` must include the `provider` query parameter matching the config key (e.g., `?provider=yandex`). This is how the callback handler identifies which provider to use.

## Integration Example (Rudra Task)

```php
namespace App\Containers\Auth\Task;

use Rudra\Auth\AuthFacade as Auth;
use Rudra\Container\Facades\Rudra;
use Rudra\Container\Facades\Session;
use Rudra\Redirect\RedirectFacade as Redirect;
use App\Containers\DB\Entity\Users;

class OAuth
{
    /**
     * Authorizes and, if necessary, registers a user
     */
    public static function run(array $inputData): void
    {
        if (!isset($inputData['code'], $inputData['provider'])) {
            return;
        }

        $oauthConfig = Rudra::config()->get('oauth');
        $providerKey = $inputData['provider'];

        if (!isset($oauthConfig[$providerKey])) {
            return; // Unknown provider
        }

        $providerConfig = $oauthConfig[$providerKey];
        $providerClass  = $providerConfig['class'];

        $provider = new $providerClass($providerConfig);
        $provider->authenticate($inputData['code']);

        $oauthUser = (object) $provider->user();
        $email     = $oauthUser->default_email ?? $oauthUser->email ?? ($oauthUser->login . '@' . $provider->getName());
        $login     = $oauthUser->login ?? $oauthUser->name;
        $user      = Users::getUser($email);

        if (empty($user)) {
            Users::create([
                'name'     => $login,
                'email'    => strtolower($email),
                'password' => $providerKey,
            ]);
            $user = Users::getUser($email);
        }

        $user = $user[0];
        session_regenerate_id(true);
        Session::set(["token", md5($user['password'] . $user['email'] . Auth::getSessionHash())]);
        Session::set(["user", $user]);
        Redirect::run("admin/item");
    }
}
```

## Creating a Custom Provider

To add a new OAuth provider (e.g., VK, Google, GitHub), extend `AbstractProvider` and implement the `authenticate()` method.

**Important:** The `request()` method has dual behavior:
- `request($params)` — sends a **POST** request to the `access_token` URL.
- `request()` (without parameters) — sends a **GET** request to the `remote_api` URL.

```php
namespace Rudra\OAuthClient\Provider;

class CustomProvider extends AbstractProvider
{
    public function __construct(array $config)
    {
        parent::__construct($config);

        $this->name = 'custom';
        $this->urls = [
            'auth'         => 'https://provider.com/oauth/authorize',
            'access_token' => 'https://provider.com/oauth/token',
            'remote_api'   => 'https://provider.com/api/userinfo',
        ];
    }

    #[\Override]
    public function authenticate(?string $code = null): void
    {
        if (!$code) {
            return;
        }

        // 1. Exchange code for token (POST)
        $token = $this->request([
            'grant_type' => 'authorization_code',
            'code'       => $code,
        ]);

        if (!isset($token['access_token'])) {
            return;
        }

        // 2. Fetch user data (GET)
        $this->urls['remote_api'] .= '?access_token=' . $token['access_token'];
        $this->user = $this->request();
    }
}
```

## License

This project is licensed under the **Mozilla Public License 2.0 (MPL-2.0)** — a free, open-source license that:

- Requires preservation of copyright and license notices,
- Allows commercial and non-commercial use,
- Requires that any modifications to the original files remain open under MPL-2.0,
- Permits combining with proprietary code in larger works.

📄 Full license text: [LICENSE](./LICENSE)  
🌐 Official MPL-2.0 page: https://mozilla.org/MPL/2.0/