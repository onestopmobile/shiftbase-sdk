<?php

declare(strict_types=1);

namespace OneStopMobile\ShiftbaseSdk\Http\Requests;

use DateTimeInterface;
use OneStopMobile\ShiftbaseSdk\Http\Requests\Concerns\ResolvesEndpointPath;
use Override;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * @phpstan-type ShiftbasePathParameters array<string, bool|DateTimeInterface|float|int|string>
 * @phpstan-type ShiftbaseQuery array<string, mixed>
 */
final class ShiftbaseEndpointRequest extends Request
{
    use ResolvesEndpointPath;

    private readonly string $resolvedEndpoint;

    /** @var ShiftbaseQuery */
    private readonly array $endpointQuery;

    /**
     * @param  ShiftbasePathParameters  $pathParameters
     * @param  ShiftbaseQuery  $query
     */
    public function __construct(
        Method $method,
        string $endpoint,
        array $pathParameters = [],
        array $query = [],
    ) {
        $this->method = $method;
        $this->resolvedEndpoint = $this->resolvePath($endpoint, $pathParameters);
        $this->endpointQuery = $this->withoutNullValues($query);
    }

    public function resolveEndpoint(): string
    {
        return $this->resolvedEndpoint;
    }

    /**
     * @return ShiftbaseQuery
     */
    #[Override]
    protected function defaultQuery(): array
    {
        return $this->endpointQuery;
    }

    /**
     * @param  ShiftbaseQuery  $query
     * @return ShiftbaseQuery
     */
    private function withoutNullValues(array $query): array
    {
        $filtered = [];

        foreach ($query as $key => $value) {
            if ($value !== null) {
                $filtered[$key] = $value;
            }
        }

        return $filtered;
    }
}
