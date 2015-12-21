## Errors

The API uses standard HTTP response codes to communicate errors. The most common ones are listed below.

Error Code | Meaning
---------- | -------
400 | Bad Request -- Usually due to a malformed request.
401 | Unauthorized
403 | Forbidden
404 | Not Found
405 | Method Not Allowed
406 | Not Acceptable -- You requested a format that isn't JSON.
410 | Gone
429 | Too Many Requests
500 | Internal Server Error
503 | Service Unavailable
