## Authorization Code Grants

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

// ...
```

> Sample response

```json

```

<aside class="warning">
In Development.
</aside>

The authorization code grant is best suited for hosted web apps, or any app that can redirect the user to Heddoko's sign-in page and receive an authorization code through a pre-determined URI.

**Step 1: Redirect user to Heddoko's sign in page**

`GET /oauth2/authorize`

**Step 2: User authenticates using their credentials**

In this step, the user will enter their credentials on Heddoko's sign in page.

**Step 3: User approves sharing data with your app**

The user will either approve or disapprove sharing their data with your app.

**Step 4: Receive an authorization code**

If the user approves, they will be redirected to a URI specified by your app. The URI will include an authorization code as a query parameter.

**Step 5: Exchange the authorization code for an access token**

`POST /oauth2/token`
