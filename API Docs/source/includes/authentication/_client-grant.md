## Client Credentials Grants

> Sample request

```java
// ...
```

```c
// ...
```

```csharp
// ...
```

```php
<?php

// Send HTTP request.
$response = $client->post('oauth2/token', [
    'json' => [
        'grant_type' => 'client_credentials',
        'client_id' => 'abc',
        'client_secret' => 'xyz'
    ]
]);
```

> Sample response

```json
{
    "access_token": "PK7FoqmPTgOWZu3SvvDLF3pV5st0lLgCddD9M98H",
    "token_type": "Bearer",
    "expires_in": 3600
}
```

`POST /oauth2/token`

The client credentials grant is best suited for apps which only need limited, non-user specific access to the API. Instead of having the user authenticate themselves in order to receive an access token, the app uses its own ID & secret. The process can be summarized as:

App sends its own credentials to the API » App receives an access token