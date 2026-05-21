<?php

declare(strict_types=1);

namespace OneStopMobile\ShiftbaseSdk\Enums;

enum ShiftbaseAbsenteeInclude: string
{
    case AbsenteeDay = 'AbsenteeDay';
    case User = 'User';
    case AbsenteeOption = 'AbsenteeOption';
}
