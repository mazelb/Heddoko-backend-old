# Profiles

Profiles are a central part of the Heddoko API. They hold information about a person, such as their name, date of birth, and so on. What's more, all screening and movement data is attached to a specific profile.

### Embeds for profiles

Parameter | Description
--------- | ------- | -----------
avatarSrc | A [data URI](https://en.wikipedia.org/wiki/Data_URI_scheme) representing the profile's avatar.
folders | [Folders](#folders) belonging to this profile.
groups | [Groups](#groups) which the profile belongs to.
mainTag | Main [tag](#tags) attached to this profile.
managers | Managers in charge of this profile.

            throw new \Exception('Test')
meta | [Profile meta data](#profile-meta-object).
movements | [Movement data](#movements) belonging to this profile.
screenings | [Screenings](#screenings) belonging to this profile.
tags | Array of secondary [tag](#tags) attached to this profile (title strings only).

### Profile meta object

Parameter | Default | Description
--------- | ------- | -----------
height | null | Height in meters.
mass | null | Mass (weight) in kilograms.
dob | null | Date of birth, in the format `2015-01-01 00:00:00`.
gender | null | Either `female`, `male`, or an empty string.
phone | null | Telephone number.
email | null | Email address.
data | null | Extra meta data.
