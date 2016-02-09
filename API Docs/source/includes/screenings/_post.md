## Create a screening

> Sample request

```java

```

```c
// ...
```

```csharp

```

```php

```

> Sample response

```json

```

<aside class="warning">
In Development.
</aside>

`POST /v1/screenings`

### Body parameters

Parameter | Default | Description
--------- | ------- | -----------
profileId **required** | null | ID of profile the screening belongs to.
title | "Functional Movement Screening - {DATE}" | Title for the screening.
score | null | Screening score. Can be any integer between [-100, 100].
scoreMax | null | Screening's highest possible score. Can be any integer between [-100, 100].
scoreMin | null | Screening's lowest possible score. Can be any integer between [-100, 100].
notes | null | General notes.
movements | null | Array of [movements](#movements) to add to the screening.

### Embeds

See [Screenings &raquo; Embeds](#embeds-for-screenings).
