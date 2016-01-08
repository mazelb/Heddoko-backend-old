---
title: Heddoko API Reference - Draft 1

language_tabs:
  - java: Android
  - c: iOS
  - csharp: C#
  - php: PHP

toc_footers:
  - <a href='#'>Sign-up for a developer key</a>
  - <a href='http://www.heddoko.com/'>www.heddoko.com</a>

includes:
  - intro/overview
  - intro/embeds
  - intro/collections
  - intro/spoofing
  - intro/rate-limiting
  - intro/sample-code
  - authentication

  - folders

  - groups/intro
  - groups/list
  - groups/get
  - groups/post
  - groups/put
  - groups/avatar/post
  - groups/delete
  - groups/avatar/delete

  - movements

  - profiles/intro
  - profiles/list
  - profiles/get
  - profiles/post
  - profiles/put
  - profiles/avatar/post
  - profiles/delete
  - profiles/avatar/delete

  - screenings

  - tags

search: true
---

# Introduction

The Heddoko API follows a [RESTful design](https://en.wikipedia.org/wiki/Representational_state_transfer) and provides programmatic access to profile and movement data. All resources are identified by a [Uniform Resource Identifier](https://en.wikipedia.org/wiki/Uniform_Resource_Identifier) and are accessed or modified through standard HTTP verbs such as `GET`, `POST`, `PUT`, `PATCH` or `DELETE`. Clients and users are authenticated using [OAuth 2.0](http://oauth.net/2/). Responses are available in JSON format.
