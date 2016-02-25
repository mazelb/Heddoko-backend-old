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

$response = $client->get('/v1/movements/1/frames');
```

> Sample Response

```json

```

<aside class="warning">
In Development.
</aside>

`GET /v1/movements/{movementId}/frames`

### Query Parameters

Parameter | Default | Description
--------- | ------- | -----------
limit | 20 | Number of movement frames to retrieve.
offset | 0 | Search offset.
orderDir | "desc" | Direction of ordering (either `asc` or `desc`).
query | null | Search query.

### Embeds

See [Movement frames &raquo; embeds](#embeds-for-movement-frames).
