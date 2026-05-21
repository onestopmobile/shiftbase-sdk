# One Stop Mobile Shiftbase SDK

A PHP SDK built on [Saloon](https://docs.saloon.dev) for Shiftbase integrations, maintained by One Stop Mobile.

This is not an official Shiftbase package.

## Installation

```bash
composer install
```

## Quick Start

```php
use OneStopMobile\ShiftbaseSdk\Auth\ShiftbaseAuthType;
use OneStopMobile\ShiftbaseSdk\Enums\ShiftbaseApprovalStatus;
use OneStopMobile\ShiftbaseSdk\ShiftbaseConfig;
use OneStopMobile\ShiftbaseSdk\ShiftbaseSdk;

$sdk = new ShiftbaseSdk(new ShiftbaseConfig(
    key: 'your-api-key',
    authorizationType: ShiftbaseAuthType::Api,
));

$connector = $sdk->connector();
```

Shiftbase expects an `Authorization` header formatted as either `API your-api-key` or `USER your-user-token`.

## Planning and Worked Hours

The SDK exposes the planning and worked-hours endpoints from `shiftbase-core.json` as Saloon responses on both the SDK facade and connector.

```php
$approvedTimesheets = $sdk->getTimesheets(
    minDate: '2026-05-01',
    maxDate: '2026-05-31',
    status: ShiftbaseApprovalStatus::Approved,
);

$planningConflicts = $sdk->getPlanningConflicts(
    minDate: '2026-05-01',
    maxDate: '2026-05-31',
);

$clockAction = $sdk->postTimesheetsClock([
    'user_id' => '123',
    'department_id' => '456',
    'time' => '2026-05-21 09:00:00',
]);
```

Implemented groups include users/employees, departments, teams, locations, skills, contracts, absences, availabilities, events, shifts, rosters, open shifts, required shifts, planning, schedule, timesheets, time tracking, kiosks, pins, corrections, overtime, insights, and reports.

## Scripts

```bash
composer format
composer rector
composer lint
composer analyse
composer check
composer test
```
