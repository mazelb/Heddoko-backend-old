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

The authorization code grant is best suited for hosted web apps, or any app that can redirect the user to Heddoko's sign-in page and receive an authorization code through a pre-determined URI. The process can be summarized as:

Redirect user to Heddoko's sign in page » User authenticates using their credentials » User approves sharing data with your app » User is redirected to your app with an authorization code » App exchanges auhorization code with an access token

`GET /oauth2/authorize`



`POST /oauth2/token`
