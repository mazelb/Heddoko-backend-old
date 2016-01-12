## List profiles

> Sample request

```java
// Create GET method handler.
HttpGet vMethod = new HttpGet(mApiEndpoint + "profiles");

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
HttpResponseMessage vResponse = await vClient.GetAsync("profiles");
```

```php
<?php

$response = $client->get('api/v1/profiles');
```

`GET /api/v1/profiles`

### Query Parameters

Parameter | Default | Description
--------- | ------- | -----------
limit | 20 | Number of profiles to retrieve (max 50).
offset | 0 | Search offset.
orderBy | "createdAt" |
orderDir | "desc" |
query | null |

### Embeds

See [Profiles &raquo; Embeds](#embeds-for-profiles).
