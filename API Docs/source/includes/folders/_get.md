## Retrieve a folder

> Sample request

```java
// Create GET method handler.
HttpGet vMethod = new HttpGet(mApiEndpoint + "/v1/profiles/1/folders/1?embed=movements");

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
HttpResponseMessage vResponse = await vClient.GetAsync("/v1/profiles/1/folders/1?embed=movements");
```

```php
<?php

$response = $client->get('/v1/profiles/1/folders/1?embed=movements');
```

> Sample response

```json
{
    "id": 1,
    "profileId": 1,
    "name": "Sample Folder",
    "systemName": "",
    "path": "/",
    "parentId": null,
    "movements": [
        {
            "id": 1,
            "complexEquipmentId": null,
            "profileId": 1,
            "submittedBy": null,
            "screeningId": null,
            "folderId": 1,
            "title": "Sample Movement",
            "createdAt": "2016-02-25 16:23:48",
            "updatedAt": "2016-02-25 16:23:48"
        },
        {...},
        {...},
        {...},
    ]
}
```

`GET /v1/profiles/{profileId}/folders/{id}`

### Embeds

See [Folders &raquo; Embeds](#embeds-for-folders).
