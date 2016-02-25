## Update a group

> Sample request

```java
// ...
```

```c
// ...
```

```csharp
// ...
```

```php
<?php

// Send HTTP request.
$response = $client->put('/v1/group/1', [
    'json' => [
        'name' => 'New Group Name',
    ]
]);
```

> Sample response

```json
{
    "id": 1,
    "mainTagId": null,
    "name": "New Group Name",
    "meta": {
        "hasSomeAttribute": true,
        "summary": "Lorem ipsum dolor..."
    },
    "createdAt": "2015-06-01 12:00:00",
    "updatedAt": "2015-06-01 12:00:00",
}
```

`PUT /v1/groups/{id}`

### Body parameters for existing groups

See [Folders &raquo; Body parameters for new groups](#body-parameters-for-new-groups).

### Embeds

See [Groups &raquo; Embeds](#embeds-for-groups).
