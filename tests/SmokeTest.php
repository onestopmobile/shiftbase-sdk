<?php

declare(strict_types=1);

use OneStopMobile\ShiftbaseSdk\Auth\ShiftbaseAuthType;
use OneStopMobile\ShiftbaseSdk\Http\Auth\ShiftbaseAuthenticator;

it('builds a configured Saloon connector', function (): void {
    $sdk = shiftbaseTestSdk(
        userAgent: 'onestopmobile-shiftbase-sdk-test/1.0',
    );

    $connector = $sdk->connector();

    expect($connector->resolveBaseUrl())->toBe('https://api.shiftbase.test/api')
        ->and($connector->headers()->all())->toMatchArray([
            'Accept' => 'application/json',
            'User-Agent' => 'onestopmobile-shiftbase-sdk-test/1.0',
        ])
        ->and($connector->getAuthenticator())->toBeInstanceOf(ShiftbaseAuthenticator::class);
});

it('can be configured with a Shiftbase user token', function (): void {
    $config = shiftbaseTestConfig()->withUserToken('user-token');

    expect($config->key)->toBe('user-token')
        ->and($config->authorizationType)->toBe(ShiftbaseAuthType::User)
        ->and($config->canAuthenticateRequests())->toBeTrue();
});

it('does not attach authentication without a key', function (): void {
    $connector = shiftbaseTestSdk(key: null)->connector();

    expect($connector->getAuthenticator())->toBeNull();
});
