# Movements

## List movements

> Sample response

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

`GET /api/v1/movements/{id}`

<aside class="warning">
In Development.
</aside>

## Store movement data

`POST /api/v1/movements`

## Update a movement

`PUT /api/v1/movements/{id}`

<aside class="warning">
In Development.
</aside>

## Delete a movement

`DELETE /api/v1/movements/{id}`

<aside class="warning">
In Development.
</aside>
