<?php

declare(strict_types=1);

namespace OneStopMobile\ShiftbaseSdk\Http;

use DateTimeInterface;
use OneStopMobile\ShiftbaseSdk\Concerns\SendsShiftbaseEndpoints;
use OneStopMobile\ShiftbaseSdk\Http\Auth\ShiftbaseAuthenticator;
use OneStopMobile\ShiftbaseSdk\Http\Requests\ShiftbaseEndpointRequest;
use OneStopMobile\ShiftbaseSdk\Http\Requests\ShiftbaseJsonEndpointRequest;
use OneStopMobile\ShiftbaseSdk\ShiftbaseConfig;
use Override;
use Saloon\Contracts\Authenticator;
use Saloon\Enums\Method;
use Saloon\Http\Connector;
use Saloon\Http\Response;

final class ShiftbaseConnector extends Connector
{
    use SendsShiftbaseEndpoints;

    #[Override]
    public ?int $tries = 2;

    #[Override]
    public ?bool $throwOnMaxTries = false;

    public function __construct(
        private readonly ShiftbaseConfig $shiftbaseConfig,
    ) {}

    public function resolveBaseUrl(): string
    {
        return mb_rtrim($this->shiftbaseConfig->baseUrl, '/');
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
        $request = $payload === []
            ? new ShiftbaseEndpointRequest($method, $endpoint, $pathParameters, $query)
            : new ShiftbaseJsonEndpointRequest($method, $endpoint, $pathParameters, $query, $payload);

        return $this->send($request);
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'User-Agent' => $this->shiftbaseConfig->userAgent,
        ];
    }

    protected function defaultAuth(): ?Authenticator
    {
        $key = $this->shiftbaseConfig->key;

        if (! is_string($key) || $key === '') {
            return null;
        }

        return new ShiftbaseAuthenticator($this->shiftbaseConfig->authorizationType, $key);
    }
}
