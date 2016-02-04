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

$response = $client->get('api/v1/movements/1/frames');
```

> Sample Response

```json

```

`GET /v1/movements/{movementId}/frames`

### Query Parameters

Parameter | Default | Description
--------- | ------- | -----------
limit | 20 | Number of movements to retrieve (max 50).
offset | 0 | Search offset.
orderBy | "createdAt" |
orderDir | "desc" |
query | null |

### Embeds

See [Movement frames &raquo; embeds](#embeds-for-movements).
