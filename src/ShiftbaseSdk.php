<?php

declare(strict_types=1);

namespace OneStopMobile\ShiftbaseSdk;

use DateTimeInterface;
use OneStopMobile\ShiftbaseSdk\Concerns\SendsShiftbaseEndpoints;
use OneStopMobile\ShiftbaseSdk\Http\ShiftbaseConnector;
use Saloon\Enums\Method;
use Saloon\Http\Response;

final readonly class ShiftbaseSdk
{
    use SendsShiftbaseEndpoints;

    public function __construct(
        private ShiftbaseConfig $config,
    ) {}

    public function connector(): ShiftbaseConnector
    {
        return new ShiftbaseConnector($this->config);
    }

    /**
     * @param  array<string, bool|DateTimeInterface|float|int|string>  $pathParameters
     * @param  array<string, mixed>  $query
     * @param  array<array-key, mixed>  $payload
     */
    public function sendEndpoint(
        Method $method,
        string $endpoint,
        array $pathParameters = [],
        array $query = [],
        array $payload = [],
    ): Response {
        return $this->connector()->sendEndpoint(
            method: $method,
            endpoint: $endpoint,
            pathParameters: $pathParameters,
            query: $query,
            payload: $payload,
        );
    }
}
