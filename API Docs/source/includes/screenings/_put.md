## Update a screening

> Sample request

```java
// ...
```

```c
// ...
```

```csharp

```

```php
<?php

// Send HTTP request.
$response = $client->put('/v1/screenings/1', [
    'json' => [
        'score' => 19,
        'meta' => [
            'isComplete' => true
        ]
    ]
]);
```

> Sample response

```json
{

}
```

`PUT /v1/screenings/{id}`

### Body parameters for existing screenings

See [Screenings &raquo; Body parameters for new screenings](#body-parameters-for-new-screenings).

### Embeds

See [Screenings &raquo; Embeds](#embeds-for-screenings).
