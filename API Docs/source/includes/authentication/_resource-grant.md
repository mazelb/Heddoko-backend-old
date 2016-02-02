## Resource Owner Password Credentials Grants

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

// Retrieve credentials from user.
$username = $_POST['username'];
$password = $_POST['password'];

// Send HTTP request.
$response = $client->post('oauth2/token', [
    'json' => [
        'grant_type' => 'password',
        'username' => $username,
        'password' => $password,
        'client_id' => 'abc',
        'client_secret' => 'xyz'
    ]
]);
```

> Sample JSON response

```json
{
    "access_token": "UfcdjO5ujMMsvtXz80hmuHrMBYg4xcExvxHISefU",
    "token_type": "Bearer",
    "expires_in": 3600,
    "refresh_token": "KQK0svzSAy4iBap8Itk6ZFEQXqCTSYxIZCc2nWCs"
}
```

The resource owner password credentials grant is best suited for Android & iOS apps, or any app that cannot redirect the user to Heddoko's sign-in page and receive an authorization code through a pre-determined URI.

**Step 1: Collect username & password from user**

Collect the user's username and password.

**Step 2: Authenticate user**

`POST /oauth2/token`

Send the user's credentials to the API, along with app's own ID & secret.

**Step 3: Receive an access token**
