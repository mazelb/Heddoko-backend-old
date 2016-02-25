## Delete a group avatar

> Sample request

```java
// ...
```

```c
// ...
```

```csharp
HttpResponseMessage vResponse = await vClient.DeleteAsync("groups/1/avatar");
```

```php
<?php

$response = $client->delete('/v1/groups/1/avatar');
```

`DELETE /v1/groups/{id}/avatar`

Deletes a group's avatar.
