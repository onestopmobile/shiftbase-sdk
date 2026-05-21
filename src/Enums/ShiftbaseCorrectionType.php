<?php

declare(strict_types=1);

namespace OneStopMobile\ShiftbaseSdk\Enums;

enum ShiftbaseCorrectionType: string
{
    case Overtime = 'Overtime';
    case TimeOffBalance = 'Time off balance';
    case Minijob = 'Minijob';
}
