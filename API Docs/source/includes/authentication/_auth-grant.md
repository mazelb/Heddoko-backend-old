## Authorization Code Grants

> Redirect user to Heddoko’s sign in page

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

$clientId = 'abc';
header("Location: {$apiEndpoint}/oauth2/authorize?client_id={$clientId}&response_type=code&return_uri=...");
exit();
```

> Sample response

```json

```

The authorization code grant is best suited for hosted web apps, or any app that can redirect the user to Heddoko's sign-in page and receive an authorization code through a pre-determined URI.

**Step 1: Redirect user to Heddoko's sign in page**

`GET /oauth2/authorize`

Send the user to Heddoko's sign in page, and include the following query parameters:

Parameter | Description
--------- | ------- | -----------
client_id | API client ID
redirect_uri | URI to redirect to
response_type | Response type

**Step 2: User authenticates using their credentials**

In this step, the user will enter their credentials on Heddoko's sign in page.

**Step 3: User approves sharing data with your app**

The user will either approve or disapprove sharing their data with your app.

**Step 4: Receive an authorization code**

If the user approves, they will be redirected to a URI specified by your app. The URI will include an authorization code as a query parameter.

**Step 5: Exchange the authorization code for an access token**

`POST /oauth2/token`

Once your app has received an authorization code, it may exchange it for an access token usign the following parameters:

Parameter | Description
--------- | ------- | -----------
client_id | API client ID
client_secret | API client secret
grant_type | Grant type
code | Authorization code
redirect_uri | URI to redirect to
