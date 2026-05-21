<?php

declare(strict_types=1);

namespace OneStopMobile\ShiftbaseSdk\Concerns;

use BackedEnum;
use DateTimeInterface;
use OneStopMobile\ShiftbaseSdk\Enums\ShiftbaseAbsenteeInclude;
use OneStopMobile\ShiftbaseSdk\Enums\ShiftbaseApprovalStatus;
use OneStopMobile\ShiftbaseSdk\Enums\ShiftbaseCorrectionType;
use OneStopMobile\ShiftbaseSdk\Enums\ShiftbaseReportFormat;
use Saloon\Enums\Method;
use Saloon\Http\Response;

/**
 * @phpstan-type ShiftbasePathParameters array<string, bool|DateTimeInterface|float|int|string>
 * @phpstan-type ShiftbasePayload array<array-key, mixed>
 * @phpstan-type ShiftbaseQuery array<string, mixed>
 */
trait SendsShiftbaseEndpoints
{
    /**
     * @param  ShiftbasePathParameters  $pathParameters
     * @param  ShiftbaseQuery  $query
     * @param  ShiftbasePayload  $payload
     */
    abstract public function sendEndpoint(
        Method $method,
        string $endpoint,
        array $pathParameters = [],
        array $query = [],
        array $payload = [],
    ): Response;

    // AbsencePolicy

    /**
     * List absence policies
     */
    public function getAbsencePolicies(): Response
    {
        return $this->sendEndpoint(Method::GET, '/absence/policies');
    }

    /**
     * Delete absence policy
     */
    public function deleteAbsencePoliciesPolicyId(string|int $policyId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/absence/policies/{policyId}', pathParameters: ['policyId' => $policyId]);
    }

    /**
     * Get absence policy
     */
    public function getAbsencePoliciesPolicyId(string|int $policyId): Response
    {
        return $this->sendEndpoint(Method::GET, '/absence/policies/{policyId}', pathParameters: ['policyId' => $policyId]);
    }

    /**
     * Delete absence type
     */
    public function deleteAbsenteeOptionsAbsenceTypeId(string|int $absenceTypeId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/absentee_options/{absenceTypeId}', pathParameters: ['absenceTypeId' => $absenceTypeId]);
    }

    // AbsenceRestriction

    /**
     * List absence restrictions
     */
    public function getAbsenceRestrictions(): Response
    {
        return $this->sendEndpoint(Method::GET, '/absence/restrictions');
    }

    /**
     * Create absence restriction
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postAbsenceRestrictions(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/absence/restrictions', payload: $payload);
    }

    /**
     * Delete absence restriction
     */
    public function deleteAbsenceRestrictionsAbsenceRestrictionId(string|int $absenceRestrictionId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/absence/restrictions/{absenceRestrictionId}', pathParameters: ['absenceRestrictionId' => $absenceRestrictionId]);
    }

    /**
     * Get absence restriction
     */
    public function getAbsenceRestrictionsAbsenceRestrictionId(string|int $absenceRestrictionId): Response
    {
        return $this->sendEndpoint(Method::GET, '/absence/restrictions/{absenceRestrictionId}', pathParameters: ['absenceRestrictionId' => $absenceRestrictionId]);
    }

    /**
     * Edit absence restriction
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putAbsenceRestrictionsAbsenceRestrictionId(string|int $absenceRestrictionId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/absence/restrictions/{absenceRestrictionId}', pathParameters: ['absenceRestrictionId' => $absenceRestrictionId], payload: $payload);
    }

    /**
     * Add multiple absence restrictions
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postAbsenceRestrictionsBatch(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/absence/restrictions/batch', payload: $payload);
    }

    // AbsenceType

    /**
     * List absence types
     */
    public function getAbsenteeOptions(): Response
    {
        return $this->sendEndpoint(Method::GET, '/absentee_options');
    }

    /**
     * Add Absence type
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postAbsenteeOptions(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/absentee_options', payload: $payload);
    }

    /**
     * Get absence type
     */
    public function getAbsenteeOptionsAbsenceTypeId(string|int $absenceTypeId): Response
    {
        return $this->sendEndpoint(Method::GET, '/absentee_options/{absenceTypeId}', pathParameters: ['absenceTypeId' => $absenceTypeId]);
    }

    /**
     * Edit absence type
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putAbsenteeOptionsAbsenceTypeId(string|int $absenceTypeId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/absentee_options/{absenceTypeId}', pathParameters: ['absenceTypeId' => $absenceTypeId], payload: $payload);
    }

    // Absentees

    /**
     * List absentees
     */
    public function getAbsentees(ShiftbaseAbsenteeInclude|string|null $include = null, string|int|null $userId = null, DateTimeInterface|string|null $minDate = null, DateTimeInterface|string|null $maxDate = null, ShiftbaseApprovalStatus|string|null $status = null, bool|string|null $onlyOpenEnded = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/absentees', query: $this->shiftbaseQuery(['include' => $include, 'user_id' => $userId, 'min_date' => $this->shiftbaseDateQueryValue($minDate, 'date'), 'max_date' => $this->shiftbaseDateQueryValue($maxDate, 'date'), 'status' => $status, 'only_open_ended' => $onlyOpenEnded]));
    }

    /**
     * Add absentee
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postAbsentees(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/absentees', payload: $payload);
    }

    /**
     * Delete absentee
     */
    public function deleteAbsenteesAbsenteeId(string|int $absenteeId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/absentees/{absenteeId}', pathParameters: ['absenteeId' => $absenteeId]);
    }

    /**
     * Get absentee
     */
    public function getAbsenteesAbsenteeId(string|int $absenteeId, bool|string|null $allowDeleted = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/absentees/{absenteeId}', pathParameters: ['absenteeId' => $absenteeId], query: $this->shiftbaseQuery(['allow_deleted' => $allowDeleted]));
    }

    /**
     * Edit absentee
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putAbsenteesAbsenteeId(string|int $absenteeId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/absentees/{absenteeId}', pathParameters: ['absenteeId' => $absenteeId], payload: $payload);
    }

    /**
     * Mark absentees as returned
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putAbsenteesAbsenteeIdReturn(string|int $absenteeId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/absentees/{absenteeId}/return', pathParameters: ['absenteeId' => $absenteeId], payload: $payload);
    }

    /**
     * Get absentee review
     */
    public function getAbsenteesIdReview(string|int $id, DateTimeInterface|string|null $endDate = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/absentees/{id}/review', pathParameters: ['id' => $id], query: $this->shiftbaseQuery(['endDate' => $this->shiftbaseDateQueryValue($endDate, 'date')]));
    }

    /**
     * Bulk add absentees
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postAbsenteesBulk(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/absentees/bulk', payload: $payload);
    }

    /**
     * Get expected absence values
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postAbsenteesExpected(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/absentees/expected', payload: $payload);
    }

    /**
     * Get bulk absence info
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postAbsenteesInfo(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/absentees/info', payload: $payload);
    }

    // Availabilities

    /**
     * List availabilities
     */
    public function getAvailabilitiesId(string|int $id, DateTimeInterface|string|null $minDate = null, DateTimeInterface|string|null $maxDate = null, string|int|null $userId = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/availabilities/{id}', pathParameters: ['id' => $id], query: $this->shiftbaseQuery(['min_date' => $this->shiftbaseDateQueryValue($minDate, 'date'), 'max_date' => $this->shiftbaseDateQueryValue($maxDate, 'date'), 'user_id' => $userId]));
    }

    /**
     * Add availabilities
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postAvailabilitiesId(string|int $id, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/availabilities/{id}', pathParameters: ['id' => $id], payload: $payload);
    }

    /**
     * Edit availability
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putAvailabilitiesId(string|int $id, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/availabilities/{id}', pathParameters: ['id' => $id], payload: $payload);
    }

    /**
     * Get first editable availability date
     */
    public function getAvailabilitiesEditableUserId(string|int $userId): Response
    {
        return $this->sendEndpoint(Method::GET, '/availabilities/editable/{userId}', pathParameters: ['userId' => $userId]);
    }

    /**
     * Get availability rules
     */
    public function getEmployeesEmployeeIdAvailabilitiesRules(string|int $employeeId): Response
    {
        return $this->sendEndpoint(Method::GET, '/employees/{employeeId}/availabilities/rules', pathParameters: ['employeeId' => $employeeId]);
    }

    // Corrections

