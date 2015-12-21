# Movements

## List movements

> `GET /api/v1/movements`

```json
{
    "total": 134,
    "offset": 0,
    "limit": 16,
    "results": [
        {
            "id": 1,
            "profileId": 1,
            "submittedBy": 1,
            "screeningId": null,
            "folderId": null,
            "title": "Sample Movement",
            "score": null,
            "scoreMax": null,
            "createdAt": "2015-06-01 12:00:00",
            "updatedAt": "2015-06-01 12:00:00"
        },
        {...}
    ]
}
```

`GET /api/v1/movements`

## Retrieve a movement

<aside class="warning">
In Development.
</aside>

`GET /api/v1/movements/{id}`

## Store movement data

`POST /api/v1/movements`

## Update a movement

<aside class="warning">
In Development.
</aside>

`PUT /api/v1/movements/{id}`

## Delete a movement

<aside class="warning">
In Development.
</aside>

`DELETE /api/v1/movements/{id}`
