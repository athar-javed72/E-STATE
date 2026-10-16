# STATE — FindState (E-STATE)

Phase 0 product build — **DONE**  
Phase 1 (process + practice hardening) — **COMPLETED**

Archived PRD: `docs/archive/PRD_phase1.md`

---

## 1. What exists

### Stack
- Laravel 12, PHP 8.2+, Blade, Bootstrap 5, Tailwind 4, Vite 6, Axios
- SQLite default (`database/database.sqlite` locally); seeders for agents, properties (incl. plot/commercial), blogs, testimonials, demo admin (`is_admin`)
- Auth: `/login` + `users.is_admin` + middleware `auth` + `admin`

### Public site
- Home, About, Services, Properties (filters/sort), Property detail, Agents, Agent detail, Blog, Contact
- Session wishlist with CSRF-aware AJAX toggle on property cards
- Property inquiry, newsletter, search suggestions
- SEO: `/sitemap.xml`, `/robots.txt`

### Admin (`/admin`)
- Dashboard, CRUD for properties / agents / blogs / **testimonials**, contacts list
- FormRequests authorize via `User::isAdmin()`

### Process / agent tooling
- `PRD.md`, `progress.txt`, `.planning/STATE.md`
- `.agents/` + `.agent/` plugins (GSD, Ralph Loop, Context7, Serena, CodeRabbit, server-validation)
- `.cursor/rules/` + `.cursor/mcp.json`
- `docs/DECISIONS.md`, `docs/archive/`

### Tests
- PHPUnit: `AdminGateTest` (guest redirect, non-admin 403, admin 200)
- Home smoke tests use `RefreshDatabase` + `withoutVite()`
- Suite green: 6 passed

---

## 2. Known gaps (post Phase 1)

- Spatie Permission package present but roles not wired (out of scope Phase 1)
- Contact-agent modal still redirects to contact page (basic)
- Share property uses numeric id in URL fallback (slug would be nicer)
- Overall PHPUnit coverage still thin beyond gate + home smoke
- No payments / search engine / API versioning

---

## 3. Next

Wait for a new phase PRD pack before starting Phase 2 work. Do not invent scope.
