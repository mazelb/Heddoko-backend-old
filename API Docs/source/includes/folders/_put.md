## Update a folder

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
$response = $client->put('/v1/profiles/1/folders/2', [
    'json' => [
        'name' => 'Folder with new name',
        'parentId' => 1
    ]
]);
```

> Sample response

```json
{
    "id": 2,
    "profileId": 1,
    "name": "Folder with new name",
    "systemName": "",
    "path": "/",
    "parentId": 1
}
```

`PUT /v1/profiles/{profileId}/folders/{id}`

### Body parameters for existing folders

See [Folders &raquo; Body parameters for new folders](#body-parameters-for-new-folders).

### Embeds

See [Folders &raquo; Embeds](#embeds-for-folders).
