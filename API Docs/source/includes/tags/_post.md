## Create a tag

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
$response = $client->post('/v1/tags', [
    'json' => [
        'title' => 'New Tag',
    ]
]);
```

> Sample response

```json
{
    "id": 1,
    "title": "New Tag"
}
```

`POST /v1/tags`
