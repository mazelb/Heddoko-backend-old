## Retrieve a movement

> Sample request

```java
// Create GET method handler.
HttpGet vMethod = new HttpGet(mApiEndpoint + "profiles/1/folders/1");

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
HttpResponseMessage vResponse = await vClient.GetAsync("profiles/1/folders/1");
```

```php
<?php

$response = $client->get('profiles/1/folders/1');
```

> Sample response

```json

```

`GET /v1/profiles/{profileId}/folders/{id}`

### Embeds

See [Folders &raquo; Embeds](#embeds-for-folders).
