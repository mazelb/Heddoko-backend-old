## Create a profile

> Sample request

```java
// Create GET method handler.
HttpPost vMethod = new HttpPost(mApiEndpoint + "v1/profiles");

// Build request body.
List <NameValuePair> vProfileMeta = new ArrayList <NameValuePair>();
vProfileMeta.add(new BasicNameValuePair("height", 1.55));
vProfileMeta.add(new BasicNameValuePair("mass", 49));
vProfileMeta.add(new BasicNameValuePair("dob", "1980-01-01 11:00:00"));
vProfileMeta.add(new BasicNameValuePair("gender", "female"));
vProfileMeta.add(new BasicNameValuePair("phone", "+1 555-123-4567"));
vProfileMeta.add(new BasicNameValuePair("email", "jane@example.com"));

List <NameValuePair> vProfile = new ArrayList <NameValuePair>();
vProfile.add(new BasicNameValuePair("firstName", "Jane"));
vProfile.add(new BasicNameValuePair("lastName", "Doe"));
vProfile.add(new BasicNameValuePair("meta", vProfileMeta));

// Send HTTP request.
vMethod.setEntity(new UrlEncodedFormEntity(vProfile));
CloseableHttpResponse vResponse = vClient.execute(vMethod);

try {
    // Consume data.
    // ...
}
finally {
    vResponse.close();
}
```

```c
// ...
```

```csharp
class Profile
{
    public string firstName { get; set; }
    public string lastNameName { get; set; }
    public int tagId { get; set; }
}

class ProfileMeta
{
    public double mass { get; set; }
    public string dob { get; set; }
    public string gender { get; set; }
    public string phone { get; set; }
    public string email { get; set; }
    public string medicalHistory { get; set; }
    public string injuries { get; set; }
    public string notes { get; set; }
}

// Build request body.
var vProfileMeta = new ProfileMeta()
{
    height = 1.55,
    mass = 49,
    dob = "1980-01-01 11:00:00",
    gender = "female",
    phone = "+1 555-123-4567",
    email = "jane@example.com"
};

var vProfile = new Profile()
{
    firstName = "Jane",
    lastName = "Doe",
    meta = vProfileMeta
};

// Send HTTP request.
HttpResponseMessage vResponse = await vClient.PostAsJsonAsync("profiles", vProfile);
```

```php
<?php

// Send HTTP request.
$response = $client->post('v1/profiles', [
    'json' => [
        'firstName' => 'Jane',
        'lastName' => 'Doe',
        'meta' => [
            'height' => 1.55,
            'mass' => 49,
            'dob' => '1980-01-01 11:00:00',
            'gender' => 'female',
            'phone' => '+1 555-123-4567',
            'email' => 'jane@example.com',
        ]
    ]
]);
```

> Sample response

```json
{
    "id": ​1,
    "firstName": "Jane",
    "lastName": "Doe",
    "createdAt": "2015-06-01 12:00:00",
    "updatedAt": "2015-06-01 12:00:00",
    "meta": {
        "height": 1.55,
        "mass": 49,
        "dob": "1980-01-01 11:00:00",
        "gender": "female",
        "phone": "+1 555-123-4567",
        "email": "jane@example.com",
        "medicalHistory": "",
        "injuries": "",
        "notes": "",
        "params": {}
    }
}
```

`POST /v1/profiles`

### Body parameters

Parameter | Default | Description
--------- | ------- | -----------
firstName **(required)** | null | Given name.
lastName | null | Family name.
tagId | null | ID of the profile's main tag.
meta | null | [Profile meta data](#profile-meta-object).

### Embeds

See [Profiles &raquo; Embeds](#embeds-for-profiles).
