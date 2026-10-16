# AGENTS — FindState (E-STATE)

## How this repo is run (same model as School ERP “New folder”)

| File / folder | Role |
|---------------|------|
| `PRD.md` | Active phase contract (checkbox tasks) |
| `progress.txt` | Append-only Ralph Loop log |
| `.planning/STATE.md` | Phase snapshot / handoff |
| `docs/DECISIONS.md` | Short decision ledger |
| `docs/archive/` | Completed PRD copies |
| `.agents/` | Plugins, rules, skills, workflows, MCP template |
| `.agent/` | Runtime workflows + CLI bins (`ralph-loop`, `gsd-tools`) |
| `.cursor/rules/` | Cursor always-on project rules |
| `.cursor/mcp.json` | Cursor MCP (Context7) |

## Plugins (copied & adapted from School ERP)

- **gsd** — plan / execute / verify
- **ralph-loop** — drive `PRD.md` tasks
- **context7** — docs MCP
- **serena** — codebase MCP (optional; needs `uvx`)
- **coderabbit** — review / autofix skills
- **server-validation** — validate after changes

## Product context

FindState is a **practice Laravel real-estate** site, not School ERP. Do not import paisa/ledger/tenancy rules.

## Current phase

See `PRD.md` (Phase 1). Next open task after setup: admin-gate feature test.
