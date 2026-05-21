<?php

declare(strict_types=1);

use OneStopMobile\ShiftbaseSdk\Enums\ShiftbaseApprovalStatus;
use OneStopMobile\ShiftbaseSdk\Enums\ShiftbaseReportFormat;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Response;

it('lists approved timesheets with date filters', function (): void {
    $mockClient = new MockClient([
        MockResponse::make(['data' => []]),
    ]);

    $response = shiftbaseTestConnector($mockClient)->getTimesheets(
        minDate: new DateTimeImmutable('2026-05-01'),
        maxDate: new DateTimeImmutable('2026-05-31'),
        status: ShiftbaseApprovalStatus::Approved,
        departmentId: null,
    );

    expect($response)->toBeInstanceOf(Response::class)
        ->and($response->getPsrRequest()->getMethod())->toBe('GET')
        ->and($response->getPsrRequest()->getHeaderLine('Authorization'))->toBe('API secret-key')
        ->and($response->getPsrRequest()->getUri()->getPath())->toBe('/api/timesheets');

    parse_str($response->getPsrRequest()->getUri()->getQuery(), $query);

    expect($query)->toMatchArray([
        'min_date' => '2026-05-01',
        'max_date' => '2026-05-31',
        'status' => 'Approved',
    ])->not->toHaveKey('department_id');
});

it('clocks time with a json payload', function (): void {
    $mockClient = new MockClient([
        MockResponse::make(['data' => ['Timesheet' => ['id' => '123']]]),
    ]);

    $response = shiftbaseTestConnector($mockClient)->postTimesheetsClock([
        'user_id' => '42',
        'department_id' => '7',
        'time' => '2026-05-21 09:00:00',
    ]);

    expect($response->getPsrRequest()->getMethod())->toBe('POST')
        ->and($response->getPsrRequest()->getUri()->getPath())->toBe('/api/timesheets/clock')
        ->and($response->getPsrRequest()->getHeaderLine('Content-Type'))->toBe('application/json')
        ->and((string) $response->getPsrRequest()->getBody())->json()->toMatchArray([
            'user_id' => '42',
            'department_id' => '7',
            'time' => '2026-05-21 09:00:00',
        ]);
});

it('resolves path parameters for planning endpoints', function (): void {
    $mockClient = new MockClient([
        MockResponse::make(['data' => []]),
    ]);

    $response = shiftbaseTestConnector($mockClient)->putOpenShiftsOccurrenceIdAssign(
        occurrenceId: 'shift/2026-05-21',
        payload: ['user_id' => '42'],
    );

    expect($response->getPsrRequest()->getMethod())->toBe('PUT')
        ->and($response->getPsrRequest()->getUri()->getPath())->toBe('/api/open_shifts/shift%2F2026-05-21/assign');
});

it('exposes the same planning and hour endpoints through the sdk facade', function (): void {
    $mockClient = MockClient::global([
        MockResponse::make(['data' => []]),
    ]);

    try {
        $response = shiftbaseTestSdk()->getPlanningConflicts(
            minDate: '2026-05-21',
            maxDate: '2026-05-28',
        );
    } finally {
        MockClient::destroyGlobal();
    }

    expect($response->getPsrRequest()->getMethod())->toBe('GET')
        ->and($response->getPsrRequest()->getUri()->getPath())->toBe('/api/planning/conflicts');

    $mockClient->assertSentCount(1);
});

it('serializes typed report format query values', function (): void {
    $mockClient = new MockClient([
        MockResponse::make('report-content'),
    ]);

    $response = shiftbaseTestConnector($mockClient)->getReportsReportIdFetch(
        reportId: 'report-123',
        format: ShiftbaseReportFormat::Xlsx,
    );

    parse_str($response->getPsrRequest()->getUri()->getQuery(), $query);

    expect($response->getPsrRequest()->getUri()->getPath())->toBe('/api/reports/report-123/fetch')
        ->and($query)->toMatchArray([
            'format' => 'xlsx',
        ]);
});
