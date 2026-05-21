<?php

declare(strict_types=1);

use OneStopMobile\ShiftbaseSdk\Auth\ShiftbaseAuthType;
use OneStopMobile\ShiftbaseSdk\Http\ShiftbaseConnector;
use OneStopMobile\ShiftbaseSdk\ShiftbaseConfig;
use OneStopMobile\ShiftbaseSdk\ShiftbaseSdk;
use Saloon\Http\Faking\MockClient;

function shiftbaseTestConfig(
    ?string $key = 'secret-key',
    ShiftbaseAuthType $authorizationType = ShiftbaseAuthType::Api,
    string $baseUrl = 'https://api.shiftbase.test/api/',
    string $userAgent = 'onestopmobile-shiftbase-sdk/0.1',
): ShiftbaseConfig {
    return new ShiftbaseConfig(
        key: $key,
        authorizationType: $authorizationType,
        baseUrl: $baseUrl,
        userAgent: $userAgent,
    );
}

function shiftbaseTestSdk(
    ?string $key = 'secret-key',
    ShiftbaseAuthType $authorizationType = ShiftbaseAuthType::Api,
    string $baseUrl = 'https://api.shiftbase.test/api/',
    string $userAgent = 'onestopmobile-shiftbase-sdk/0.1',
): ShiftbaseSdk {
    return new ShiftbaseSdk(shiftbaseTestConfig(
        key: $key,
        authorizationType: $authorizationType,
        baseUrl: $baseUrl,
        userAgent: $userAgent,
    ));
}

function shiftbaseTestConnector(
    MockClient $mockClient,
    ?string $key = 'secret-key',
    ShiftbaseAuthType $authorizationType = ShiftbaseAuthType::Api,
    string $baseUrl = 'https://api.shiftbase.test/api/',
    string $userAgent = 'onestopmobile-shiftbase-sdk/0.1',
): ShiftbaseConnector {
    return shiftbaseTestSdk(
        key: $key,
        authorizationType: $authorizationType,
        baseUrl: $baseUrl,
        userAgent: $userAgent,
    )->connector()->withMockClient($mockClient);
}
