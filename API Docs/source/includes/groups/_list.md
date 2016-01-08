## List groups

> Sample request

```java
// Create GET method handler.
HttpGet vMethod = new HttpGet(mApiEndpoint + "groups");

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
HttpResponseMessage vResponse = await vClient.GetAsync("groups");
```

```php
<?php

$response = $client->get('api/v1/groups');
```

<aside class="success">
Has embeddable properties.
</aside>

`GET /api/v1/groups`

### Query Parameters

Parameter | Default | Description
--------- | ------- | -----------
limit | 20 | Number of profiles to retrieve (max 50).
offset | 0 | Search offset.
orderBy | "createdAt" |
orderDir | "desc" |
query | " " |

### Embeds

See [Groups &raquo; Retrieve a group](#retrieve-a-group).
