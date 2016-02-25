## List tags

> Sample request

```java
// Create GET method handler.
HttpGet vMethod = new HttpGet(mApiEndpoint + "/v1/tags");

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
HttpResponseMessage vResponse = await vClient.GetAsync("/v1/tags");
```

```php
<?php

$response = $client->get('/v1/tags');
```

> Sample Response

```json
[
    {
        "id": 1,
        "title": "Sample Tag"
    },
    {
        "id": 2,
        "title": "Another Tag"
    },
    {...},
]
```

`GET /v1/tags`

### Query Parameters

Parameter | Default | Description
--------- | ------- | -----------
limit | 20 | Number of tags to retrieve (max 100).
offset | 0 | Search offset.
orderDir | "asc" | Direction of ordering (either `asc` or `desc`).
query | null | Search query.
