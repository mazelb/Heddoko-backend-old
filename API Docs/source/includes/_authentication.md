# Authentication

The Heddoko API uses [OAuth 2.0](http://oauth.net/2/) to handle authorization flows.

## Obtaining Access Tokens

Access tokens are required to make any authorized call to the API. There are four ways to obtain one, and the best method will depend on your application.

If your application... | Use...
------ | --------------
Redirects the user to Heddoko's sign-in page | an **[authorization code](#authorization-code-grants)** grant
Cannot securely store its *app secret* | an **[implicit](#implicit-grants)** grant
Asks the user for their credentials | a **[resource owner password credentials](#resource-owner-password-credentials-grants)** grant
Uses its own credentials | a **[client credentials](#client-credentials-grants)** grant

## Authorization Code Grants

<aside class="warning">
In Development.
</aside>

The authorization code grant is best suited for hosted web apps, or any app that can redirect the user to Heddoko's sign-in page and receive an authorization code through a pre-determined URI. The process can be summarized as:

Redirect user to Heddoko's sign in page » User authenticates using their credentials » User approves sharing data with your app » User is redirected to your app with an authorization code » App exchanges auhorization code with an access token

`GET /oauth/authorize`



`POST /oauth/token`


## Implicit Grants

<aside class="warning">
In Development.
</aside>

The implicit grant is best suited for apps which cannot securely store their own *app secret*, and thus cannot process authorization codes (e.g. pure JavaScript applications). It is a simplified version of the authorization code grant. The process can be summarized as:

Redirect user to Heddoko's sign in page » User authenticates using their credentials » User approves sharing data with your app » User is redirected to your app with an access token

## Resource Owner Password Credentials Grants

<aside class="warning">
In Development.
</aside>

The resource owner password credentials grant is best suited for Android & iOS apps, or any app that cannot redirect the user to Heddoko's sign-in page and receive an authorization code through a pre-determined URI. The process can be summarized as:

Collect username & password from user » Send user credentials to the API, along with app's own ID & secret » App receives access token

`GET /oauth/token`

## Client Credentials Grants

<aside class="warning">
In Development.
</aside>

The client credentials grant is best suited for apps which only need limited, non-user specific access to the API. Instead of having the user authenticate themselves in order to receive an access token, the app uses its own ID & secret. The process can be summarized as:

App sends its own credentials to the API » App receives an access token

## Refreshing Access Tokens

<aside class="warning">
In Development.
</aside>
