# TOKOSAYA PROJECT RULES

## Stack
- Laravel 13
- PHP 8.3
- MySQL
- Blade, Tailwind CSS, Vite

## Development Rules
- Inspect only files relevant to the current task.
- Avoid scanning the entire repository.
- Exclude vendor/, node_modules/, storage/, bootstrap/cache/, and .git/.
- Use targeted searches instead of reading unrelated files.
- Reuse existing components, CSS, and architecture.
- Make minimal, focused changes.
- Avoid unnecessary dependencies and duplicated code.

## Preserve Functionality
- Do not modify database, migrations, routes, controllers, or backend logic for UI-only tasks.
- Preserve authentication, roles, cart, checkout, orders, and admin features.
- Never remove existing functionality.
- Never commit or push without explicit permission.

## UI/UX Design
- Background: #FDFBF7
- Text: #3E2723
- Accent: #D35400
- Maintain consistent typography, spacing, and responsive layouts.
- Prioritize smooth interactions and mobile usability.

## Workflow
1. Identify relevant files.
2. Inspect existing implementation.
3. Implement focused changes.
4. Run relevant tests and builds.
5. Report modified files and test results.
