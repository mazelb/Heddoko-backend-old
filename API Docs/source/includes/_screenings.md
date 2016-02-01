# Screenings

## List screenings

> `GET screenings?embed=movements`

```json
{
    "total": 5,
    "offset": 0,
    "limit": 20,
    "results": [
        {
            "id": 1,
            "profileId": 1,
            "title": "Sample Test",
            "score": 19,
            "scoreMax": 21,
            "notes": null,
            "createdAt": "2015-06-01 12:00:00",
            "updatedAt": "2015-06-01 12:00:00"
        },
        {
            "id": 2,
            "profileId": 1,
            "title": "Sample Test",
            "score": 14,
            "scoreMax": 21,
            "notes": null,
            "createdAt": "2015-06-01 12:00:00",
            "updatedAt": "2015-06-01 12:00:00"
        },
        {...},
        {...},
        {...}
    ]
}
```

<aside class="success">
Has embeddable properties.
</aside>

`GET /v1/screenings`

Queries the API for screenings against the specified search parameters.

### Query Parameters

Parameter | Default | Description
--------- | ------- | -----------
profileId | null | Narrows the screening to a those belonging to the specified profile.
limit | 20 | Number of profiles to retrieve (max 50).
offset | 0 | Search offset.
orderBy | "createdAt" |
orderDir | "desc" |
query | " " |

### Embeds

Parameter | Description
--------- | -----------
movements |

## Retrieve a screening

> `GET screenings/{id}?embed=movements`

```json
{
    "id": 1,
    "profileId": 1,
    "title": "Sample Test",
    "score": 19,
    "scoreMax": 21,
    "notes": null,
    "createdAt": "2015-06-01 12:00:00",
    "updatedAt": "2015-06-01 12:00:00",
    "movements": [
        {
            "id": 1,
            "profileId": 1,
            "submittedBy": 1,
            "screeningId": 1,
            "folderId": 5,
            "title": "Deep Squat",
            "createdAt": "2015-06-01 12:00:00",
            "updatedAt": "2015-06-01 12:00:00"
        },
        {
            "id": 2,
            "profileId": 1,
            "submittedBy": 1,
            "screeningId": 1,
            "folderId": 5,
            "title": "Hurdle Step - Left",
            "createdAt": "2015-06-01 12:00:00",
            "updatedAt": "2015-06-01 12:00:00"
        },
        {...},
    ]
}
```

<aside class="success">
Has embeddable properties.
</aside>

`GET /v1/screenings/{id}`

## Create a screening

<aside class="warning">
In Development.
</aside>

`POST /v1/screenings`

### Query Parameters

Parameter | Default | Description
--------- | ------- | -----------
profileId **required** | null | ID of profile the screening belongs to.

### Body parameters

Parameter | Default | Description
--------- | ------- | -----------
title | null | Title.
score | null | Score.
scoreMax | null | Maximum score.
notes | null | General notes.

## Update a screening

<aside class="warning">
In Development.
</aside>

`PUT /v1/screenings/{id}`

## Delete a screening

<aside class="warning">
In Development.
</aside>

`DELETE /v1/screenings/{id}`
