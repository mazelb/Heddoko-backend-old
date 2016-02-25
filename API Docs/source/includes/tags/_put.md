## Update a tag

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
$response = $client->put('/v1/tags/1', [
    'json' => [
        'title' => 'New Tag Title'
    ]
]);
```

> Sample response

```json
{
    "id": 1,
    "title": "New Tag Title"
}
```

`PUT /v1/tags/{id}`

Updates a tag.

### Body parameters for existing tags

See [Tags &raquo; Body parameters for new tags](#body-parameters-for-new-tags).