    /**
     * List plus min hours balances on date for users
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postBalanceOvertimeDate(DateTimeInterface|string $date, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/balance/Overtime/{date}', pathParameters: ['date' => $date], payload: $payload);
    }

    /**
     * List corrections
     */
    public function getCorrections(DateTimeInterface|string|null $minDate = null, DateTimeInterface|string|null $maxDate = null, string|int|null $userId = null, ShiftbaseCorrectionType|string|null $type = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/corrections', query: $this->shiftbaseQuery(['min_date' => $this->shiftbaseDateQueryValue($minDate, 'date'), 'max_date' => $this->shiftbaseDateQueryValue($maxDate, 'date'), 'user_id' => $userId, 'type' => $type]));
    }

    /**
     * Add correction
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postCorrections(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/corrections', payload: $payload);
    }

    /**
     * Delete a correction
     */
    public function deleteCorrectionsCorrectionId(string|int $correctionId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/corrections/{correctionId}', pathParameters: ['correctionId' => $correctionId]);
    }

    /**
     * Get a correction
     */
    public function getCorrectionsCorrectionId(string|int $correctionId): Response
    {
        return $this->sendEndpoint(Method::GET, '/corrections/{correctionId}', pathParameters: ['correctionId' => $correctionId]);
    }

    /**
     * Batch correction
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postCorrectionsBatch(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/corrections/batch', payload: $payload);
    }

    // TimeTracking

    /**
     * List clock ips
     */
    public function getClockIps(): Response
    {
        return $this->sendEndpoint(Method::GET, '/clock_ips');
    }

    /**
     * Add clock ip
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postClockIps(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/clock_ips', payload: $payload);
    }

    /**
     * Delete clock ip
     */
    public function deleteClockIpsClockIpId(string|int $clockIpId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/clock_ips/{clockIpId}', pathParameters: ['clockIpId' => $clockIpId]);
    }

    /**
     * Get clock ip
     */
    public function getClockIpsClockIpId(string|int $clockIpId): Response
    {
        return $this->sendEndpoint(Method::GET, '/clock_ips/{clockIpId}', pathParameters: ['clockIpId' => $clockIpId]);
    }

    /**
     * Edit clock ip
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putClockIpsClockIpId(string|int $clockIpId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/clock_ips/{clockIpId}', pathParameters: ['clockIpId' => $clockIpId], payload: $payload);
    }

    /**
     * List clock locations
     */
    public function getClockLocations(): Response
    {
        return $this->sendEndpoint(Method::GET, '/clock_locations');
    }

    /**
     * Add clock location
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postClockLocations(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/clock_locations', payload: $payload);
    }

    /**
     * Delete clock location
     */
    public function deleteClockLocationsClockLocationId(string|int $clockLocationId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/clock_locations/{clockLocationId}', pathParameters: ['clockLocationId' => $clockLocationId]);
    }

    /**
     * Get clock location
     */
    public function getClockLocationsClockLocationId(string|int $clockLocationId): Response
    {
        return $this->sendEndpoint(Method::GET, '/clock_locations/{clockLocationId}', pathParameters: ['clockLocationId' => $clockLocationId]);
    }

    /**
     * Edit clock location
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putClockLocationsClockLocationId(string|int $clockLocationId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/clock_locations/{clockLocationId}', pathParameters: ['clockLocationId' => $clockLocationId], payload: $payload);
    }

    /**
     * Process batch of clock locations
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postClockLocationsBatch(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/clock_locations/batch', payload: $payload);
    }

    /**
     * Clock authorization check
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postTimetrackingClockAuthorize(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/timetracking/clock/authorize', payload: $payload);
    }

    // ContractTypes

    /**
     * List contract types
     */
    public function getContractTypes(): Response
    {
        return $this->sendEndpoint(Method::GET, '/contract_types');
    }

    /**
     * Add contract type
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postContractTypes(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/contract_types', payload: $payload);
    }

    /**
     * Delete contract type
     */
    public function deleteContractTypesContractTypeId(string|int $contractTypeId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/contract_types/{contractTypeId}', pathParameters: ['contractTypeId' => $contractTypeId]);
    }

    /**
     * Get contract type
     */
    public function getContractTypesContractTypeId(string|int $contractTypeId): Response
    {
        return $this->sendEndpoint(Method::GET, '/contract_types/{contractTypeId}', pathParameters: ['contractTypeId' => $contractTypeId]);
    }

    /**
     * Edit contract type
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putContractTypesContractTypeId(string|int $contractTypeId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/contract_types/{contractTypeId}', pathParameters: ['contractTypeId' => $contractTypeId], payload: $payload);
    }

    /**
     * Activate contract type
     */
    public function postContractTypesContractTypeIdActivate(string|int $contractTypeId): Response
    {
        return $this->sendEndpoint(Method::POST, '/contract_types/{contractTypeId}/activate', pathParameters: ['contractTypeId' => $contractTypeId]);
    }

    // Contracts

    /**
     * List contracts
     */
    public function getContracts(DateTimeInterface|string|null $minDate = null, DateTimeInterface|string|null $maxDate = null, string|int|null $userId = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/contracts', query: $this->shiftbaseQuery(['min_date' => $this->shiftbaseDateQueryValue($minDate, 'date'), 'max_date' => $this->shiftbaseDateQueryValue($maxDate, 'date'), 'user_id' => $userId]));
    }

    /**
     * Add Contract
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postContracts(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/contracts', payload: $payload);
    }

    /**
     * Delete contract
     */
    public function deleteContractsContractId(string|int $contractId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/contracts/{contractId}', pathParameters: ['contractId' => $contractId]);
    }

    /**
     * Get contract
     */
    public function getContractsContractId(string|int $contractId): Response
    {
        return $this->sendEndpoint(Method::GET, '/contracts/{contractId}', pathParameters: ['contractId' => $contractId]);
    }

    /**
     * Edit contract
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putContractsContractId(string|int $contractId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/contracts/{contractId}', pathParameters: ['contractId' => $contractId], payload: $payload);
    }

    /**
     * List average daily hours
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postContractsAverageDailyHours(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/contracts/average_daily_hours', payload: $payload);
    }

    /**
     * Bulk change contract property
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postContractsBulk(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/contracts/bulk', payload: $payload);
    }

    /**
     * Bulk change wages
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postContractsWages(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/contracts/wages', payload: $payload);
    }

    // CustomFields

    /**
     * List custom fields
     */
    public function getCustomFields(): Response
    {
        return $this->sendEndpoint(Method::GET, '/custom_fields');
    }

    /**
     * Create custom field
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postCustomFields(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/custom_fields', payload: $payload);
    }

    /**
     * Delete custom field
     */
    public function deleteCustomFieldsCustomFieldId(string|int $customFieldId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/custom_fields/{customFieldId}', pathParameters: ['customFieldId' => $customFieldId]);
    }

    /**
     * Get custom field
     */
    public function getCustomFieldsCustomFieldId(string|int $customFieldId): Response
    {
        return $this->sendEndpoint(Method::GET, '/custom_fields/{customFieldId}', pathParameters: ['customFieldId' => $customFieldId]);
    }

    /**
     * Edit custom field
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putCustomFieldsCustomFieldId(string|int $customFieldId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/custom_fields/{customFieldId}', pathParameters: ['customFieldId' => $customFieldId], payload: $payload);
    }

    /**
     * Process batch of custom fields
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postCustomFieldsBatch(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/custom_fields/batch', payload: $payload);
    }

    // Departments

    /**
     * List departments
     */
    public function getDepartments(): Response
    {
        return $this->sendEndpoint(Method::GET, '/departments');
    }

    /**
     * Create department
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postDepartments(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/departments', payload: $payload);
    }

    /**
     * Delete department
     */
    public function deleteDepartmentsDepartmentId(string|int $departmentId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/departments/{departmentId}', pathParameters: ['departmentId' => $departmentId]);
    }

    /**
     * Get department
     */
    public function getDepartmentsDepartmentId(string|int $departmentId): Response
    {
        return $this->sendEndpoint(Method::GET, '/departments/{departmentId}', pathParameters: ['departmentId' => $departmentId]);
    }

    /**
     * Edit department
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putDepartmentsDepartmentId(string|int $departmentId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/departments/{departmentId}', pathParameters: ['departmentId' => $departmentId], payload: $payload);
    }

    /**
     * Activate deleted department
     */
    public function putDepartmentsDepartmentIdActivate(string|int $departmentId): Response
    {
        return $this->sendEndpoint(Method::PUT, '/departments/{departmentId}/activate', pathParameters: ['departmentId' => $departmentId]);
    }

