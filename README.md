# E-STATE (FindState)

**Modern Real Estate Listing & Lead Generation Platform**

E-STATE (brand: **FindState**) is a full-stack real estate web application built with Laravel 12. It enables visitors to browse properties for sale or rent, discover featured agents, read market insights on the blog, and submit inquiries or contact requests. The platform is suitable for portfolio demonstration, client demos, or as a foundation for a production real estate business.

---

## Table of Contents

1. [Project Overview](#1-project-overview)
2. [Tech Stack](#2-tech-stack)
3. [Features & Domain Model](#3-features--domain-model)
4. [Installation & Setup](#4-installation--setup)
5. [Routing & Endpoints](#5-routing--endpoints)
6. [Project Structure](#6-project-structure)
7. [Portfolio & Business Use](#7-portfolio--business-use)
8. [License](#8-license)

---

## 1. Project Overview

### Public Website

- **Home** — Hero section, key statistics, featured properties, top agents, testimonials slider, and latest blog posts.
- **Static pages** — SEO-friendly About, Services, and Contact pages.
- **Properties** — Listing with filters (type, listing type, price range, bedrooms, location) and sorting; property detail page with agent info, features, and related properties.
- **Agents** — Agent listing and individual agent profiles with their active listings.
- **Blog** — Listing with category filtering and search; blog detail pages with related posts.
- **Contact** — Validated contact form with persistence and flash messages.
- **SEO** — Sitemap (`/sitemap.xml`) and `robots.txt`.

### Interactive Features

- Session-based property wishlist (no login required).
- Property and general contact inquiries stored in the database.
- Property search suggestions (JSON) for autocomplete.
- Newsletter subscription with subscriber storage.

### Admin Panel

- Authenticated admin area with dashboard and CRUD for properties, agents, and blog posts.
- Contact inquiry listing.
- Laravel Breeze and Spatie Laravel Permission ready for role-based access.

---

## 2. Tech Stack

| Layer           | Technology                                                |
|-----------------|-----------------------------------------------------------|
| **Backend**     | PHP 8.2+, Laravel 12                                      |
| **Frontend**    | Blade templates, Bootstrap 5, Tailwind CSS 4, jQuery     |
| **Build**       | Vite 6, Laravel Vite Plugin                              |
| **Database**    | SQLite (default), MySQL/PostgreSQL compatible            |
| **Auth & Roles**| Laravel Breeze (available), Spatie Laravel Permission     |
| **HTTP Client** | Axios (AJAX)                                              |
| **Testing & Dev** | PHPUnit, Laravel Pail, Laravel Pint, Faker, Laravel Sail (optional) |

---

## 3. Features & Domain Model

### Core Entities

- **User** — Laravel user model (Breeze-ready).
- **Agent** — Name, slug, contact info, avatar, bio, social links, experience, rating, status.
- **Property** — Linked to an agent; type (house, apartment, condo, villa), listing type (for_sale, for_rent), price, bedrooms, bathrooms, area, parking, images, featured flag, views, status.
- **Blog** — Title, slug, category, excerpt, HTML content, featured image, author, views, status.
- **Testimonial** — Client name, designation, location, image, content, rating, status.
- **Contact** — General and property inquiries: optional `property_id`, name, email, phone, subject, message, type, status.
- **NewsletterSubscriber** — Email and active flag.

### Frontend Pages

| Page           | Description                                                                 |
|----------------|-----------------------------------------------------------------------------|
| Home           | Hero, search, featured properties, why choose us, agents, testimonials, blog, CTA |
| About          | Company story, mission, values, team, testimonials                         |
| Services       | Buying, selling, renting, property management, investment consulting       |
| Properties     | Grid listing with filters and sorting; reusable property-card component    |
| Property Detail| Full details, agent panel, related properties                               |
| Agents         | Agent grid                                                                  |
| Agent Detail   | Bio and active listings                                                    |
| Blog           | Posts with search, categories, recent posts sidebar                        |
| Blog Detail    | Full article, featured image, related posts                                |
| Contact        | Form with validation and success/error messages                             |

---

## 4. Installation & Setup

### Prerequisites

- **PHP** 8.2+ with extensions: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML
- **Composer**
- **Node.js** 18+ and **npm**
- **Database**: SQLite (default) or MySQL/PostgreSQL

### Steps

**1. Clone and install dependencies**

```bash
git clone <your-repo-url> E-STATE
cd E-STATE

composer install
npm install
```

**2. Environment**

```bash
cp .env.example .env
php artisan key:generate
```

**3. Database (SQLite)**

```bash
# Linux / macOS
mkdir -p database && touch database/database.sqlite

# Windows (PowerShell)
New-Item -ItemType File -Path database/database.sqlite -Force
```

For MySQL or PostgreSQL, set `DB_*` in `.env` accordingly.

**4. Migrations**

```bash
php artisan migrate
```

This creates: `users`, `password_reset_tokens`, `sessions`, `agents`, `properties`, `blogs`, `testimonials`, `contacts`, `newsletter_subscribers`, and related tables.

**5. Seed demo data**

```bash
php artisan db:seed
```

This seeds a default user (`test@example.com`), demo agents, properties, blog posts, and testimonials. To run individual seeders:

```bash
php artisan db:seed --class=AgentSeeder
php artisan db:seed --class=PropertySeeder
php artisan db:seed --class=BlogSeeder
php artisan db:seed --class=TestimonialSeeder
```

**6. Frontend assets**

```bash
npm run build
```

For development with hot reload:

```bash
npm run dev
```

**7. Run the application**

```bash
php artisan serve
```

Open **http://localhost:8000** in your browser.

### Optional

- **Laravel Breeze** — `php artisan breeze:install blade` (or react/vue) for login/register UI.
- **Spatie Permission** — `php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"` then `php artisan migrate` if using roles.
- **Storage link** — `php artisan storage:link` for uploads under `storage/app/public`.
- **Placeholder images** — Add `hero-bg.jpg`, `property-placeholder.jpg`, `blog-placeholder.jpg`, `default-avatar.jpg`, `favicon.ico` under `public/assets/images/` as needed.

---

## 5. Routing & Endpoints

### Public routes

| Method | Path | Description |
|--------|------|-------------|
| GET | `/` | Home |
| GET | `/about` | About page |
| GET | `/services` | Services page |
| GET | `/properties` | Property listing (filters, sort) |
| GET | `/properties/type/{type}` | Properties by type (JSON) |
| GET | `/properties/{slug}` | Property detail |
| GET | `/agents` | Agent listing |
| GET | `/agents/{slug}` | Agent detail |
| GET | `/blog` | Blog listing |
| GET | `/blog/category/{category}` | Blog by category |
| GET | `/blog/{slug}` | Blog post |
| GET | `/contact` | Contact form |
| POST | `/contact` | Submit contact |

### Frontend API (AJAX)

| Method | Path | Description |
|--------|------|-------------|
| POST | `/api/frontend/property/wishlist/{property}` | Toggle wishlist (session) |
| POST | `/api/frontend/property/contact/{property}` | Property inquiry |
| POST | `/api/frontend/contact/property-inquiry` | Generic property inquiry |
| GET | `/api/frontend/search/suggestions` | Property search suggestions (JSON) |
| POST | `/api/frontend/newsletter/subscribe` | Newsletter subscribe |

### SEO

- `GET /sitemap.xml` — XML sitemap
- `GET /robots.txt` — Robots rules

### Admin (authenticated)

- `GET /admin` — Dashboard
- Resource routes for `properties`, `agents`, `blogs`
- `GET /admin/contacts` — Contact inquiries

---

## 6. Project Structure

```
E-STATE/
├── app/
│   ├── Http/Controllers/
│   │   ├── Frontend/    # Home, Property, Agent, Blog, Contact
│   │   └── Admin/      # Dashboard, Property, Agent, Blog, Contact
│   ├── Models/         # User, Agent, Property, Blog, Testimonial, Contact, NewsletterSubscriber
│   └── Http/Requests/
├── database/
│   ├── migrations/     # users, agents, properties, blogs, testimonials, contacts, newsletter_subscribers
│   └── seeders/        # AgentSeeder, PropertySeeder, BlogSeeder, TestimonialSeeder
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   ├── frontend/pages/      # home, about, services, properties, property-single, agents, agent-single, blog, blog-single, contact
│   │   ├── frontend/components/ # property-card, agent-card, testimonial, navbar, footer
│   │   └── admin/
│   ├── css/
│   └── js/
├── routes/web.php
├── vite.config.js
├── composer.json
└── package.json
```

---

## 7. Portfolio & Business Use

### Why it works for portfolios

- End-to-end flows: listings, filters, detail pages, contact and inquiry persistence, wishlist, newsletter.
- Clear domain model and relationships; form validation; reusable Blade components.
- Modern UI (Bootstrap 5 + Tailwind 4), responsive layout, and basic SEO (sitemap, robots.txt).

### How to present it

- *"Full-stack real estate platform built with Laravel 12, Blade, Tailwind, Bootstrap, and Vite."*
- *"Implements property and agent listings, blog, testimonials, contact and inquiry handling, and an admin panel for content management."*
- *"Includes filters, search suggestions, wishlist, and newsletter subscription."*

Consider adding screenshots (home, properties, property detail, agents, blog, contact) and a short video walkthrough.

### Possible extensions

- Role-based admin access with Spatie Permission.
- Image upload and management for properties and agents (`storage:link`).
- Full-text or external search (e.g. Meilisearch).
- API versioning and documentation (e.g. Swagger/OpenAPI).
- Automated tests (feature and unit).

---

## 8. License

This project is based on the Laravel framework and is licensed under the **MIT License**.
