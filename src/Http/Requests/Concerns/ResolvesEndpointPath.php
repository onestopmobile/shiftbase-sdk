<?php

declare(strict_types=1);

namespace OneStopMobile\ShiftbaseSdk\Http\Requests\Concerns;

use DateTimeInterface;
use InvalidArgumentException;

trait ResolvesEndpointPath
{
    /**
     * @param  array<string, bool|DateTimeInterface|float|int|string>  $pathParameters
     */
    private function resolvePath(string $endpoint, array $pathParameters): string
    {
        foreach ($pathParameters as $name => $value) {
            if ($value instanceof DateTimeInterface) {
                $value = $value->format('Y-m-d');
            }

            $endpoint = str_replace('{'.$name.'}', rawurlencode((string) $value), $endpoint);
        }

        if (preg_match('/{[^}]+}/', $endpoint) === 1) {
            throw new InvalidArgumentException('Missing path parameter for endpoint '.$endpoint.'.');
        }

        return $endpoint;
    }
}
