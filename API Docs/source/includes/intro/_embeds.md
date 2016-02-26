## Embeds

Embeds, sometimes referred to as *expansions*, allow you to include related data to a model in a single request. For the sake of efficiency, and to reduce the load on the API, you can select what related data you'd like to include in a request using the `embed` query parameter and separating each relation by a `,`.

For example, performing a `GET` request to `/v1/profiles` would return a list of profiles, whereas a `GET` request to `/v1/profiles?embed=meta,tags,movements` would include a [meta object]((#profile-meta-object)), an array of [tags](#tags) and an array of [movements](#movements).