    /**
     * Validate delete department
     */
    public function deleteDepartmentsDepartmentIdValidate(string|int $departmentId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/departments/{departmentId}/validate', pathParameters: ['departmentId' => $departmentId]);
    }

    // DepartmentSettings

    /**
     * Delete department variation for section
     */
    public function deleteDepartmentsDepartmentIdSettingsSection(string|int $departmentId, string $section): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/departments/{departmentId}/settings/{section}', pathParameters: ['departmentId' => $departmentId, 'section' => $section]);
    }

    /**
     * View department settings
     */
    public function getDepartmentsDepartmentIdSettingsSection(string|int $departmentId, string $section): Response
    {
        return $this->sendEndpoint(Method::GET, '/departments/{departmentId}/settings/{section}', pathParameters: ['departmentId' => $departmentId, 'section' => $section]);
    }

    /**
     * Edit department settings
     */
    public function putDepartmentsDepartmentIdSettingsSection(string|int $departmentId, string $section): Response
    {
        return $this->sendEndpoint(Method::PUT, '/departments/{departmentId}/settings/{section}', pathParameters: ['departmentId' => $departmentId, 'section' => $section]);
    }

    /**
     * Edit timesheet clocking department settings
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putDepartmentsDepartmentIdSettingsBreaks(string|int $departmentId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/departments/{departmentId}/settings/breaks', pathParameters: ['departmentId' => $departmentId], payload: $payload);
    }

    /**
     * Edit notifications employees department settings
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putDepartmentsDepartmentIdSettingsNotificationsEmployees(string|int $departmentId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/departments/{departmentId}/settings/notifications_employees', pathParameters: ['departmentId' => $departmentId], payload: $payload);
    }

    /**
     * Edit notifications insights department settings
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putDepartmentsDepartmentIdSettingsNotificationsInsights(string|int $departmentId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/departments/{departmentId}/settings/notifications_insights', pathParameters: ['departmentId' => $departmentId], payload: $payload);
    }

    /**
     * Edit notifications schedule department settings
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putDepartmentsDepartmentIdSettingsNotificationsSchedule(string|int $departmentId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/departments/{departmentId}/settings/notifications_schedule', pathParameters: ['departmentId' => $departmentId], payload: $payload);
    }

    /**
     * Edit notifications timetracking department settings
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putDepartmentsDepartmentIdSettingsNotificationsTimetracking(string|int $departmentId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/departments/{departmentId}/settings/notifications_timetracking', pathParameters: ['departmentId' => $departmentId], payload: $payload);
    }

    /**
     * Edit schedule availability department settings
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putDepartmentsDepartmentIdSettingsScheduleAvailability(string|int $departmentId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/departments/{departmentId}/settings/schedule_availability', pathParameters: ['departmentId' => $departmentId], payload: $payload);
    }

    /**
     * Edit schedule department settings
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putDepartmentsDepartmentIdSettingsScheduleDepartments(string|int $departmentId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/departments/{departmentId}/settings/schedule_departments', pathParameters: ['departmentId' => $departmentId], payload: $payload);
    }

    /**
     * Edit timesheet department settings
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putDepartmentsDepartmentIdSettingsTimesheet(string|int $departmentId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/departments/{departmentId}/settings/timesheet', pathParameters: ['departmentId' => $departmentId], payload: $payload);
    }

    /**
     * Edit timesheet clocking department settings
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putDepartmentsDepartmentIdSettingsTimesheetClocking(string|int $departmentId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/departments/{departmentId}/settings/timesheet_clocking', pathParameters: ['departmentId' => $departmentId], payload: $payload);
    }

    /**
     * List department section settings
     */
    public function getDepartmentsSettingsSection(string $section): Response
    {
        return $this->sendEndpoint(Method::GET, '/departments/settings/{section}', pathParameters: ['section' => $section]);
    }

    // DepartmentTarget

    /**
     * List department targets
     */
    public function getDepartmentsDepartmentIdTarget(string|int $departmentId): Response
    {
        return $this->sendEndpoint(Method::GET, '/departments/{departmentId}/target', pathParameters: ['departmentId' => $departmentId]);
    }

    /**
     * Define department target setting
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putDepartmentsDepartmentIdTarget(string|int $departmentId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/departments/{departmentId}/target', pathParameters: ['departmentId' => $departmentId], payload: $payload);
    }

    /**
     * List department targets
     */
    public function getDepartmentsTarget(DateTimeInterface|string|null $startDate = null, DateTimeInterface|string|null $endDate = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/departments/target', query: $this->shiftbaseQuery(['start_date' => $this->shiftbaseDateQueryValue($startDate, 'date'), 'end_date' => $this->shiftbaseDateQueryValue($endDate, 'date')]));
    }

    /**
     * Set department target setting
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putDepartmentsTarget(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/departments/target', payload: $payload);
    }

    // Minijob

    /**
     * List employee Minijob overview for year
     */
    public function getEmployeesEmployeeIdMinijobOverviewYear(string|int $employeeId, int|string $year): Response
    {
        return $this->sendEndpoint(Method::GET, '/employees/{employeeId}/minijob/overview/{year}', pathParameters: ['employeeId' => $employeeId, 'year' => $year]);
    }

    // Employees

    /**
     * Change teams of employee
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putEmployeesEmployeeIdTeams(string|int $employeeId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/employees/{employeeId}/teams', pathParameters: ['employeeId' => $employeeId], payload: $payload);
    }

    /**
     * List employee time distribution
     */
    public function getEmployeesEmployeeIdTimeDistribution(string|int $employeeId, ?string $year = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/employees/{employeeId}/time_distribution', pathParameters: ['employeeId' => $employeeId], query: $this->shiftbaseQuery(['year' => $year]));
    }

    /**
     * List employee time off balances details for year
     */
    public function getEmployeesEmployeeIdTimeOffBalancesDetailsYear(string|int $employeeId, int|string $year): Response
    {
        return $this->sendEndpoint(Method::GET, '/employees/{employeeId}/timeOff/balances/details/{year}', pathParameters: ['employeeId' => $employeeId, 'year' => $year]);
    }

    /**
     * List upcoming time off balances expiries
     */
    public function getEmployeesEmployeeIdTimeOffBalancesExpiries(string|int $employeeId): Response
    {
        return $this->sendEndpoint(Method::GET, '/employees/{employeeId}/timeOff/balances/expiries', pathParameters: ['employeeId' => $employeeId]);
    }

    // TimeOffBalance

    /**
     * List balances per cycle for employee
     */
    public function getEmployeesEmployeeIdTimeOffBalancesCycles(string|int $employeeId): Response
    {
        return $this->sendEndpoint(Method::GET, '/employees/{employeeId}/timeOff/balances/cycles', pathParameters: ['employeeId' => $employeeId]);
    }

    /**
     * List time off balances
     */
    public function getTimeOffBalances(): Response
    {
        return $this->sendEndpoint(Method::GET, '/time_off_balances');
    }

    /**
     * Add time off balance
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postTimeOffBalances(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/time_off_balances', payload: $payload);
    }

    /**
     * Get time off balance
     */
    public function getTimeOffBalancesTimeOffBalanceId(string|int $timeOffBalanceId): Response
    {
        return $this->sendEndpoint(Method::GET, '/time_off_balances/{timeOffBalanceId}', pathParameters: ['timeOffBalanceId' => $timeOffBalanceId]);
    }

    /**
     * Edit time off balance
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putTimeOffBalancesTimeOffBalanceId(string|int $timeOffBalanceId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/time_off_balances/{timeOffBalanceId}', pathParameters: ['timeOffBalanceId' => $timeOffBalanceId], payload: $payload);
    }

    /**
     * Activate time off balance
     */
    public function getTimeOffBalancesTimeOffBalanceIdActivate(string|int $timeOffBalanceId): Response
    {
        return $this->sendEndpoint(Method::GET, '/time_off_balances/{timeOffBalanceId}/activate', pathParameters: ['timeOffBalanceId' => $timeOffBalanceId]);
    }

    /**
     * Deactivate time off balance
     */
    public function getTimeOffBalancesTimeOffBalanceIdDeactivate(string|int $timeOffBalanceId): Response
    {
        return $this->sendEndpoint(Method::GET, '/time_off_balances/{timeOffBalanceId}/deactivate', pathParameters: ['timeOffBalanceId' => $timeOffBalanceId]);
    }

    // Events

    /**
     * List events
     */
    public function getEvents(DateTimeInterface|string|null $minDate = null, DateTimeInterface|string|null $maxDate = null, string|int|null $departmentId = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/events', query: $this->shiftbaseQuery(['min_date' => $this->shiftbaseDateQueryValue($minDate, 'date'), 'max_date' => $this->shiftbaseDateQueryValue($maxDate, 'date'), 'department_id' => $departmentId]));
    }

    /**
     * Create event
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postEvents(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/events', payload: $payload);
    }

    /**
     * Delete event
     */
    public function deleteEventsEventId(string|int $eventId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/events/{eventId}', pathParameters: ['eventId' => $eventId]);
    }

    /**
     * Get event
     */
    public function getEventsEventId(string|int $eventId): Response
    {
        return $this->sendEndpoint(Method::GET, '/events/{eventId}', pathParameters: ['eventId' => $eventId]);
    }

    /**
     * Edit event
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putEventsEventId(string|int $eventId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/events/{eventId}', pathParameters: ['eventId' => $eventId], payload: $payload);
    }

    /**
     * Delete event in sequence
     */
    public function deleteEventsEventIdSequence(string|int $eventId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/events/{eventId}/sequence', pathParameters: ['eventId' => $eventId]);
    }

    /**
     * Update event in sequence
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putEventsEventIdSequence(string|int $eventId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/events/{eventId}/sequence', pathParameters: ['eventId' => $eventId], payload: $payload);
    }

    /**
     * Process batch of events
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postEventsBatch(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/events/batch', payload: $payload);
    }

    /**
     * Create event in sequence
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postEventsSequence(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/events/sequence', payload: $payload);
    }

    /**
     * List events in sequence
     */
    public function getEventsSequenceSequenceId(string|int $sequenceId, DateTimeInterface|string|null $from = null, DateTimeInterface|string|null $to = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/events/sequence/{sequenceId}', pathParameters: ['sequenceId' => $sequenceId], query: $this->shiftbaseQuery(['from' => $this->shiftbaseDateQueryValue($from, 'date'), 'to' => $this->shiftbaseDateQueryValue($to, 'date')]));
    }

    // Holidays

    /**
     * This endpoint processes a bulk of new holidays
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postHolidaysBatch(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/holidays/batch', payload: $payload);
    }

    /**
     * Get public holidays for a country
     */
    public function getHolidaysCalendarsCountry(string $country, ?string $region = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/holidays/calendars/{country}', pathParameters: ['country' => $country], query: $this->shiftbaseQuery(['region' => $region]));
    }

    /**
     * List Holiday groups
     */
    public function getHolidaysGroups(): Response
    {
        return $this->sendEndpoint(Method::GET, '/holidays/groups');
    }

    /**
     * Create holiday group
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postHolidaysGroups(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/holidays/groups', payload: $payload);
    }

    /**
     * Delete Holiday group
     */
    public function deleteHolidaysGroupsGroupId(string|int $groupId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/holidays/groups/{groupId}', pathParameters: ['groupId' => $groupId]);
    }

    /**
     * Edit holiday group
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putHolidaysGroupsGroupId(string|int $groupId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/holidays/groups/{groupId}', pathParameters: ['groupId' => $groupId], payload: $payload);
    }

    /**
     * Delete holidays for a given year
     */
    public function deleteHolidaysYearYear(int|string $year): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/holidays/year/{year}', pathParameters: ['year' => $year]);
    }

    // HR

    /**
     * List employees in department
     */
    public function getHrDepartmentsDepartmentIdEmployeeList(string|int $departmentId): Response
    {
        return $this->sendEndpoint(Method::GET, '/hr/departments/{departmentId}/employeeList', pathParameters: ['departmentId' => $departmentId]);
    }

    // Insights

    /**
     * List performance insights for a period
     *
     * @param  array<array-key, mixed>|string|null  $departmentIds
     */
    public function getInsightsPerformance(array|string|null $departmentIds = null, DateTimeInterface|string|null $startDate = null, DateTimeInterface|string|null $endDate = null, DateTimeInterface|string|null $comparisonStartDate = null, DateTimeInterface|string|null $comparisonEndDate = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/insights/performance', query: $this->shiftbaseQuery(['department_ids' => $departmentIds, 'start_date' => $this->shiftbaseDateQueryValue($startDate, 'date'), 'end_date' => $this->shiftbaseDateQueryValue($endDate, 'date'), 'comparison_start_date' => $this->shiftbaseDateQueryValue($comparisonStartDate, 'date'), 'comparison_end_date' => $this->shiftbaseDateQueryValue($comparisonEndDate, 'date')]));
    }

    /**
     * Get performance insights chart data for a period
     *
     * @param  array<array-key, mixed>|string|null  $departmentIds
     */
    public function getInsightsPerformanceChartType(string $type, array|string|null $departmentIds = null, DateTimeInterface|string|null $startDate = null, DateTimeInterface|string|null $endDate = null, DateTimeInterface|string|null $comparisonStartDate = null, DateTimeInterface|string|null $comparisonEndDate = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/insights/performance/chart/{type}', pathParameters: ['type' => $type], query: $this->shiftbaseQuery(['department_ids' => $departmentIds, 'start_date' => $this->shiftbaseDateQueryValue($startDate, 'date'), 'end_date' => $this->shiftbaseDateQueryValue($endDate, 'date'), 'comparison_start_date' => $this->shiftbaseDateQueryValue($comparisonStartDate, 'date'), 'comparison_end_date' => $this->shiftbaseDateQueryValue($comparisonEndDate, 'date')]));
    }

    /**
     * Get performance insights chart data for a day
     *
     * @param  array<array-key, mixed>|string|null  $departmentIds
     */
    public function getInsightsPerformanceDailyDateChartType(DateTimeInterface|string $date, string $type, array|string|null $departmentIds = null, DateTimeInterface|string|null $comparisonDate = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/insights/performance/daily/{date}/chart/{type}', pathParameters: ['date' => $date, 'type' => $type], query: $this->shiftbaseQuery(['department_ids' => $departmentIds, 'comparison_date' => $this->shiftbaseDateQueryValue($comparisonDate, 'date')]));
    }

    /**
     * List insights of the schedule
     *
     * @param  array<array-key, mixed>|string|null  $departmentIds
     */
    public function getInsightsSchedule(DateTimeInterface|string|null $from = null, DateTimeInterface|string|null $to = null, array|string|null $departmentIds = null, bool|string|null $useActualTurnover = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/insights/schedule', query: $this->shiftbaseQuery(['from' => $this->shiftbaseDateQueryValue($from, 'date'), 'to' => $this->shiftbaseDateQueryValue($to, 'date'), 'department_ids' => $departmentIds, 'use_actual_turnover' => $useActualTurnover]));
    }

    /**
     * List Scheduled vs. Worked insights
     *
     * @param  array<array-key, mixed>|string|null  $departmentIds
     */
    public function getInsightsScheduledWorked(DateTimeInterface|string|null $startDate = null, DateTimeInterface|string|null $endDate = null, array|string|null $departmentIds = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/insights/scheduled_worked', query: $this->shiftbaseQuery(['start_date' => $this->shiftbaseDateQueryValue($startDate, 'date'), 'end_date' => $this->shiftbaseDateQueryValue($endDate, 'date'), 'department_ids' => $departmentIds]));
    }

    /**
     * List sentiment insights
     *
     * @param  array<array-key, mixed>|string|null  $departmentIds
     */
    public function getInsightsSentiments(array|string|null $departmentIds = null, DateTimeInterface|string|null $startDate = null, DateTimeInterface|string|null $endDate = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/insights/sentiments', query: $this->shiftbaseQuery(['department_ids' => $departmentIds, 'start_date' => $this->shiftbaseDateQueryValue($startDate, 'date'), 'end_date' => $this->shiftbaseDateQueryValue($endDate, 'date')]));
    }

    /**
     * List action cards for insights performance
     *
     * @param  array<array-key, mixed>|string|null  $departmentIds
     */
    public function getPerformanceActions(array|string|null $departmentIds = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/performance/actions', query: $this->shiftbaseQuery(['department_ids' => $departmentIds]));
    }

    /**
     * Dismiss an action card
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postPerformanceActionsDismiss(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/performance/actions/dismiss', payload: $payload);
    }

    /**
     * Add sentiment to timesheet
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postTimesheetsTimesheetIdSentiments(string|int $timesheetId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/timesheets/{timesheetId}/sentiments', pathParameters: ['timesheetId' => $timesheetId], payload: $payload);
    }

    // Locations

    /**
     * List locations
     */
    public function getLocations(?string $include = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/locations', query: $this->shiftbaseQuery(['include' => $include]));
    }

    /**
     * Create location
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postLocations(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/locations', payload: $payload);
    }

    /**
     * Deactivate location
     */
    public function deleteLocationsLocationId(string|int $locationId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/locations/{locationId}', pathParameters: ['locationId' => $locationId]);
    }

    /**
     * Get location
     */
    public function getLocationsLocationId(string|int $locationId): Response
    {
        return $this->sendEndpoint(Method::GET, '/locations/{locationId}', pathParameters: ['locationId' => $locationId]);
    }

    /**
     * Edit location
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putLocationsLocationId(string|int $locationId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/locations/{locationId}', pathParameters: ['locationId' => $locationId], payload: $payload);
    }

    /**
     * Activate location
     */
    public function putLocationsLocationIdActivate(string|int $locationId): Response
    {
        return $this->sendEndpoint(Method::PUT, '/locations/{locationId}/activate', pathParameters: ['locationId' => $locationId]);
    }

    // Open Shifts

    /**
     * List open shifts
     */
    public function getOpenShifts(DateTimeInterface|string|null $minDate = null, DateTimeInterface|string|null $maxDate = null, string|int|null $userId = null, string|int|null $departmentId = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/open_shifts', query: $this->shiftbaseQuery(['min_date' => $this->shiftbaseDateQueryValue($minDate, 'date'), 'max_date' => $this->shiftbaseDateQueryValue($maxDate, 'date'), 'user_id' => $userId, 'department_id' => $departmentId]));
    }

    /**
     * Create open shift
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postOpenShifts(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/open_shifts', payload: $payload);
    }

    /**
     * Get open shift
     */
    public function getOpenShiftsOccurrenceId(string|int $occurrenceId): Response
    {
        return $this->sendEndpoint(Method::GET, '/open_shifts/{occurrenceId}', pathParameters: ['occurrenceId' => $occurrenceId]);
    }

    /**
     * Delete an Open Shift
     */
    public function deleteOpenShiftsOccurrenceIdScope(string|int $occurrenceId, string $scope): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/open_shifts/{occurrenceId}/{scope}', pathParameters: ['occurrenceId' => $occurrenceId, 'scope' => $scope]);
    }

    /**
     * Edit open shift
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putOpenShiftsOccurrenceIdScope(string|int $occurrenceId, string $scope, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/open_shifts/{occurrenceId}/{scope}', pathParameters: ['occurrenceId' => $occurrenceId, 'scope' => $scope], payload: $payload);
    }

    /**
     * Assign open shift
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putOpenShiftsOccurrenceIdAssign(string|int $occurrenceId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/open_shifts/{occurrenceId}/assign', pathParameters: ['occurrenceId' => $occurrenceId], payload: $payload);
    }

    /**
     * Multi assign open shift
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putOpenShiftsOccurrenceIdMultiAssign(string|int $occurrenceId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/open_shifts/{occurrenceId}/multi_assign', pathParameters: ['occurrenceId' => $occurrenceId], payload: $payload);
    }

    /**
     * Request open shift
     */
    public function postOpenShiftsOccurrenceIdRequest(string|int $occurrenceId): Response
    {
        return $this->sendEndpoint(Method::POST, '/open_shifts/{occurrenceId}/request', pathParameters: ['occurrenceId' => $occurrenceId]);
    }

    /**
     * Take an open shift
     */
    public function putOpenShiftsOccurrenceIdTake(string|int $occurrenceId): Response
    {
        return $this->sendEndpoint(Method::PUT, '/open_shifts/{occurrenceId}/take', pathParameters: ['occurrenceId' => $occurrenceId]);
    }

    /**
     * Withdraw requested open shift
     */
    public function postOpenShiftsOccurrenceIdWithdraw(string|int $occurrenceId): Response
    {
        return $this->sendEndpoint(Method::POST, '/open_shifts/{occurrenceId}/withdraw', pathParameters: ['occurrenceId' => $occurrenceId]);
    }

    // Overtime

    /**
     * List overtime policies
     */
    public function getOvertimePolicy(): Response
    {
        return $this->sendEndpoint(Method::GET, '/overtime/policy');
    }

    /**
     * Create overtime policy
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postOvertimePolicy(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/overtime/policy', payload: $payload);
    }

    /**
     * Delete overtime policy
     */
    public function deleteOvertimePolicyPolicyId(string|int $policyId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/overtime/policy/{policyId}', pathParameters: ['policyId' => $policyId]);
    }

    /**
     * Update overtime policy
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putOvertimePolicyPolicyId(string|int $policyId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/overtime/policy/{policyId}', pathParameters: ['policyId' => $policyId], payload: $payload);
    }

    // Pin

    /**
     * Get kiosk pin
     */
    public function getPin(): Response
    {
        return $this->sendEndpoint(Method::GET, '/pin');
    }

    /**
     * Get kiosk pin for employee with id
     */
    public function getPinEmployeeId(string|int $employeeId): Response
    {
        return $this->sendEndpoint(Method::GET, '/pin/{employeeId}', pathParameters: ['employeeId' => $employeeId]);
    }

    /**
     * (Re)generate kiosk pin
     */
    public function postPinGenerate(): Response
    {
        return $this->sendEndpoint(Method::POST, '/pin/generate');
    }

    // Planning

    /**
     * List planning conflicts
     *
     * @param  array<array-key, mixed>|string|null  $employeeIds
     */
    public function getPlanningConflicts(DateTimeInterface|string|null $minDate = null, DateTimeInterface|string|null $maxDate = null, array|string|null $employeeIds = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/planning/conflicts', query: $this->shiftbaseQuery(['min_date' => $this->shiftbaseDateQueryValue($minDate, 'date'), 'max_date' => $this->shiftbaseDateQueryValue($maxDate, 'date'), 'employee_ids' => $employeeIds]));
    }

    /**
     * List planning conflicts for availabilities
     *
     * @param  array<array-key, mixed>|string|null  $employeeIds
     */
    public function getPlanningConflictsAvailabilities(DateTimeInterface|string|null $minDate = null, DateTimeInterface|string|null $maxDate = null, array|string|null $employeeIds = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/planning/conflicts/availabilities', query: $this->shiftbaseQuery(['min_date' => $this->shiftbaseDateQueryValue($minDate, 'date'), 'max_date' => $this->shiftbaseDateQueryValue($maxDate, 'date'), 'employee_ids' => $employeeIds]));
    }

    /**
     * List planning conflicts for schedules
     *
     * @param  array<array-key, mixed>|string|null  $employeeIds
     */
    public function getPlanningConflictsSchedules(DateTimeInterface|string|null $minDate = null, DateTimeInterface|string|null $maxDate = null, array|string|null $employeeIds = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/planning/conflicts/schedules', query: $this->shiftbaseQuery(['min_date' => $this->shiftbaseDateQueryValue($minDate, 'date'), 'max_date' => $this->shiftbaseDateQueryValue($maxDate, 'date'), 'employee_ids' => $employeeIds]));
    }

    /**
     * List planning conflicts for skills
     *
     * @param  array<array-key, mixed>|string|null  $employeeIds
     */
    public function getPlanningConflictsSkills(DateTimeInterface|string|null $minDate = null, DateTimeInterface|string|null $maxDate = null, array|string|null $employeeIds = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/planning/conflicts/skills', query: $this->shiftbaseQuery(['min_date' => $this->shiftbaseDateQueryValue($minDate, 'date'), 'max_date' => $this->shiftbaseDateQueryValue($maxDate, 'date'), 'employee_ids' => $employeeIds]));
    }

    /**
     * List planning conflicts for time off
     *
     * @param  array<array-key, mixed>|string|null  $employeeIds
     */
    public function getPlanningConflictsTimeOff(DateTimeInterface|string|null $minDate = null, DateTimeInterface|string|null $maxDate = null, array|string|null $employeeIds = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/planning/conflicts/time_off', query: $this->shiftbaseQuery(['min_date' => $this->shiftbaseDateQueryValue($minDate, 'date'), 'max_date' => $this->shiftbaseDateQueryValue($maxDate, 'date'), 'employee_ids' => $employeeIds]));
    }

    /**
     * Get employee employability for new shift
     *
     * @param  array<array-key, mixed>|null  $skills
     */
    public function getPlanningEmployability(string|int|null $departmentId = null, ?array $skills = null, DateTimeInterface|string|null $to = null, DateTimeInterface|string|null $from = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/planning/employability', query: $this->shiftbaseQuery(['department_id' => $departmentId, 'skills' => $skills, 'to' => $this->shiftbaseDateQueryValue($to, 'date'), 'from' => $this->shiftbaseDateQueryValue($from, 'date')]));
    }

    /**
     * List shift employability
     */
    public function getPlanningShiftsShiftIdEmployability(string|int $shiftId, DateTimeInterface|string|null $from = null, DateTimeInterface|string|null $to = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/planning/shifts/{shiftId}/employability', pathParameters: ['shiftId' => $shiftId], query: $this->shiftbaseQuery(['from' => $this->shiftbaseDateQueryValue($from, 'date-time'), 'to' => $this->shiftbaseDateQueryValue($to, 'date-time')]));
    }

    // Reports

    /**
     * List favorite reports
     */
    public function getReportingFavorites(): Response
    {
        return $this->sendEndpoint(Method::GET, '/reporting/favorites');
    }

    /**
     * Create favorite report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportingFavorites(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reporting/favorites', payload: $payload);
    }

    /**
     * Delete favorite report
     */
    public function deleteReportingFavoritesUuid(string|int $uuid): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/reporting/favorites/{uuid}', pathParameters: ['uuid' => $uuid]);
    }

    /**
     * Get favorite report
     */
    public function getReportingFavoritesUuid(string|int $uuid): Response
    {
        return $this->sendEndpoint(Method::GET, '/reporting/favorites/{uuid}', pathParameters: ['uuid' => $uuid]);
    }

    /**
     * List recurring reports
     */
    public function getReportingRecurring(): Response
    {
        return $this->sendEndpoint(Method::GET, '/reporting/recurring');
    }

    /**
     * Create recurring report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportingRecurring(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reporting/recurring', payload: $payload);
    }

    /**
     * Delete recurring report
     */
    public function deleteReportingRecurringRecurringReportId(string|int $recurringReportId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/reporting/recurring/{recurringReportId}', pathParameters: ['recurringReportId' => $recurringReportId]);
    }

    /**
     * Get projected report runs
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportingRecurringProjections(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reporting/recurring/projections', payload: $payload);
    }

    /**
     * List requested reports
     */
    public function getReports(): Response
    {
        return $this->sendEndpoint(Method::GET, '/reports');
    }

    /**
     * Fetch/download a report
     */
    public function getReportsReportIdFetch(string|int $reportId, ShiftbaseReportFormat|string|null $format = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/reports/{reportId}/fetch', pathParameters: ['reportId' => $reportId], query: $this->shiftbaseQuery(['format' => $format]));
    }

    /**
     * Status of a report
     */
    public function getReportsReportIdStatus(string|int $reportId): Response
    {
        return $this->sendEndpoint(Method::GET, '/reports/{reportId}/status', pathParameters: ['reportId' => $reportId]);
    }

    /**
     * Describe report type
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsDescribe(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/describe', payload: $payload);
    }

    /**
     * Request report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsRequest(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/request', payload: $payload);
    }

    // Reports (BI)

    /**
     * Absentee report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsAbsentee(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/absentee', payload: $payload);
    }

    /**
     * Availability report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsAvailability(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/availability', payload: $payload);
    }

    /**
     * Day log report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsDayLog(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/day_log', payload: $payload);
    }

    /**
     * Time off balance details report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsEmployeeBalanceDetails(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/employee_balance_details', payload: $payload);
    }

    /**
     * Time off balance summary report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsEmployeeBalanceSummary(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/employee_balance_summary', payload: $payload);
    }

    /**
     * Finished timesheet report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsFinishedTimesheet(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/finished_timesheet', payload: $payload);
    }

    /**
     * Insights performance report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsInsightsPerformance(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/insights_performance', payload: $payload);
    }

    /**
     * Open shifts report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsOpenShifts(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/open_shifts', payload: $payload);
    }

    /**
     * Payroll report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsPayroll(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/payroll', payload: $payload);
    }

    /**
     * Payroll integration report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsPayrollIntegration(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/payroll_integration', payload: $payload);
    }

    /**
     * Period overview report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsPeriodOverview(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/period_overview', payload: $payload);
    }

    /**
     * Permission groups report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsPermissionGroups(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/permission_groups', payload: $payload);
    }

    /**
     * Plus & min report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsPlusMin(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/plus_min', payload: $payload);
    }

    /**
     * Required shifts report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsRequiredShifts(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/required_shifts', payload: $payload);
    }

    /**
     * Schedule summary report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsSchedule(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/schedule', payload: $payload);
    }

    /**
     * Schedule detail report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsScheduleDetail(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/schedule_detail', payload: $payload);
    }

    /**
     * Schedule vs timesheet report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsScheduleTimesheet(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/schedule_timesheet', payload: $payload);
    }

    /**
     * Sentments
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsSentiments(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/sentiments', payload: $payload);
    }

    /**
     * Skills report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsSkills(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/skills', payload: $payload);
    }

    /**
     * Timesheet summery report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsTimesheet(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/timesheet', payload: $payload);
    }

    /**
     * Timesheet detail report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsTimesheetDetail(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/timesheet_detail', payload: $payload);
    }

    /**
     * Timesheet integration report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsTimesheetIntegration(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/timesheet_integration', payload: $payload);
    }

    /**
     * Turnover report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsTurnover(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/turnover', payload: $payload);
    }

    /**
     * Employees report
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postReportsUsers(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/reports/users', payload: $payload);
    }

    // RequiredShifts

    /**
     * Get required shifts
     */
    public function getRequiredShifts(DateTimeInterface|string|null $minDate = null, DateTimeInterface|string|null $maxDate = null, string|int|null $departmentId = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/required_shifts', query: $this->shiftbaseQuery(['min_date' => $this->shiftbaseDateQueryValue($minDate, 'date'), 'max_date' => $this->shiftbaseDateQueryValue($maxDate, 'date'), 'department_id' => $departmentId]));
    }

    /**
     * Add required shift
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postRequiredShifts(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/required_shifts', payload: $payload);
    }

    /**
     * Get Required shift
     */
    public function getRequiredShiftsOccurrenceId(string|int $occurrenceId): Response
    {
        return $this->sendEndpoint(Method::GET, '/required_shifts/{occurrenceId}', pathParameters: ['occurrenceId' => $occurrenceId]);
    }

    /**
     * Delete required shift
     */
    public function deleteRequiredShiftsOccurrenceIdScope(string|int $occurrenceId, string $scope): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/required_shifts/{occurrenceId}/{scope}', pathParameters: ['occurrenceId' => $occurrenceId, 'scope' => $scope]);
    }

    /**
     * Edit required shifts
     */
    public function putRequiredShiftsOccurrenceIdScope(string|int $occurrenceId, string $scope, DateTimeInterface|string|null $minDate = null, DateTimeInterface|string|null $maxDate = null): Response
    {
        return $this->sendEndpoint(Method::PUT, '/required_shifts/{occurrenceId}/{scope}', pathParameters: ['occurrenceId' => $occurrenceId, 'scope' => $scope], query: $this->shiftbaseQuery(['min_date' => $this->shiftbaseDateQueryValue($minDate, 'date'), 'max_date' => $this->shiftbaseDateQueryValue($maxDate, 'date')]));
    }

    // Rosters

    /**
     * List rosters
     */
    public function getRosters(DateTimeInterface|string|null $minDate = null, DateTimeInterface|string|null $maxDate = null, bool|string|null $optimized = null, string|int|null $userId = null, string|int|null $departmentId = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/rosters', query: $this->shiftbaseQuery(['min_date' => $this->shiftbaseDateQueryValue($minDate, 'date'), 'max_date' => $this->shiftbaseDateQueryValue($maxDate, 'date'), 'optimized' => $optimized, 'user_id' => $userId, 'department_id' => $departmentId]));
    }

    /**
     * Create roster
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postRosters(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/rosters', payload: $payload);
    }

    /**
     * Get roster
     */
    public function getRostersOccurrenceId(string|int $occurrenceId): Response
    {
        return $this->sendEndpoint(Method::GET, '/rosters/{occurrenceId}', pathParameters: ['occurrenceId' => $occurrenceId]);
    }

    /**
     * Delete roster
     */
    public function deleteRostersOccurrenceIdScope(string|int $occurrenceId, string $scope): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/rosters/{occurrenceId}/{scope}', pathParameters: ['occurrenceId' => $occurrenceId, 'scope' => $scope]);
    }

    /**
     * Edit roster
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putRostersOccurrenceIdScope(string|int $occurrenceId, string $scope, array $payload = [], DateTimeInterface|string|null $minDate = null, DateTimeInterface|string|null $maxDate = null): Response
    {
        return $this->sendEndpoint(Method::PUT, '/rosters/{occurrenceId}/{scope}', pathParameters: ['occurrenceId' => $occurrenceId, 'scope' => $scope], query: $this->shiftbaseQuery(['min_date' => $this->shiftbaseDateQueryValue($minDate, 'date'), 'max_date' => $this->shiftbaseDateQueryValue($maxDate, 'date')]), payload: $payload);
    }

    /**
     * Get calculated break duration
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postRostersCalculateBreak(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/rosters/calculate_break', payload: $payload);
    }

    // Schedule

    /**
     * Copy schedule
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postScheduleCopy(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/schedule/copy', payload: $payload);
    }

    // Shifts

    /**
     * List shifts
     */
    public function getShifts(bool|string|null $allowDeleted = null, string|int|null $departmentId = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/shifts', query: $this->shiftbaseQuery(['allow_deleted' => $allowDeleted, 'department_id' => $departmentId]));
    }

    /**
     * Create shift
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postShifts(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/shifts', payload: $payload);
    }

    /**
     * Delete a shift
     */
    public function deleteShiftsShiftId(string|int $shiftId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/shifts/{shiftId}', pathParameters: ['shiftId' => $shiftId]);
    }

    /**
     * Get a shift
     */
    public function getShiftsShiftId(string|int $shiftId): Response
    {
        return $this->sendEndpoint(Method::GET, '/shifts/{shiftId}', pathParameters: ['shiftId' => $shiftId]);
    }

    /**
     * Edit a shift
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putShiftsShiftId(string|int $shiftId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/shifts/{shiftId}', pathParameters: ['shiftId' => $shiftId], payload: $payload);
    }

    /**
     * Process batch of shifts
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postShiftsBatch(array $payload = [], ?bool $allowDeleted = null): Response
    {
        return $this->sendEndpoint(Method::POST, '/shifts/batch', query: $this->shiftbaseQuery(['allow_deleted' => $allowDeleted]), payload: $payload);
    }

    // Skills

    /**
     * List skill groups
     */
    public function getSkillGroups(): Response
    {
        return $this->sendEndpoint(Method::GET, '/skill_groups');
    }

    /**
     * Add skill group
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postSkillGroups(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/skill_groups', payload: $payload);
    }

    /**
     * Delete skill group
     */
    public function deleteSkillGroupsSkillGroupId(string|int $skillGroupId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/skill_groups/{skillGroupId}', pathParameters: ['skillGroupId' => $skillGroupId]);
    }

    /**
     * Get skill group
     */
    public function getSkillGroupsSkillGroupId(string|int $skillGroupId): Response
    {
        return $this->sendEndpoint(Method::GET, '/skill_groups/{skillGroupId}', pathParameters: ['skillGroupId' => $skillGroupId]);
    }

    /**
     * Edit skill group
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putSkillGroupsSkillGroupId(string|int $skillGroupId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/skill_groups/{skillGroupId}', pathParameters: ['skillGroupId' => $skillGroupId], payload: $payload);
    }

    /**
     * List skills
     */
    public function getSkills(): Response
    {
        return $this->sendEndpoint(Method::GET, '/skills');
    }

    /**
     * Add skill
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postSkills(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/skills', payload: $payload);
    }

    /**
     * Delete skill
     */
    public function deleteSkillsSkillId(string|int $skillId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/skills/{skillId}', pathParameters: ['skillId' => $skillId]);
    }

    /**
     * Get skill
     */
    public function getSkillsSkillId(string|int $skillId): Response
    {
        return $this->sendEndpoint(Method::GET, '/skills/{skillId}', pathParameters: ['skillId' => $skillId]);
    }

    /**
     * Edit skill
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putSkillsSkillId(string|int $skillId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/skills/{skillId}', pathParameters: ['skillId' => $skillId], payload: $payload);
    }

    // TeamDays

    /**
     * List team days
     */
    public function getTeamDays(DateTimeInterface|string|null $minDate = null, DateTimeInterface|string|null $maxDate = null, string|int|null $departmentId = null, string|int|null $teamId = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/team_days', query: $this->shiftbaseQuery(['min_date' => $this->shiftbaseDateQueryValue($minDate, 'date'), 'max_date' => $this->shiftbaseDateQueryValue($maxDate, 'date'), 'department_id' => $departmentId, 'team_id' => $teamId]));
    }

    /**
     * Create team day
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postTeamDays(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/team_days', payload: $payload);
    }

    /**
     * Get team day
     */
    public function getTeamDaysTeamDayId(string|int $teamDayId): Response
    {
        return $this->sendEndpoint(Method::GET, '/team_days/{teamDayId}', pathParameters: ['teamDayId' => $teamDayId]);
    }

    /**
     * Edit team day
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putTeamDaysTeamDayId(string|int $teamDayId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/team_days/{teamDayId}', pathParameters: ['teamDayId' => $teamDayId], payload: $payload);
    }

    // Teams

    /**
     * List teams
     */
    public function getTeams(string|int|null $departmentId = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/teams', query: $this->shiftbaseQuery(['department_id' => $departmentId]));
    }

    /**
     * Create team
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postTeams(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/teams', payload: $payload);
    }

    /**
     * Delete team
     */
    public function deleteTeamsTeamId(string|int $teamId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/teams/{teamId}', pathParameters: ['teamId' => $teamId]);
    }

    /**
     * Get team
     */
    public function getTeamsTeamId(string|int $teamId): Response
    {
        return $this->sendEndpoint(Method::GET, '/teams/{teamId}', pathParameters: ['teamId' => $teamId]);
    }

    /**
     * Edit team
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putTeamsTeamId(string|int $teamId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/teams/{teamId}', pathParameters: ['teamId' => $teamId], payload: $payload);
    }

    /**
     * Validate delete team
     */
    public function deleteTeamsTeamIdValidate(string|int $teamId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/teams/{teamId}/validate', pathParameters: ['teamId' => $teamId]);
    }

    // Timesheets

    /**
     * Check rate card
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postTimesheetCheckRateCard(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/timesheet/check/rate_card', payload: $payload);
    }

    /**
     * List timesheets
     *
     * @param  array<array-key, mixed>|int|string|null  $departmentId
     */
    public function getTimesheets(DateTimeInterface|string|null $minDate = null, DateTimeInterface|string|null $maxDate = null, string|int|null $userId = null, ShiftbaseApprovalStatus|string|null $status = null, array|string|int|null $departmentId = null, ?string $include = null, bool|string|null $rates = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/timesheets', query: $this->shiftbaseQuery(['min_date' => $this->shiftbaseDateQueryValue($minDate, 'date'), 'max_date' => $this->shiftbaseDateQueryValue($maxDate, 'date'), 'user_id' => $userId, 'status' => $status, 'department_id' => $departmentId, 'include' => $include, 'rates' => $rates]));
    }

    /**
     * Add timesheet
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postTimesheets(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/timesheets', payload: $payload);
    }

    /**
     * Get timesheet
     */
    public function getTimesheetsTimesheetId(string|int $timesheetId): Response
    {
        return $this->sendEndpoint(Method::GET, '/timesheets/{timesheetId}', pathParameters: ['timesheetId' => $timesheetId]);
    }

    /**
     * Edit timesheet
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putTimesheetsTimesheetId(string|int $timesheetId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/timesheets/{timesheetId}', pathParameters: ['timesheetId' => $timesheetId], payload: $payload);
    }

    /**
     * Process batch of timesheets
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postTimesheetsBatch(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/timesheets/batch', payload: $payload);
    }

    /**
     * Get calculated break duration
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postTimesheetsCheckBreak(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/timesheets/check/break', payload: $payload);
    }

    /**
     * Get timesheet totals preview
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postTimesheetsCheckTotal(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/timesheets/check/total', payload: $payload);
    }

    /**
     * List clocked in employees
     */
    public function getTimesheetsClock(): Response
    {
        return $this->sendEndpoint(Method::GET, '/timesheets/clock');
    }

    /**
     * Clock in/out
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postTimesheetsClock(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/timesheets/clock', payload: $payload);
    }

    /**
     * Check if an employee is currently clocked in
     */
    public function getTimesheetsClockUserId(string|int $userId, DateTimeInterface|string|null $date = null, DateTimeInterface|string|null $time = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/timesheets/clock/{userId}', pathParameters: ['userId' => $userId], query: $this->shiftbaseQuery(['date' => $this->shiftbaseDateQueryValue($date, 'date'), 'time' => $this->shiftbaseDateQueryValue($time, 'time')]));
    }

    /**
     * List timesheet conflicts
     *
     * @param  array<array-key, mixed>|int|string|null  $departmentId
     */
    public function getTimesheetsConflicts(DateTimeInterface|string|null $from = null, DateTimeInterface|string|null $to = null, array|string|int|null $departmentId = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/timesheets/conflicts', query: $this->shiftbaseQuery(['from' => $this->shiftbaseDateQueryValue($from, 'date'), 'to' => $this->shiftbaseDateQueryValue($to, 'date'), 'department_id' => $departmentId]));
    }

    /**
     * List potential timesheet conflicts
     */
    public function getTimesheetsConflictsCheck(string|int|null $employeeId = null, DateTimeInterface|string|null $date = null, DateTimeInterface|string|null $startTime = null, DateTimeInterface|string|null $endTime = null, string|int|null $excludeTimesheetId = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/timesheets/conflicts/check', query: $this->shiftbaseQuery(['employeeId' => $employeeId, 'date' => $this->shiftbaseDateQueryValue($date, 'date'), 'startTime' => $this->shiftbaseDateQueryValue($startTime, 'time'), 'endTime' => $this->shiftbaseDateQueryValue($endTime, 'time'), 'excludeTimesheetId' => $excludeTimesheetId]));
    }

    /**
     * Get timesheet statements
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postTimesheetsStatement(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/timesheets/statement', payload: $payload);
    }

    /**
     * Get timesheet day status
     */
    public function getTimesheetsStatus(DateTimeInterface|string|null $minDate = null, DateTimeInterface|string|null $maxDate = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/timesheets/status', query: $this->shiftbaseQuery(['min_date' => $this->shiftbaseDateQueryValue($minDate, 'date'), 'max_date' => $this->shiftbaseDateQueryValue($maxDate, 'date')]));
    }

    /**
     * Get timesheet day status for department on date
     */
    public function getTimesheetsStatusDepartmentIdDate(string|int $departmentId, DateTimeInterface|string $date): Response
    {
        return $this->sendEndpoint(Method::GET, '/timesheets/status/{departmentId}/{date}', pathParameters: ['departmentId' => $departmentId, 'date' => $date]);
    }

    // TimeTrackingKiosk

    /**
     * Get kiosk
     */
    public function getTimetrackingKiosks(): Response
    {
        return $this->sendEndpoint(Method::GET, '/timetracking/kiosks');
    }

    /**
     * Create kiosk
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postTimetrackingKiosks(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/timetracking/kiosks', payload: $payload);
    }

    /**
     * Delete a kiosk
     */
    public function deleteTimetrackingKiosksKioskId(string|int $kioskId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/timetracking/kiosks/{kioskId}', pathParameters: ['kioskId' => $kioskId]);
    }

    /**
     * Get a kiosk
     */
    public function getTimetrackingKiosksKioskId(string|int $kioskId): Response
    {
        return $this->sendEndpoint(Method::GET, '/timetracking/kiosks/{kioskId}', pathParameters: ['kioskId' => $kioskId]);
    }

    /**
     * Update a kiosk
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putTimetrackingKiosksKioskId(string|int $kioskId, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/timetracking/kiosks/{kioskId}', pathParameters: ['kioskId' => $kioskId], payload: $payload);
    }

    /**
     * Invite employees to kiosk
     */
    public function postTimetrackingKiosksKioskIdInvite(string|int $kioskId): Response
    {
        return $this->sendEndpoint(Method::POST, '/timetracking/kiosks/{kioskId}/invite', pathParameters: ['kioskId' => $kioskId]);
    }

    // Users

    /**
     * List users
     */
    public function getUsers(bool|string|null $active = null, bool|string|null $allowHidden = null, string|int|null $departmentId = null): Response
    {
        return $this->sendEndpoint(Method::GET, '/users', query: $this->shiftbaseQuery(['active' => $active, 'allow_hidden' => $allowHidden, 'department_id' => $departmentId]));
    }

    /**
     * Create user
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postUsers(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/users', payload: $payload);
    }

    /**
     * Deactivate user
     */
    public function deleteUsersIdentifier(string $identifier): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/users/{identifier}', pathParameters: ['identifier' => $identifier]);
    }

    /**
     * Get user
     */
    public function getUsersIdentifier(string $identifier): Response
    {
        return $this->sendEndpoint(Method::GET, '/users/{identifier}', pathParameters: ['identifier' => $identifier]);
    }

    /**
     * Edit user
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putUsersIdentifier(string $identifier, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/users/{identifier}', pathParameters: ['identifier' => $identifier], payload: $payload);
    }

    /**
     * (Re)activate user
     */
    public function putUsersIdentifierActivate(string $identifier): Response
    {
        return $this->sendEndpoint(Method::PUT, '/users/{identifier}/activate', pathParameters: ['identifier' => $identifier]);
    }

    /**
     * Anomymize user
     */
    public function deleteUsersIdentifierAnonymize(string $identifier): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/users/{identifier}/anonymize', pathParameters: ['identifier' => $identifier]);
    }

    /**
     * User permissions
     *
     * @param  ShiftbasePayload  $payload
     */
    public function putUsersIdentifierPermissions(string $identifier, array $payload = []): Response
    {
        return $this->sendEndpoint(Method::PUT, '/users/{identifier}/permissions', pathParameters: ['identifier' => $identifier], payload: $payload);
    }

    /**
     * Delete avatar
     */
    public function deleteUsersUserIdAvatar(string|int $userId): Response
    {
        return $this->sendEndpoint(Method::DELETE, '/users/{userId}/avatar', pathParameters: ['userId' => $userId]);
    }

    /**
     * Get absense policies for users
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postUsersAbsencePolicies(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/users/absence/policies', payload: $payload);
    }

    /**
     * Create or update many users
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postUsersBatch(array $payload = [], ?bool $allowDeleted = null): Response
    {
        return $this->sendEndpoint(Method::POST, '/users/batch', query: $this->shiftbaseQuery(['allow_deleted' => $allowDeleted]), payload: $payload);
    }

    /**
     * Invite users
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postUsersInvite(array $payload = [], bool|string|null $resendInvite = null): Response
    {
        return $this->sendEndpoint(Method::POST, '/users/invite', query: $this->shiftbaseQuery(['resend_invite' => $resendInvite]), payload: $payload);
    }

    /**
     * Send message to users
     *
     * @param  ShiftbasePayload  $payload
     */
    public function postUsersMessage(array $payload = []): Response
    {
        return $this->sendEndpoint(Method::POST, '/users/message', payload: $payload);
    }

    /**
     * @param  ShiftbaseQuery  $query
     * @return ShiftbaseQuery
     */
    private function shiftbaseQuery(array $query): array
    {
        $filtered = [];

        foreach ($query as $key => $value) {
            if ($value !== null) {
                $filtered[$key] = $this->shiftbaseQueryValue($value);
            }
        }

        return $filtered;
    }

    private function shiftbaseDateQueryValue(DateTimeInterface|string|null $value, string $format): ?string
    {
        if ($value === null) {
            return null;
        }

        if (is_string($value)) {
            return $value;
        }

        return match ($format) {
            'time' => $value->format('H:i:s'),
            'date-time' => $value->format(DATE_ATOM),
            default => $value->format('Y-m-d'),
        };
    }

    private function shiftbaseQueryValue(mixed $value): mixed
    {
        if ($value instanceof BackedEnum) {
            return $value->value;
        }

        if ($value instanceof DateTimeInterface) {
            return $value->format(DATE_ATOM);
        }

        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        if (is_array($value)) {
            return array_map(
                fn (mixed $item): mixed => $this->shiftbaseQueryValue($item),
                $value,
            );
        }

        return $value;
    }
}
