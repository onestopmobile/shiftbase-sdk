<?php

declare(strict_types=1);

namespace OneStopMobile\ShiftbaseSdk;

use OneStopMobile\ShiftbaseSdk\Auth\ShiftbaseAuthType;

final readonly class ShiftbaseConfig
{
    public function __construct(
        public ?string $key = null,
        public ShiftbaseAuthType $authorizationType = ShiftbaseAuthType::Api,
        public string $baseUrl = 'https://api.shiftbase.com/api',
        public string $userAgent = 'onestopmobile-shiftbase-sdk/0.1',
    ) {}

    public function canAuthenticateRequests(): bool
    {
        return $this->isFilled($this->key);
    }

    public function withUserToken(string $token): self
    {
        return new self(
            key: $token,
            authorizationType: ShiftbaseAuthType::User,
            baseUrl: $this->baseUrl,
            userAgent: $this->userAgent,
        );
    }

    private function isFilled(?string $value): bool
    {
        return $value !== null && $value !== '';
    }
}
