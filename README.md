# E-STATE (FindState)

**Modern Real Estate Listing & Lead Generation Platform**

E-STATE (brand: **FindState**) is a full-stack real estate web application built with **Laravel 12**. Visitors can browse properties for sale or rent, discover agents, read the blog, use a session wishlist, and submit inquiries. Admins manage listings, agents, blogs, testimonials, and contacts from a protected panel.

Suitable for **portfolio demos**, client walkthroughs, or as a starting base for a production real-estate site.

**Repository:** [athar-javed72/E-STATE](https://github.com/athar-javed72/E-STATE)

---

## Table of Contents

1. [Project Overview](#1-project-overview)
2. [Tech Stack](#2-tech-stack)
3. [Features & Domain Model](#3-features--domain-model)
4. [Installation & Setup](#4-installation--setup)
5. [Routing & Endpoints](#5-routing--endpoints)
6. [Project Structure](#6-project-structure)
7. [Security Notes](#7-security-notes)
8. [Development Process](#8-development-process)
9. [Testing](#9-testing)
10. [Portfolio & Extensions](#10-portfolio--extensions)
11. [License](#11-license)

---

## 1. Project Overview

### Public Website

- **Home** — Hero, search, featured properties, agents, testimonials, latest blog posts.
- **Static pages** — About, Services, Contact (SEO-friendly).
- **Properties** — Filters (type, listing type, price, bedrooms, location) and sorting; detail page with agent and related listings.
- **Property types** — `house`, `apartment`, `condo`, `villa`, `plot`, `commercial`, `townhouse`.
- **Agents** — Listing + profile pages with active properties.
- **Blog** — Category filter, search, detail pages; HTML content sanitized for public display (`safeContent()`).
- **SEO** — `/sitemap.xml` and `/robots.txt`.

### Interactive Features

- Session-based **wishlist** (no login) with CSRF-aware AJAX toggle on property cards.
- Property and general **contact inquiries** stored in the database.
- Property **search suggestions** (JSON).
- **Newsletter** subscription.

### Admin Panel (`/admin`)

- Login at `/login` — only users with `is_admin = true` can enter.
- Dashboard statistics.
- CRUD for **properties**, **agents**, **blogs**, and **testimonials**.
- Contact inquiry listing.
- Form requests authorize via `User::isAdmin()`.

---

## 2. Tech Stack

| Layer | Technology |
|-------|------------|
| **Backend** | PHP 8.2+, Laravel 12 |
| **Frontend** | Blade, Bootstrap 5, Tailwind CSS 4, jQuery |
| **Build** | Vite 6, Laravel Vite Plugin |
| **Database** | SQLite (default), MySQL / PostgreSQL compatible |
| **Auth** | Session login + `users.is_admin` + `auth` / `admin` middleware |
| **HTTP / AJAX** | Axios + `fetch` (CSRF token from meta tag) |
| **Testing** | PHPUnit |
| **Optional packages** | Spatie Laravel Permission (pinned, not fully wired yet) |

---

## 3. Features & Domain Model

### Core Entities

| Entity | Notes |
|--------|--------|
| **User** | Auth user; `is_admin` flag for admin panel |
| **Agent** | Slug, contact, avatar, bio, socials, experience, rating, status |
| **Property** | Linked to agent; type, listing type, price, beds/baths/area/parking, images, featured, views, status |
| **Blog** | Slug, category, excerpt, HTML content (sanitized on output), image, author, views, status |
| **Testimonial** | Name, designation, location, image, content, rating, status |
| **Contact** | Optional `property_id`, name, email, phone, subject, message, type, status |
| **NewsletterSubscriber** | Email + active flag |

### Frontend Pages

| Page | Description |
|------|-------------|
| Home | Hero, search, featured properties, agents, testimonials, blog, CTA |
| About | Story, mission, team, testimonials |
| Services | Buying, selling, renting, management, consulting |
| Properties | Grid + filters/sort; `property-card` component |
| Property Detail | Full details, agent panel, related |
| Agents / Agent Detail | Grid + bio and listings |
| Blog / Blog Detail | List + article |
| Contact | Validated form + flash messages |
| Login | Admin sign-in |

---

## 4. Installation & Setup

### Prerequisites

- PHP 8.2+ (BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML)
- Composer
- Node.js 18+ and npm
- SQLite (default) or MySQL/PostgreSQL

### Steps

**1. Clone and install**

```bash
git clone https://github.com/athar-javed72/E-STATE.git E-STATE
cd E-STATE

composer install
npm install
```

**2. Environment**

```bash
cp .env.example .env
php artisan key:generate
```

Set SQLite (recommended for local):

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

**3. Create SQLite file**

```bash
# Linux / macOS
mkdir -p database && touch database/database.sqlite

# Windows (PowerShell)
New-Item -ItemType File -Path database/database.sqlite -Force
```

**4. Migrate & seed**

```bash
php artisan migrate --seed
```

Creates tables: `users` (with `is_admin`), `agents`, `properties`, `blogs`, `testimonials`, `contacts`, `newsletter_subscribers`, sessions, cache, jobs, etc.

Demo admin (local / `APP_DEBUG` only):

| Field | Value |
|-------|--------|
| Email | `test@example.com` |
| Password | `password` |
| Admin | `is_admin = true` |

Individual seeders:

```bash
php artisan db:seed --class=AgentSeeder
php artisan db:seed --class=PropertySeeder
php artisan db:seed --class=BlogSeeder
php artisan db:seed --class=TestimonialSeeder
```

**5. Frontend assets**

```bash
npm run build
# or for hot reload:
npm run dev
```

**6. Run**

```bash
php artisan serve
```

Open **http://localhost:8000** · Admin: **http://localhost:8000/login**

### Optional

```bash
php artisan storage:link
```

Spatie roles (future): publish provider migrations if you wire permission middleware. Package is already in `composer.json` at `^6.0`.

---

## 5. Routing & Endpoints

### Public

| Method | Path | Description |
|--------|------|-------------|
| GET | `/` | Home |
| GET | `/about` | About |
| GET | `/services` | Services |
| GET | `/properties` | Listing (filters, sort) |
| GET | `/properties/type/{type}` | By type (JSON) |
| GET | `/properties/{slug}` | Detail |
| GET | `/agents` | Agents |
| GET | `/agents/{slug}` | Agent detail |
| GET | `/blog` | Blog list |
| GET | `/blog/category/{category}` | By category |
| GET | `/blog/{slug}` | Post |
| GET/POST | `/contact` | Contact form |
| GET/POST | `/login` | Admin login (POST throttled) |
| POST | `/logout` | Logout |

### Frontend API (throttled)

| Method | Path | Description |
|--------|------|-------------|
| POST | `/api/frontend/property/wishlist/{property}` | Toggle wishlist |
| POST | `/api/frontend/property/contact/{property}` | Property inquiry |
| POST | `/api/frontend/contact/property-inquiry` | Generic inquiry |
| GET | `/api/frontend/search/suggestions` | Suggestions |
| POST | `/api/frontend/newsletter/subscribe` | Newsletter |

### SEO

- `GET /sitemap.xml`
- `GET /robots.txt`

### Admin (`auth` + `admin`)

| Area | Routes |
|------|--------|
| Dashboard | `GET /admin` |
| Properties | resource (except show) |
| Agents | resource (except show) |
| Blogs | resource (except show) |
| Testimonials | resource (except show) |
| Contacts | `GET /admin/contacts` |

---

## 6. Project Structure

```
E-STATE/
├── app/
│   ├── Console/Commands/          # e.g. admin:reset-password
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/              # LoginController
│   │   │   ├── Frontend/          # Home, Property, Agent, Blog, Contact
│   │   │   └── Admin/             # Dashboard, Property, Agent, Blog, Testimonial, Contact
│   │   ├── Middleware/            # EnsureUserIsAdmin
│   │   └── Requests/              # Store/Update* FormRequests
│   └── Models/
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── database.sqlite            # local DB (gitignored)
├── docs/
│   ├── DECISIONS.md
│   └── archive/                   # completed PRD copies
├── .planning/STATE.md             # phase handoff snapshot
├── PRD.md                         # active phase contract
├── progress.txt                   # append-only work log
├── AGENTS.md                      # agent/plugin orientation
├── .agents/ / .agent/             # GSD, Ralph Loop, Context7, etc.
├── .cursor/rules/                 # Cursor project rules
├── resources/views/
│   ├── frontend/
│   └── admin/
├── routes/web.php
├── tests/Feature/                 # AdminGateTest, smoke tests
├── vite.config.js
├── composer.json
└── package.json
```

---

## 7. Security Notes

Practice / portfolio defaults — tighten before any real production deploy:

- Admin access requires `is_admin`; non-admins receive **403**.
- Login and public POSTs are **rate-limited** (`throttle`).
- Demo credentials on the login page appear **only when `APP_DEBUG=true`**.
- Blog HTML is output through **`safeContent()`** (allowlisted tags; strips event handlers / `javascript:` URLs).
- Never commit `.env` or DB dumps (`estate_db`, `e-state-bd`, `*.sqlite` are gitignored).
- Change the seeded admin password before sharing a public demo URL.

Reset / create local admin:

```bash
php artisan admin:reset-password --email=test@example.com --password=password
```

---

## 8. Development Process

This repo follows the same planning style as larger practice monorepos:

| File | Purpose |
|------|---------|
| `PRD.md` | Active phase tasks (checkboxes) |
| `progress.txt` | Append-only completion log |
| `.planning/STATE.md` | What exists / gaps / next |
| `docs/DECISIONS.md` | Short decision ledger |
| `docs/archive/` | Finished PRD copies |
| `.agents/` / `.agent/` | Plugins: GSD, Ralph Loop, Context7, Serena, CodeRabbit, server-validation |
| `.cursor/rules/` | Cursor always-on rules |

**Phase 1 (hardening + process + testimonials CRUD + wishlist AJAX + gate tests) is complete.** See `docs/archive/PRD_phase1.md`.

---

## 9. Testing

```bash
php artisan test
```

Includes:

- **AdminGateTest** — guest redirect, non-admin 403, admin OK
- Home smoke tests (`RefreshDatabase` + `withoutVite()`)

---

## 10. Portfolio & Extensions

### How to present it

- *“Full-stack real estate platform on Laravel 12, Blade, Tailwind, Bootstrap, and Vite.”*
- *“Property/agent listings, blog, testimonials, inquiries, wishlist, newsletter, and an `is_admin` admin panel.”*
- *“Includes filters, search suggestions, CSRF-aware AJAX wishlist, and rate-limited public forms.”*

### Possible next steps

- Wire Spatie roles/permissions for multi-admin access.
- Stronger contact/share UX (modals, slug-based share URLs).
- Broader PHPUnit / Pest coverage.
- Meilisearch or full-text search.
- Image pipeline + `storage:link` in deploy docs.
- API versioning / OpenAPI.

---

## 11. License

Based on the Laravel framework; licensed under the **MIT License**.
