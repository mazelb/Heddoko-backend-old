## List folders

> Sample request

```java
// Create GET method handler.
HttpGet vMethod = new HttpGet(mApiEndpoint + "/v1/profiles/1/folders?embed=parent,children");

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
HttpResponseMessage vResponse = await vClient.GetAsync("/v1/profiles/1/folders?embed=parent,children");
```

```php
<?php

$response = $client->get('/v1/profiles/1/folders?embed=parent,children');
```

> Sample Response

```json
{
    "parent": {...},
    "folders": [
        {
            "id": 1,
            "profileId": 1,
            "name": "Sample Folder",
            "systemName": "",
            "path": "/",
            "parentId": null
        },
        {...}
    ]
}
```

`GET /v1/profiles/{profileId}/folders`

### Embeds

See [Folders &raquo; Embeds](#embeds-for-folders).
