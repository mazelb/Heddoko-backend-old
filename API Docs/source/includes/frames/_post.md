## Create a movement frame

> Sample request

```java

```

```c
// ...
```

```csharp
// ...
```

```php
<?php

// ...
```

> Sample response

```json

```

<aside class="warning">
In Development.
</aside>

`POST /v1/movements/{movemntId}/frames`

### Body parameters for new movement frames

Parameter | Default | Description
--------- | ------- | -----------
formatRevision | null | String representing the format of the data associated with this frame.
timestamp | null | Integer representing a time value.
rawData | null | String representing the raw data from the device.
instantaneousData | null | Object representing information extracted from the raw data.

### Embeds

See [Movement frames &raquo; Embeds](#embeds-for-movement-frames).
