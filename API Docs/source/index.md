---
title: Heddoko API Reference

language_tabs:
  - C#
  - Java
  - Objective-C

toc_footers:
  - <a href='#'>Sign Up for a Developer Key</a>
  - <a href='http://www.heddoko.com/'>www.heddoko.com</a>

includes:
  - profiles
  - movements
  - folders
  - screenings
  - tags
  - groups

search: true
---

# Introduction

The Heddoko API follows a [RESTful design](https://en.wikipedia.org/wiki/Representational_state_transfer). This means that each resource is identified by a Uniform Resource Identifier (or URI) and is manipulated through regular HTTP verbs such as `GET`, `POST`, `PUT`, `PATCH` or `DELETE`.

## Authentication

<aside class="warning">
OAuth2 authentication has not yet been implemented.
</aside>

## Embeds

**Embeds** allow you to include related data to a model in a single request.

<aside class="notice">
TODO: further explain embeds.
</aside>

## Working with Collections

### Sorting
TODO

### Filtering
TODO

### Field Selection
TODO

### Paging
TODO

## Method Spoofing

For clients that don't support the `PUT`, `PATCH` or `DELETE`, these verbs can be simulated with the `X-HTTP-Method-Override` HTTP header.

<aside class="notice">
TODO: further explain X-HTTP-Method-Override.
</aside>

## Rate Limiting

<aside class="notice">
TODO: further explain rate limiting.
</aside>

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
