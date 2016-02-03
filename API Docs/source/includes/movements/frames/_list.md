## List movements

> Sample request

```java
// Create GET method handler.
HttpGet vMethod = new HttpGet(mApiEndpoint + "movements");

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
HttpResponseMessage vResponse = await vClient.GetAsync("movements");
```

```php
<?php

$response = $client->get('api/v1/movements');
```

> Sample Response

```json
{
    "total": 134,
    "offset": 0,
    "limit": 16,
    "results": [
        {
            "id": 1,
            "profileId": 1,
            "submittedBy": 1,
            "screeningId": null,
            "folderId": null,
            "title": "Sample Movement",
            "createdAt": "2015-06-01 12:00:00",
            "updatedAt": "2015-06-01 12:00:00"
        },
        {...}
    ]
}
```

`GET /v1/movements`

### Query Parameters

Parameter | Default | Description
--------- | ------- | -----------
limit | 20 | Number of movements to retrieve (max 50).
offset | 0 | Search offset.
orderBy | "createdAt" |
orderDir | "desc" |
query | null |

### Embeds

See [Movements &raquo; Embeds](#embeds-for-movements).
