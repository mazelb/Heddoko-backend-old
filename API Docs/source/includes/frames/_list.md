## List movement frames

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

$response = $client->get('/v1/movements/1/frames?embed=instantaneousData');
```

> Sample Response

```json
{
    "total": 986,
    "offset": 0,
    "limit": null,
    "frames": [
        {
            "formatRevision": 1,
            "timestamp": "1456502855",
            "instantaneousData": {
                "euler": {...},
                "angularVelocity": {...},
                "...": {...},
                "...": {...},
            }
        },
        {...}
    ]
}
```

`GET /v1/movements/{movementId}/frames`

### Query Parameters

Parameter | Default | Description
--------- | ------- | -----------
limit | null | Number of movement frames to retrieve.
offset | 0 | Search offset.
orderDir | "asc" | Direction of ordering (either `asc` or `desc`).

### Embeds

See [Movement frames &raquo; embeds](#embeds-for-movement-frames).
