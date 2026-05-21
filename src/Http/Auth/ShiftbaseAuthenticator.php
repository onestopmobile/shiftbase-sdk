<?php

declare(strict_types=1);

namespace OneStopMobile\ShiftbaseSdk\Http\Auth;

use OneStopMobile\ShiftbaseSdk\Auth\ShiftbaseAuthType;
use Saloon\Contracts\Authenticator;
use Saloon\Http\PendingRequest;

final readonly class ShiftbaseAuthenticator implements Authenticator
{
    public function __construct(
        private ShiftbaseAuthType $authorizationType,
        private string $key,
    ) {}

    public function set(PendingRequest $pendingRequest): void
    {
        $pendingRequest->headers()->add('Authorization', $this->authorizationType->value.' '.$this->key);
    }
}
