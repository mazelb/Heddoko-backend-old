## Retrieve a movement frame

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

$response = $client->get('/v1/movements/1/frames/1?embed=instantaneousData');
```

> Sample response

```json
{
    "formatRevision": 1,
    "timestamp": "1456502855",
    "instantaneousData": {
        "euler": {...},
        "angularVelocity": {...},
        "...": {...},
        "...": {...},
    }
}
```

`GET /v1/movements/{movementId}/frames/{frameId}`

### Embeds

See [Movement frames &raquo; Embeds](#embeds-for-movement-frames).
