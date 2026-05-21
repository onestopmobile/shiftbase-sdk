# One Stop Mobile Shiftbase SDK Agent Guide

<strict-php-sdk-guidelines>
=== foundation rules ===

## Foundational Context

This project is a pure PHP SDK package, not a Laravel application and not a frontend project.
It is maintained by One Stop Mobile for integrations with the Shiftbase API.
Do not describe it as an official Shiftbase SDK or as software published by Shiftbase unless the user explicitly confirms that.

Primary stack:
- PHP 8.5 only, with Composer constrained to `^8.5.0`
- Saloon 4
- Pest 5
- PHPUnit 13 through Pest
- PHPStan 2 with bleeding edge rules and `level: max`
- Laravel Pint 1 with strict style rules
- Rector 2 with strict prepared sets

## Project Shape

- Follow the existing package structure in `src/` and `tests/`; do not introduce app-style folders.
- Do not add Laravel application, frontend, Bun, Vite, database, migration, controller, or Blade conventions unless explicitly requested.
- Do not change runtime dependencies or package architecture without explicit approval.
- Tooling changes are allowed when the task is explicitly about strictness, quality, or verification.
- Do not create documentation files unless explicitly requested by the user.

## Code Conventions

- You must follow existing code conventions. Check sibling files before adding or changing code.
- Prefer small immutable value objects and explicit typed services.
- Use `final` classes by default. Use `readonly` classes or properties where mutation is not required.
- Use descriptive names for methods, properties, and variables. For example, `authorizationType`, not `type`.
- Always add explicit parameter and return types.
- Always use curly braces for control structures, even for single-line bodies.
- Prefer strict comparisons.
- Prefer `mb_*` string functions when handling human text.
- Use PHPDoc only when it adds useful type detail, such as array shapes, generics, or non-empty lists.
- Prefer PHPDoc blocks over inline comments. Add inline comments only for exceptionally complex logic.

## SDK Boundaries

- Keep Saloon request classes focused on HTTP method, endpoint, query, and body payload behavior.
- Keep DTOs/value objects independent from framework helpers.
- Avoid framework globals, facades, containers, and magic helpers.
- Do not make real HTTP requests in tests. Use Saloon fakes or existing test helpers.
- Do not introduce broad abstractions unless they remove real duplication or match an existing local pattern.

=== tests rules ===

## Test Enforcement

- Every substantive change must be covered by a Pest test or an updated Pest test.
- Do not delete tests or test files without explicit approval.
- Test happy paths, failure paths, and weird edge cases when behavior changes.
- Run the smallest relevant test first while working.
- For endpoint support, add or update tests that prove the SDK request, payload, response mapping, and facade method where relevant.

## Endpoint Tracking

- When implementing, changing, or removing API endpoint support, update `implementation.md` if it exists.
- After endpoint changes, double-check that endpoint tracking matches the actual SDK surface.
- Only mark an endpoint as implemented when the corresponding SDK code and relevant tests are in place.

=== tooling rules ===

## Git Conventions

- Always write commit messages according to Conventional Commits 1.0.0: `https://www.conventionalcommits.org/en/v1.0.0/`.
- Use the format `<type>[optional scope]: <description>`, with `feat`, `fix`, `docs`, `style`, `refactor`, `test`, `build`, `ci`, or `chore` as appropriate.
- Mark breaking changes with `!` in the type/scope prefix or a `BREAKING CHANGE:` footer.

## Required Verification

Before finishing substantive changes, keep the package clean by running:
- `composer format`
- `composer check`
- the relevant `composer test:*` command for touched code

For broad or tooling changes, also run:
- `composer test`

## Tooling Expectations

- Use Pest for all tests.
- Keep PHPStan passing at max level with bleeding edge enabled.
- Use Pint to fix style; do not leave formatting issues behind.
- Use Rector for safe automated refactors, then review its changes.
- When refactoring, use `composer rector` or `composer test:lint` to confirm Rector stays clean.
- Do not add PHPStan baselines, ignored errors, or broad suppressions unless the user explicitly approves.
- Do not lower coverage, type coverage, PHPStan level, Pint strictness, Rector strictness, or PHP version constraints.

## Replies

- Be concise and focus on the important outcome, verification, and any remaining risk.
- If verification cannot be run, say exactly what blocked it.

</strict-php-sdk-guidelines>
