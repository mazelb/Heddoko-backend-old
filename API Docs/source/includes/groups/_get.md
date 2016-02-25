## Retrieve a group

> Sample request

```java
// Create GET method handler.
HttpGet vMethod = new HttpGet(mApiEndpoint + "/v1/groups/1?embed=avatarSrc,managers");

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
HttpResponseMessage vResponse = await vClient.GetAsync("/v1/groups/1?embed=avatarSrc,managers");
```

```php
<?php

$response = $client->get('/v1/groups/1?embed=avatarSrc,managers');
```

> Sample response

```json
{
    "id": 1,
    "mainTagId": null,
    "name": "Sample Group",
    "meta": null,
    "createdAt": "2015-06-01 12:00:00",
    "updatedAt": "2015-06-01 12:00:00",
    "managers": [
        {
            "id": ​1,
            "email": "jane@example.com",
            "username": "jane.doe",
            "firstName": "Jane",
            "lastName": "Doe",
            "phone": null,
            "country": null,
            "config": null,
            "createdAt": "2015-06-01 12:00:00",
            "updatedAt": "2015-06-01 12:00:00",
            "avatarSrc": ""
        },
        {...}
    ]
}
```

`GET /v1/groups/{id}`

### Embeds

See [Groups &raquo; Embeds for groups](#embeds-for-groups).
