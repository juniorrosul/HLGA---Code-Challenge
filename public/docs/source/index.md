---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general
<!-- START_e8df87899e3c464b1ccbf8d0a2412b8f -->
## breeds
> Example request:

```bash
curl -X GET -G "/breeds" 
```
```javascript
const url = new URL("/breeds");

    let params = {
            "name": "sit",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{}
```

### HTTP Request
`GET breeds`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    name |  required  | The breed initial part of name.

<!-- END_e8df87899e3c464b1ccbf8d0a2412b8f -->


