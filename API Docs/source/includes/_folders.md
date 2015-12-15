# Folders

Folders help users organize their movement data.

## List folders

> Sample response

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

`GET /api/v1/profile/{profileId}/folder`

<aside class="warning">
In Development.
</aside>

## Retrieve a folder

`GET /api/v1/profile/{profileId}/folder/{id}`

<aside class="warning">
In Development.
</aside>

## Create a folder

`POST /api/v1/profile/{profileId}/folder`

<aside class="warning">
In Development.
</aside>

## Update a folder

`PUT /api/v1/profile/{profileId}/folder/{id}`

<aside class="warning">
In Development.
</aside>

## Delete a folder

`DELETE /api/v1/profile/{profileId}/folder/{id}`

<aside class="warning">
In Development.
</aside>
