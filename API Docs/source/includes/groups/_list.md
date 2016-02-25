## List groups

> Sample request

```java
// Create GET method handler.
HttpGet vMethod = new HttpGet(mApiEndpoint + "/v1/groups");

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
HttpResponseMessage vResponse = await vClient.GetAsync("/v1/groups");
```

```php
<?php

$response = $client->get('/v1/groups');
```

> Sample response

```json
[
    {
        "id": 1,
        "mainTagId": null,
        "name": "Sample Group",
        "meta": null,
        "createdAt": "2015-06-01 12:00:00",
        "updatedAt": "2015-06-01 12:00:00"
    },
    {...},
    {...}
]
```

`GET /v1/groups`

### Query Parameters

Parameter | Default | Description
--------- | ------- | -----------
limit | 20 | Number of profiles to retrieve (max 50).
offset | 0 | Search offset.
orderBy | "createdAt" |
orderDir | "desc" |
query | " " |

### Embeds

See [Groups &raquo; Embeds for groups](#embeds-for-groups).
