## Retrieve a group

> Sample request

```java
// Create GET method handler.
HttpGet vMethod = new HttpGet(mApiEndpoint + "groups/1?embed=avatarSrc,managers");

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
HttpResponseMessage vResponse = await vClient.GetAsync("groups/1?embed=avatarSrc,managers");
```

```php
<?php

$response = $client->get('groups/1?embed=avatarSrc,managers');
```

> Sample response

```json

```

`GET /api/v1/groups/{id}`

### Embeds

Parameter | Description
--------- | ------- | -----------
avatarSrc | A [data URI](https://en.wikipedia.org/wiki/Data_URI_scheme) representing the group's avatar.
managers | Managers in charge of this group.
profiles | [Profiles](#profiles) belonging to this group.
