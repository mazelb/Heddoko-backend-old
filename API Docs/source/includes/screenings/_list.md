## List screenings

> Sample request

```java
// Create GET method handler.
HttpGet vMethod = new HttpGet(mApiEndpoint + "/v1/screenings");

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
HttpResponseMessage vResponse = await vClient.GetAsync("/v1/screenings");
```

```php
<?php

$response = $client->get('/v1/screenings');
```

> Sample Response

```json
{
    "total": 5,
    "offset": 0,
    "limit": 20,
    "results": [
        {
            "id": 1,
            "profileId": 1,
            "title": "Sample Test",
            "score": 19,
            "scoreMin": 0,
            "scoreMax": 21,
            "notes": null,
            "meta": null,
            "createdAt": "2015-06-01 12:00:00",
            "updatedAt": "2015-06-01 12:00:00"
        },
        {
            "id": 2,
            "profileId": 1,
            "title": "Sample Test",
            "score": 14,
            "scoreMin": 0,
            "scoreMax": 21,
            "notes": null,
            "meta": null,
            "createdAt": "2015-06-01 12:00:00",
            "updatedAt": "2015-06-01 12:00:00"
        },
        {...},
        {...},
        {...}
    ]
}
```

`GET /v1/screenings`

Queries the API for screenings against the specified search parameters.

### Query Parameters

Parameter | Default | Description
--------- | ------- | -----------
profileId | null | Narrows the screening to a those belonging to the specified profile.
limit | 20 | Number of movements to retrieve (max 20).
offset | 0 | Search offset.
orderBy | "createdAt" | Ordering of results (one of `title`, `createdAt` or `updatedAt`).
orderDir | "desc" | Direction of ordering (either `asc` or `desc`).
query | null | Search query.

### Embeds

See [Screenings &raquo; Embeds](#embeds-for-screenings).
