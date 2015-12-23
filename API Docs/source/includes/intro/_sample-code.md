## Sample Code

```java
/**
 * The Java code samples found here will use Apache's HttpComponents library, which
 * is conveniently bundled with Android by default.
 *
 * HttpComponents Docs: http://hc.apache.org/
 */
package com.example.yourapp;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.HttpEntity;
import org.apache.http.NameValuePair;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.CloseableHttpResponse;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.CloseableHttpClient;
import org.apache.http.impl.client.HttpClients;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;

public class SampleClient {

    public String mApiEndpoint = "https://dashboard.heddoko.com/api/v1/";

    public static void main(String[] args) throws Exception {

        // Setup our HTTP client.
        CloseableHttpClient vClient = HttpClients.createDefault();

        // Perform HTTP request on the API.
        try {
            // ...
        }
        finally {
            vClient.close();
        }
    }
}
```

```c
/**
 * The Objective-C code samples found here will use the Unirest HTTP cient.
 *
 * Unirest Docs: http://unirest.io/objective-c.html
 */
```

```csharp
/**
 * HTTP requests in C# can be made through the HttpClient class.
 *
 * Examples can be found here:
 * http://www.asp.net/web-api/overview/advanced/calling-a-web-api-from-a-net-client
 */
using System;
using System.Net.Http;
using System.Net.Http.Headers;
using System.Threading.Tasks;

namespace SampleClient
{
    class Program
    {
        public string mApiEndpoint = "https://dashboard.heddoko.com/api/v1/";

        static void Main()
        {
            RunAsync().Wait();
        }

        static async Task RunAsync()
        {
            using (var vClient = new HttpClient())
            {
                // Setup our client.
                vClient.BaseAddress = new Uri(mApiEndpoint);
                vClient.DefaultRequestHeaders.Accept.Clear();
                vClient.DefaultRequestHeaders.Accept.Add(
                    new MediaTypeWithQualityHeaderValue("application/json")
                );

                // Perform HTTP request on the API.
                // ...
            }
        }
    }
}
```

```php
<?php
/**
 * The PHP code samples found here will use the Guzzle PHP client.
 *
 * Guzzle Docs: https://guzzle.readthedocs.org
 */
use GuzzleHttp\Client;

// Setup our client.
$apiEndpoint = 'https://dashboard.heddoko.com/api/v1/';
$client = new Client([
    'base_uri' => $apiEndpoint
]);

// Perform HTTP request on the API.
// ...
```

Throughout the documentation, sample code is provided in the right sidebar in order to demonstrate some aspects of the API. All endpoints are relative to the API root: `https://dashboard.heddoko.com/api/v1/`.

<aside class="warning">
Sample code is only provided as a guideline. You'll most likely have to adapt it to your own application.
</aside>
