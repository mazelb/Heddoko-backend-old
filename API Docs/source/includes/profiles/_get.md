## Retrieve a profile

> Sample request

```java
// Create GET method handler.
HttpGet vMethod = new HttpGet(mApiEndpoint + "profiles/1?embed=groups,managers");

// Send HTTP request.
CloseableHttpResponse vResponse = vClient.execute(vMethod);
try {
    // Consume data.
    // ...
}
finally {
    vResponse.close();
}
```

```c
// ...
```

```csharp
HttpResponseMessage vResponse = await vClient.GetAsync("profiles/1");
```

```php
<?php

$response = $client->get('profiles/1?embed=groups,managers');
```

> Sample response

```json
{
    "id": ​1,
    "firstName": "Jane",
    "lastName": "Doe",
    "createdAt": "2015-06-01 12:00:00",
    "updatedAt": "2015-06-01 12:00:00",
    "avatarSrc": "",
    "groups": [
        {
            "id": ​1,
            "name": "Example Team",
            "meta": null,
            "createdAt": "2015-06-01 12:00:00",
            "updatedAt": "2015-06-01 12:00:00",
            "avatarSrc": ""
        }
    ],
    "managers": [
        {
            "id": ​1,
            "email": "manager@example.com",
            "username": "mike.watts",
            "firstName": "Mike",
            "lastName": "Watts",
            "phone": null,
            "country": "",
            "config": null,
            "createdAt": "2015-06-01 12:00:00",
            "updatedAt": "2015-06-01 12:00:00",
            "avatarSrc": ""
        }
    ],
    "screenings": [...],
    "primaryTag": null,
    "secondaryTags": [...]
}
```

`GET /v1/profiles/{id}`

### Embeds

See [Profiles &raquo; Embeds](#embeds-for-profiles).
