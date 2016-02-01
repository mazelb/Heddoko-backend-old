## Implicit Grants

<aside class="warning">
In Development.
</aside>

The implicit grant is best suited for apps which cannot securely store their own *app secret*, and thus cannot process authorization codes (e.g. pure JavaScript applications). It is a simplified version of the authorization code grant. The process can be summarized as:

Redirect user to Heddoko's sign in page » User authenticates using their credentials » User approves sharing data with your app » User is redirected to your app with an access token
