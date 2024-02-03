# GCP Cloud Run authenticated HTTP client for PHP

The PHP 8.2+ library is a [PSR-7](https://www.php-fig.org/psr/psr-7/) HTTP client based on [Guzzle](https://github.com/guzzle/guzzle) and the [official Google Auth PHP package](https://packagist.org/packages/google/auth) for services hosted on [Google Cloud Platform Cloud Run](https://cloud.google.com/run?hl=en).

## Installation

The recommended way to install the library is through [Composer](http://getcomposer.org):

```bash
composer require codeinc/cloudrun-auth-http-client
```

## Usage

A GCP service account is required to authenticate the requests sent to a Cloud Run service. If you do not already have a service account, follow instructions on [this page](https://cloud.google.com/iam/docs/service-accounts-create) in order to create one.

Before using the library the service account must be authenticated to send requests to the Cloud Run service following [these steps](https://cloud.google.com/run/docs/authenticating/service-to-service#set-up-sa).

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

// create the client using a key stored in a environment variable
$httpClient = $factory->factory(
    // Cloud Run service URL
    'https://my-service-12345-uc.a.run.app',
    // service account key 
    json_decode(getenv('SERVICE_ACCOUNT_KEY'), true)
);
```

## License

The library is published under the MIT license (see [`LICENSE`](LICENSE) file).