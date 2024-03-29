## Retrieve a tag

> Sample request

```java
// Create GET method handler.
HttpGet vMethod = new HttpGet(mApiEndpoint + "/v1/tags/1");

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
HttpResponseMessage vResponse = await vClient.GetAsync("/v1/tags/1");
```

```php
<?php

$response = $client->get('/v1/tags/1');
```

> Sample response

```json
{
    "id": 1,
    "title": "Sample Tag"
}
```

`GET /v1/tags/{id}`
