<?php

declare(strict_types=1);

namespace OneStopMobile\ShiftbaseSdk\Enums;

enum ShiftbaseApprovalStatus: string
{
    case Approved = 'Approved';
    case Declined = 'Declined';
    case Pending = 'Pending';
}
