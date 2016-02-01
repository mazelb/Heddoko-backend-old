## Retrieve a movement

> Sample request

```java
// Create GET method handler.
HttpGet vMethod = new HttpGet(mApiEndpoint + "movements/1?embed=meta,tags");

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
HttpResponseMessage vResponse = await vClient.GetAsync("movements/1?embed=meta,tags");
```

```php
<?php

$response = $client->get('movements/1?embed=meta,tags');
```

> Sample response

```json
{
    "id": 1,
    "profileId": 1,
    "submittedBy": 1,
    "screeningId": null,
    "folderId": null,
    "title": "Sample Movement",
    "createdAt": "2015-06-01 12:00:00",
    "updatedAt": "2015-06-01 12:00:00",
    "meta": {
        "startKeyframe": 1,
        "endKeyframe": 999,
        "score": 0,
        "scoreMax": 5,
        "notes": "",
        "virtualPath": "",
        "filename": "",
        "params": {}
    },
    "tags": []
}
```

`GET /v1/movements/{id}`

### Embeds

See [Movements &raquo; Embeds](#embeds-for-movements).
