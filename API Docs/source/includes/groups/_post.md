## Create a group

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
$response = $client->post('/v1/groups', [
    'json' => [
        'name' => 'Sample Group',
        'meta' => [
            'hasSomeAttribute' => true,
            'summary' => 'Lorem ipsum dolor...'
        ]
    ]
]);
```

> Sample response

```json
{
    "id": 1,
    "mainTagId": null,
    "name": "Sample Group",
    "meta": {
        "hasSomeAttribute": true,
        "summary": "Lorem ipsum dolor..."
    },
    "createdAt": "2015-06-01 12:00:00",
    "updatedAt": "2015-06-01 12:00:00",
}
```

`POST /v1/groups`

### Body parameters for new groups

Parameter | Default | Description
--------- | ------- | -----------
name **required** | null | Name of group.
mainTagId | null | ID of main tag.
meta | null | Object representing metadata.

### Embeds

See [Groups &raquo; Embeds](#embeds-for-groups).
