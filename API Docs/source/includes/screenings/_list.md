## List screenings

> Sample request

```java
// Create GET method handler.
HttpGet vMethod = new HttpGet(mApiEndpoint + "screenings");

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
HttpResponseMessage vResponse = await vClient.GetAsync("screenings");
```

```php
<?php

$response = $client->get('api/v1/screenings');
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
            "scoreMax": 21,
            "scoreMin": 0,
            "notes": null,
            "createdAt": "2015-06-01 12:00:00",
            "updatedAt": "2015-06-01 12:00:00"
        },
        {
            "id": 2,
            "profileId": 1,
            "title": "Sample Test",
            "score": 14,
            "scoreMax": 21,
            "scoreMin": 0,
            "notes": null,
            "createdAt": "2015-06-01 12:00:00",
            "updatedAt": "2015-06-01 12:00:00"
        },
        {...},
        {...},
        {...}
    ]
}
```

<aside class="warning">
In Development.
</aside>

`GET /v1/screenings`

Queries the API for screenings against the specified search parameters.

### Query Parameters

Parameter | Default | Description
--------- | ------- | -----------
profileId | null | Narrows the screening to a those belonging to the specified profile.
limit | 20 | Number of profiles to retrieve (max 50).
offset | 0 | Search offset.
orderBy | "createdAt" |
orderDir | "desc" |
query | " " |

### Embeds

See [Screenings &raquo; Embeds](#embeds-for-screenings).
