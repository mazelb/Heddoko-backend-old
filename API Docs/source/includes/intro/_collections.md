## Working with Collections

Collections are generally encountered on root endpoints, such as `GET /v1/profiles` or `GET /v1/movements/{movementId}/frames`.

### Sorting

As a rule of thumb, models can be sorted by created date, timestamp or name/title. This is achieved by specifying the `orderBy` query parameter, for example: `GET /v1/profiles?orderBy=createdAt`.

### Filtering

Some collections can be filtered using a search term through the `query` query parameter. For example: `GET /v1/profiles?query=Jane`.

### Field Selection

<aside class="warning">
In Development.
</aside>

Field selection is not yet imlpemented in this draft of the API.

### Paging

<aside class="warning">
In Development.
</aside>

Paging is achieved through the `limit` and `offset` query parameters. For example, `GET /v1/profiles?offset=10&limit=5` would retrieve the 10th, 11th, 12th, 13th and 14th profiles from the API (ordered by the default `createdAt` attribute).
