## Obtaining Access Tokens

Access tokens are required to make any authorized call to the API. There are four ways to obtain one, and the best method will depend on your application.

If your application... | Use...
------ | --------------
Redirects the user to Heddoko's sign-in page | an **[authorization code](#authorization-code-grants)** grant
Cannot securely store its *app secret* | an **[implicit](#implicit-grants)** grant
Asks the user for their credentials | a **[resource owner password credentials](#resource-owner-password-credentials-grants)** grant
Uses its own credentials | a **[client credentials](#client-credentials-grants)** grant
