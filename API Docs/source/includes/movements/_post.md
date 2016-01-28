## Create a movement

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

`POST /movements`

### Body parameters

Parameter | Default | Description
--------- | ------- | -----------
file **(required)** | null | Data file.
title | null | Title for movement.

### Movement meta object

Parameter | Default | Description
--------- | ------- | -----------
startKeyframe | null | First frame of a trimming.
endKeyframe | null | Last frame of a trimming.
score | null | Score given by a manager.
scoreMax | null | Maximum value of a score.
notes | null | General notes.
virtualPath | null | Virtual classification (used with [folders](#folders))
filename | null | Original filename.
params | null | Movement parameters.

### Embeds

See [Profiles &raquo; Embeds](#embeds-for-profiles).
