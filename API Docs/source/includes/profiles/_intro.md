# Profiles

Profiles are a central part of the Heddoko API. They hold information about a person, such as their name, date of birth, and so on. What's more, all screening and movement data is attached to a specific profile.

### Embeds for profiles

Parameter | Description
--------- | ------- | -----------
avatarSrc | A [data URI](https://en.wikipedia.org/wiki/Data_URI_scheme) representing the profile's avatar.
folders | [Folders](#folders) belonging to this profile.
groups | [Groups](#groups) which the profile belongs to.
managers | Managers in charge of this profile.
meta | [Profile meta data](#profile-meta-object).
movements | [Movement data](#movements) belonging to this profile.
screenings | [Screenings](#screenings) belonging to this profile.
tags | [Tags](#tags) attached to this profile.
