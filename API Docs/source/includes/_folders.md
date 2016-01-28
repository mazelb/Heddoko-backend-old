# Folders

Folders help users organize their movement data.

## List folders

> `GET /api/v1/profiles/{profileId}/folders`

```json
{
    "parent": {

    },
    "folders": [

    ],
    "movements": [
        {
            "id": ​1,
            "profileId": ​1,
            "submittedBy": ​1,
            "screeningId": null,
            "folderId": null,
            "title": "Sample Movement",
            "score": null,
            "scoreMax": null,
            "createdAt": "2016-01-01 11:30:00",
            "updatedAt": "2016-01-01 11:30:00"
        },
        {...}
    ]
}
```

<aside class="warning">
In Development.
</aside>

`GET /api/v1/profiles/{profileId}/folders`

## Retrieve a folder

<aside class="warning">
In Development.
</aside>

`GET /api/v1/profiles/{profileId}/folders/{id}`

## Create a folder

<aside class="warning">
In Development.
</aside>

`POST /api/v1/profiles/{profileId}/folders`

## Update a folder

<aside class="warning">
In Development.
</aside>

`PUT /api/v1/profiles/{profileId}/folders/{id}`

## Delete a folder

<aside class="warning">
In Development.
</aside>

`DELETE /api/v1/profiles/{profileId}/folders/{id}`

or

`DELETE /api/v1/movements/{id1},{id2},{id3}...`
