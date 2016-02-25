## Create a folder

> Sample request

```java

```

```c
// ...
```

```csharp

```

```php
<?php

// Send HTTP request.
$response = $client->post('/v1/profiles/1/folders', [
    'json' => [
        'name' => 'New Folder',
    ]
]);
```

> Sample response

```json
{
    "id": 2,
    "profileId": 1,
    "name": "New Folder",
    "systemName": "",
    "path": "/",
    "parentId": null
}
```

`POST /v1/profiles/{profileId}/folders`

### Embeds

See [Folders &raquo; Embeds](#embeds-for-folders).

### Body parameters for new folders

Parameter | Default | Description
--------- | ------- | -----------
name **required** | null | Name of folder.
folderId | null | ID of parent folder.
