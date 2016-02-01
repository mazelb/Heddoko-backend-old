## Delete a profile avatar

> Sample request

```java
// ...
```

```c
// ...
```

```csharp
HttpResponseMessage vResponse = await vClient.DeleteAsync("profiles/1/avatar");
```

```php
$response = $client->delete('profiles/1/avatar');
```

`DELETE /v1/profiles/{id}/avatar`

Deletes a profile's avatar.
