# GCP CloudRun authenticated HTTP client

A PSR-7 HTTP client based on Guzzle for services hosted on Google Cloud Platform Cloud Run

## Installation

The recommended way to install the library is through [Composer](http://getcomposer.org):

```bash
composer require codeinc/cloudrun-auth-http-client
```

## Usage

```php

use CodeInc\CloudRunAuthHttpClient\HttpClientFactory;

// create a new HttpClientFactory instance
$factory = new HttpClientFactory();

// create the client using a JSON file for the service account key
$httpClient = $factory->factory(
    // Cloud Run service URL
    'https://my-service-12345-uc.a.run.app',
    // path to your service account key 
    '/path/to/your/service-account-key.json' 
);

// create the client using a key stored in memory
$httpClient = $factory->factory(
    // Cloud Run service URL
    'https://my-service-12345-uc.a.run.app',
    // service account key 
    [
        'type' => 'service_account',
        // the rest of the service account key
    ]
);

```
)

$client = new CloudRunAuthHttpClient('https://my-service-12345-uc.a.run.app');
```

## License

The library is published under the MIT license (see [`LICENSE`](LICENSE) file).