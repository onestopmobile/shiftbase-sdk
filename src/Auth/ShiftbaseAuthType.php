<?php

declare(strict_types=1);

namespace OneStopMobile\ShiftbaseSdk\Auth;

enum ShiftbaseAuthType: string
{
    case Api = 'API';
    case User = 'USER';
}
