# Project Requirements Document (PRD): Phase 1 — FindState (E-STATE) Hardening & Practice Ops

## Overview

**FindState (E-STATE)** is a Laravel 12 practice / portfolio real-estate site (public listings + admin CRUD). Core product features already exist (properties, agents, blog, contact, wishlist, newsletter, admin panel).

This PRD covers **Phase 1 only**: process setup (Ralph Loop / planning docs), remaining practice hardening, and verification. Do **not** turn this into a multi-tenant ERP or rewrite the stack.

Repo: `https://github.com/athar-javed72/E-STATE` · Local: `D:\Projects\Laravel Projects\E-STATE-main`

## Stack and environment (fixed)

- Laravel 12, PHP 8.2+, Blade + Bootstrap 5 + Tailwind 4 + Vite 6
- Default DB: SQLite (MySQL/PostgreSQL compatible)
- Auth: session login + `users.is_admin` gate (`auth` + `admin` middleware)
- Quality: PHPUnit (existing), `php -l` on changed PHP; Pint optional if installed
- Secrets: `.env` only — never commit `.env`, DB dumps (`estate_db`, `e-state-bd`, `*.sqlite`)

## Hard rules (apply to every task)

1. One task per turn when executing under Ralph Loop. Read `PRD.md` + `progress.txt` from disk first.
2. Append-only `progress.txt` — never rewrite earlier entries. Mark PRD checkboxes `[x]` when done.
3. Do not invent major domains (payments, multi-tenancy, Spatie roles wiring) unless a later PRD says so.
4. Prefer small, focused diffs. Match existing Blade/admin patterns.
5. Never weaken CSRF, throttles, or `is_admin` checks already added.
6. Verification gate for PHP tasks: `php -l` on changed files; run relevant PHPUnit if present; smoke key routes mentally / via `php artisan route:list` when routes change.
7. Git: follow the **user’s** instruction for commit/push. Do not push secrets. Prefer `E-STATE-main` repo only (ignore any Temp `E-STATE-sync` clones).
8. Keep demo credentials offline: login page shows seeded user **only** when `APP_DEBUG=true`.

## Already done (do not redo)

- Remote `origin` → `athar-javed72/E-STATE` on `main`
- `is_admin` migration + middleware + login checks + FormRequest authorize
- Throttles on login / public POSTs
- Blog `safeContent()` sanitization
- Property types aligned (`plot`, `commercial`, `townhouse`, …)
- Spatie permission dependency pinned `^6.0` (not fully wired — OK for Phase 1)
- DB dumps removed/ignored; stale `Kernel.php` removed
- Ralph / GSD / Context7 / Serena / CodeRabbit / server-validation plugin packs installed under `.agents/` + `.agent/`

## Tasks

- [x] Task 1: Install process pack — copy/adapt School ERP agent plugins (`.agents/`, `.agent/`), add Cursor rules, root `PRD.md`, `progress.txt`, `.planning/STATE.md`, and `docs/` stubs for FindState.
- [ ] Task 2: Add a focused feature test for admin gate — guest cannot hit `/admin`; non-admin authenticated user gets 403; admin can open dashboard. Done when: PHPUnit green for the new test.
- [ ] Task 3: Wire wishlist AJAX on `property-card` (session wishlist route already exists) with CSRF-aware fetch/axios. Done when: toggle works without full page reload and no console CSRF errors.
- [ ] Task 4: Admin testimonials CRUD (model + migration already exist for testimonials; public home shows them) — index/create/edit/delete under `/admin` with FormRequests + `is_admin`. Done when: admin can manage testimonials end-to-end.
- [ ] Task 5: Seed at least one `plot` and one `commercial` property so home type filters are not empty. Done when: seeder + `migrate:fresh --seed` shows those types in listing filters.
- [ ] Task 6: Phase 1 handoff — update `.planning/STATE.md`, archive this PRD to `docs/archive/PRD_phase1.md` (copy, do not move), leave known gaps listed. Then STOP.

## Out of scope for this PRD

Payments/gateway, full Spatie role UI, Meilisearch, API versioning, React/Vue rewrite, multi-tenancy, production deploy hardening beyond current practice level, School ERP fee/ledger features.
