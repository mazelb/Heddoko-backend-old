## Create a user

> Sample request

```java

```

```c
// ...
```

```csharp

```

```php
<?php

// Send HTTP request.
$response = $client->post('/v1/users', [
    'headers' => [
        'Authorization' => 'Bearer ACCESS_TOKEN'
    ],
    'json' => [
        'firstName' => 'Jane',
        'lastName' => 'Doe',
        'email' => 'jane@example.com',
        'username' => 'jane.doe',
        'password' => 'pa ss wo rd',
        'password_confirmation' => 'pa ss wo rd',
        'role' => 'manager',
    ]
]);
```

> Sample response

```json
{
    "email": "jane@example.com",
    "username": "jane.doe",
    "phone": null,
    "createdAt": "2015-06-01 12:00:00",
    "updatedAt": "2015-06-01 12:00:00",
    "id": 1,
    "avatarSrc": "",
    "avatar": null
}
```

<aside class="warning">
In Development.
</aside>

`POST /v1/users/`

### Body parameters

Parameter | Default | Description
--------- | ------- | -----------
firstName **(required)** | null | User's given name (no more than 100 characters)
lastName **(required)** | null | User's family name (no more than 100 characters)
email **(required)** | null | User's email address (no more than 255 characters)
username **(required)** | null | Username (no more than 255 characters)
password **(required)** | null | User's password (between 6 and 60 characters)
password_confirmation **(required)** | null | Password confirmation (NOTE: use snake_casing, i.e. `password_confirmation` instead of  `passwordConfirmation`)
role | null | One of `admin` or `manager`
