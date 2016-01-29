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
    "parent": {

    },
    "folders": [

    ],
    "movements": [
        {
            "id": ​1,
            "profileId": ​1,
            "submittedBy": ​1,
            "screeningId": null,
            "folderId": null,
            "title": "Sample Movement",
            "score": null,
            "scoreMax": null,
            "createdAt": "2016-01-01 11:30:00",
            "updatedAt": "2016-01-01 11:30:00"
        },
        {...}
    ]
}
```

`GET /api/v1/profiles/{profileId}/folders`

### Embeds

See [Folders &raquo; Embeds](#embeds-for-folders).
