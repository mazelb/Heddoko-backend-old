## List profiles

> Sample request

```java
// Create GET method handler.
HttpGet vMethod = new HttpGet(mApiEndpoint + "profiles");

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
HttpResponseMessage vResponse = await vClient.GetAsync("profiles");
```

```php
<?php

$response = $client->get('api/v1/profiles?embed=tags');
```

> Sample response.

```json
[
    {
        "id": 1,
        "firstName": "Jane",
        "lastName": "Doe",
        "createdAt": "2015-06-01 12:00:00",
        "updatedAt": "2015-06-01 12:00:00",
        "tags": [...]
    },
    {
        "id": 2,
        "firstName": "Mike",
        "lastName": "Watts",
        "createdAt": "2015-06-01 12:00:00",
        "updatedAt": "2015-06-01 12:00:00",
        "tags": [...]
    },
    {
        "id": 21,
        "firstName": "Kara",
        "lastName": "Romanu",
        "createdAt": "2015-06-01 12:00:00",
        "updatedAt": "2015-06-01 12:00:00",
        "tags": [...]
    }
]
```

`GET /v1/profiles`

### Query Parameters

Parameter | Default | Description
--------- | ------- | -----------
limit | 20 | Number of profiles to retrieve (max 50).
offset | 0 | Search offset.
orderBy | "createdAt" |
orderDir | "desc" |
query | null |

### Embeds

See [Profiles &raquo; Embeds](#embeds-for-profiles).
