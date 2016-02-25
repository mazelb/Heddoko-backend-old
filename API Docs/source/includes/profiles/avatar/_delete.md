## Delete a profile avatar

> Sample request

```java
// ...
```

```c
// ...
```

```csharp
HttpResponseMessage vResponse = await vClient.DeleteAsync("/v1/profiles/1/avatar");
```

```php
<?php

$response = $client->delete('/v1/profiles/1/avatar');
```

`DELETE /v1/profiles/{id}/avatar`

Deletes a profile's avatar.
