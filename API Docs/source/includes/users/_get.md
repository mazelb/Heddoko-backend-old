## Retrieve a user

> Sample request

```java
// Create GET method handler.
HttpGet vMethod = new HttpGet(mApiEndpoint + "/v1/users/1");

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
HttpResponseMessage vResponse = await vClient.GetAsync("/v1/users/1");
```

```php
<?php

$response = $client->get('/v1/users/1');
```

> Sample response

```json

```

<aside class="warning">
In Development.
</aside>

`GET /v1/users/{id}`
