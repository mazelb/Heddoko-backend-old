## Implicit Grants

<aside class="warning">
In Development.
</aside>

The implicit grant is best suited for apps which cannot securely store their own *app secret*, and thus cannot process authorization codes (e.g. pure JavaScript applications). It is a simplified version of the authorization code grant.

**Step 1: Redirect user to Heddoko's sign in page**

`GET /oauth2/authorize`

**Step 2: User authenticates using their credentials**

In this step, the user will enter their credentials on Heddoko's sign in page.

**Step 3: User approves sharing data with your app**

The user will either approve or disapprove sharing their data with your app.

**Step 4: Receive an access token**

If the user approves, they will be redirected to a URI specified by your app. The URI will include the access token as a query parameter.
