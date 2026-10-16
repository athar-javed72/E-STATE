# Decisions — FindState (E-STATE)

Lightweight decision log (School ERP uses `DECISIONS_PHASE2.md`; this project keeps a shorter ledger).

| ID | Decision | Notes |
|----|----------|--------|
| D-01 | Practice / portfolio scope | Not production multi-tenant ERP |
| D-02 | Admin auth = `is_admin` boolean | Spatie package pinned but not required for Phase 1 |
| D-03 | Demo login hint only if `APP_DEBUG` | Never show credentials when debug is off |
| D-04 | Blog HTML via `safeContent()` | Allowlisted tags; strip event handlers / javascript URLs |
| D-05 | Property types | `house`, `apartment`, `condo`, `villa`, `plot`, `commercial`, `townhouse` |
| D-06 | Process model | Ralph Loop: `PRD.md` + `progress.txt` + `.planning/STATE.md` |
| D-07 | Agent plugins | Same pack as School ERP New folder: GSD, Ralph, Context7, Serena, CodeRabbit, server-validation |
| D-08 | Git remote | Only `https://github.com/athar-javed72/E-STATE.git` from `E-STATE-main` |
