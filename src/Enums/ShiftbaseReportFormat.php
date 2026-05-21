<?php

declare(strict_types=1);

namespace OneStopMobile\ShiftbaseSdk\Enums;

enum ShiftbaseReportFormat: string
{
    case Html = 'html';
    case Csv = 'csv';
    case Xlsx = 'xlsx';
    case Json = 'json';
}
