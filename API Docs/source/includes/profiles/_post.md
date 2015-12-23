## Create a profile

> Sample request

```java
// Create GET method handler.
HttpPost vMethod = new HttpPost(mApiEndpoint + "profiles");

// Build request body.
List <NameValuePair> vProfile = new ArrayList <NameValuePair>();
vProfile.add(new BasicNameValuePair("firstName", "Jane"));
vProfile.add(new BasicNameValuePair("lastName", "Doe"));
vProfile.add(new BasicNameValuePair("height", 1.55));
vProfile.add(new BasicNameValuePair("mass", 49));
vProfile.add(new BasicNameValuePair("dob", "1980-01-01 11:00:00"));
vProfile.add(new BasicNameValuePair("gender", "female"));
vProfile.add(new BasicNameValuePair("phone", "+1 555-123-4567"));
vProfile.add(new BasicNameValuePair("email", "jane@example.com"));
vProfile.add(new BasicNameValuePair("notes", ""));
vMethod.setEntity(new UrlEncodedFormEntity(vProfile));

// Send HTTP request.
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
    public double height { get; set; }
    public double mass { get; set; }
    public string dob { get; set; }
    public string gender { get; set; }
    public string phone { get; set; }
    public string email { get; set; }
    public string notes { get; set; }
}

// Build request body.
var vProfile = new Profile()
{
    firstName = "Jane",
    lastName = "Doe",
    height = 1.55,
    mass = 49,
    dob = "1980-01-01 11:00:00",
    gender = "female",
    phone = "+1 555-123-4567",
    email = "jane@example.com",
    notes = ""
};

// Send HTTP request.
HttpResponseMessage vResponse = await vClient.PostAsJsonAsync("profiles", vProfile);
```

```php
// Send HTTP request.
$response = $client->post('profiles', [
    'json' => [
        'firstName' => 'Jane',
        'lastName' => 'Doe',
        'height' => 1.55,
        'mass' => 49,
        'dob' => '1980-01-01 11:00:00',
        'gender' => 'female',
        'phone' => '+1 555-123-4567',
        'email' => 'jane@example.com',
        'notes' => '',
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
    "mass": 49,
    "dob": "1980-01-01 11:00:00",
    "gender": "female",
    "phone": "+1 555-123-4567",
    "email": "jane@example.com",
    "notes": "",
    "createdAt": "2015-06-01 12:00:00",
    "updatedAt": "2015-06-01 12:00:00",
    "avatarSrc": ""
}
```

`POST /profiles`

### Body Parameters

Parameter | Default | Description
--------- | ------- | -----------
firstName **(required)** | null | Given name.
lastName | null | Family name.
height | null | Height in meters.
mass | null | Mass (weight) in kilograms.
dob | null | Date of birth, in the format '2016-12-31 23:59:59'.
gender | null | Either 'female', 'male', or empty.
phone | null | Phone number
email | null | Email address
notes | null | Other notes.
