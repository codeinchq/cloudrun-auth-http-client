<?php
/*
 * Copyright 2024 Code Inc. <https://www.codeinc.co>
 *
 * Use of this source code is governed by an MIT-style
 * license that can be found in the LICENSE file or at
 * https://opensource.org/licenses/MIT.
 */

declare(strict_types=1);

namespace CodeInc\CloudrunAuthHttpClient;

use Google\Auth\Credentials\ServiceAccountCredentials;
use Google\Auth\Middleware\AuthTokenMiddleware;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

/**
 * Factory for Cloud Run authenticated HTTP client based on the Google Auth Library for PHP and Guzzle.
 *
 * @see https://github.com/googleapis/google-auth-library-php
 */
final readonly class HttpClientFactory
{
    /**
     * @param array|string $jsonKey
     * @param string $serviceUrl
     * @return Client
     */
    public function factory(array|string $jsonKey, string $serviceUrl): Client
    {
        return new Client([
            'handler' => $this->createHttpClientHandler($jsonKey, $serviceUrl),
            'auth' => 'google_auth',
            'base_uri' => $serviceUrl,
        ]);
    }

    /**
     * @param array|string $jsonKey
     * @param string $serviceUrl
     * @return HandlerStack
     */
    private function createHttpClientHandler(array|string $jsonKey, string $serviceUrl): HandlerStack
    {
        $stack = HandlerStack::create();
        $stack->push($this->createMiddleware($jsonKey, $serviceUrl));
        return $stack;
    }

    /**
     * @param array|string $jsonKey
     * @param string $serviceUrl
     * @return AuthTokenMiddleware
     */
    private function createMiddleware(array|string $jsonKey, string $serviceUrl): AuthTokenMiddleware
    {
        return new AuthTokenMiddleware(
            new ServiceAccountCredentials(
                scope: null,
                jsonKey: $jsonKey,
                targetAudience: $serviceUrl
            )
        );
    }
}
