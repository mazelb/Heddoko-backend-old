## Retrieve a screening

> Sample request

```java
// Create GET method handler.
HttpGet vMethod = new HttpGet(mApiEndpoint + "/v1/screenings/1?embed=movements");

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
HttpResponseMessage vResponse = await vClient.GetAsync("/v1/screenings/1?embed=movements");
```

```php
<?php

$response = $client->get('/v1/screenings/1?embed=movements');
```

> Sample response

```json
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
    "updatedAt": "2015-06-01 12:00:00",
    "movements": [
        {
            "id": 1,
            "profileId": 1,
            "submittedBy": 1,
            "screeningId": 1,
            "folderId": 5,
            "title": "Deep Squat",
            "createdAt": "2015-06-01 12:00:00",
            "updatedAt": "2015-06-01 12:00:00"
        },
        {
            "id": 2,
            "profileId": 1,
            "submittedBy": 1,
            "screeningId": 1,
            "folderId": 5,
            "title": "Hurdle Step - Left",
            "createdAt": "2015-06-01 12:00:00",
            "updatedAt": "2015-06-01 12:00:00"
        },
        {...},
    ]
}
```

`GET /v1/sceenings/{id}`

### Embeds

See [Screenings &raquo; Embeds](#embeds-for-screenings).
