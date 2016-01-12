## Update a profile

> Sample request

```java
// ...
```

```c
// ...
```

```csharp
var vProfile = new Profile()
{
    mass = 52,
    notes = "Not available on Mondays."
};

HttpResponseMessage vResponse = await vClient.PutAsJsonAsync("profiles/1", vProfile);
```

```php
// Send HTTP request.
$response = $client->put('profiles/1', [
    'json' => [
        'mass' => 52,
        'notes' => 'Not available on Mondays.',
    ]
]);
```

> Sample response

```json
{
    "id": ​1,
    "firstName": "Jane",
    "lastName": "Doe",
    "height": 1.55,
    "mass": 52,
    "dob": "1980-01-01 11:00:00",
    "gender": "female",
    "phone": "+1 555-123-4567",
    "email": "jane@example.com",
    "notes": "Not available on Mondays.",
    "createdAt": "2015-06-01 12:00:00",
    "updatedAt": "2015-06-01 12:00:00",
    "avatarSrc": ""
}
```

`PUT /api/v1/profiles/{id}`

Updates a profile.

### Body Parameters

See [Create a profile](#create-a-profile).

### Embeds

See [Profiles &raquo; Embeds](#embeds-for-profiles).
