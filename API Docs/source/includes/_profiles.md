# Profiles

## List profiles

`GET /api/v1/profile`

## Retrieve a profile

> Sample response

```json
{
    "id": ​1,
    "firstName": "Jane",
    "lastName": "Doe",
    "createdAt": "2015-06-01 12:00:00",
    "updatedAt": "2015-06-01 12:00:00",
    "avatarSrc": "",
    "groups": [
        {
            "id": ​1,
            "name": "Example Team",
            "meta": null,
            "createdAt": "2015-06-01 12:00:00",
            "updatedAt": "2015-06-01 12:00:00",
            "avatarSrc": ""
        }
    ],
    "managers": [
        {
            "id": ​1,
            "email": "manager@example.com",
            "username": "mike.watts",
            "firstName": "Mike",
            "lastName": "Watts",
            "phone": null,
            "country": "",
            "config": null,
            "createdAt": "2015-06-01 12:00:00",
            "updatedAt": "2015-06-01 12:00:00",
            "avatarSrc": ""
        }
    ],
    "screenings": [ ],
    "primaryTag": null,
    "secondaryTags": [ ]
}
```

`GET /api/v1/profile/{id}`

## Create a profile

`POST /api/v1/profile`

## Update a profile

`PUT /api/v1/profile/{id}`

## Upload a profile avatar

`POST /api/v1/profile/{id}/avatar`

## Delete a profile

`DELETE /api/v1/profile/{id}`

## Delete a profile avatar

`DELETE /api/v1/profile/{id}/avatar`
