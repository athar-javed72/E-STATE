# Laravel Stack Rules — FindState (E-STATE)

When working in this repository:

1. **Stack**: Laravel 12, PHP 8.2+, Blade, Bootstrap 5, Tailwind 4, Vite. Do not introduce React/Vue SPA rewrites unless a PRD says so.
2. **Admin access**: Every `/admin` route must stay behind `auth` + `admin` (`is_admin`). FormRequests authorize with `$user instanceof \App\Models\User && $user->isAdmin()`.
3. **Auth typing**: Never call `Auth::user()->isAdmin()` without an `instanceof User` check (Intelephense + runtime safety).
4. **Money / IDs**: This app uses normal decimal `price` (not paisa). Do not apply School ERP paisa rules here.
5. **Secrets**: Never commit `.env`, SQLite dumps, or DB files (`estate_db`, `e-state-bd`).
6. **Verification**: Prefer `php -l` on changed PHP; run PHPUnit when tests exist for the change.
7. **Process**: Active work comes from root `PRD.md`. Log to `progress.txt`. Update `.planning/STATE.md` at phase handoff.
8. **Plugins**: Use GSD / Ralph Loop / Context7 / Serena / CodeRabbit / server-validation workflows from `.agents/` when the user invokes them; do not invent parallel process files.
