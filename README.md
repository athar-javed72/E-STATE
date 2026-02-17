# E-STATE (FindState)

**Modern Real Estate Listing & Lead Generation Platform (Laravel 12)**

E-STATE (brand: **FindState**) is a full‑stack real estate web application where users can browse properties for sale or rent, discover featured agents, read market insights on the blog, and submit inquiries or contact requests. It is designed to be a **portfolio‑ready** project that showcases professional Laravel, Blade, and modern frontend skills.

---

## 1. Project Overview

**What this project does**

- **Public website**
  - Home page with hero section, stats, featured properties, top agents, testimonials, and latest blog posts
  - SEO‑friendly static pages: About, Services, Contact
  - Property listing with filters (type, listing type, price range, bedrooms, location, sort)
  - Property detail page with agent info, key features, and related properties
  - Agents listing and individual agent profile with their active listings
  - Blog listing page, category filtering, search, and blog detail pages
  - Contact form with validation and persistence
  - Basic sitemap (`/sitemap.xml`) and robots.txt

- **Interactive features**
  - Session‑based property wishlist toggle (no auth required)
  - Property contact / inquiry (saved as `contacts` records)
  - Search suggestions endpoint for property auto‑complete
  - Newsletter subscription with subscriber storage

This setup is ideal for a **portfolio** because it demonstrates:

- Complete frontend UX (modern, responsive UI)
- Realistic data modelling (properties, agents, testimonials, blog)
- REST‑style endpoints and AJAX‑friendly routes
- Basic SEO and content structure

---

## 2. Tech Stack

| Layer              | Technology                                  |
|--------------------|----------------------------------------------|
| **Backend**        | PHP 8.2+, Laravel 12                        |
| **Frontend**       | Blade templates, Bootstrap 5, Tailwind CSS 4, jQuery |
| **Build Tools**    | Vite 6, Laravel Vite Plugin                 |
| **Database**       | SQLite (default), MySQL/PostgreSQL compatible |
| **Auth & Roles**   | Laravel Breeze (available), Spatie Laravel Permission (package installed, hooks ready) |
| **HTTP Client**    | Axios (prepared for AJAX)                   |
| **Testing & Dev**  | PHPUnit, Laravel Pail, Laravel Pint, Faker, Laravel Sail (optional) |

---

## 3. Features & Domain Model

**Core entities**

- `User` – standard Laravel user (ready for Breeze auth)
- `Agent` – name, slug, contact info, avatar, bio, social links, experience, rating, status
- `Property` – belongs to an `Agent`, includes:
  - Title, slug, description, address, city, state, zip
  - Type (house, apartment, condo, villa)
  - Listing type (for_sale, for_rent)
  - Price, bedrooms, bathrooms, area (sqft), parking
  - Featured image, optional gallery, featured flag, views counter, status
- `Blog` – title, slug, category, excerpt, content (HTML), featured image, author, views, status
- `Testimonial` – client name, designation, location, image, content, rating, status
- `Contact` – general and property inquiries:
  - `property_id` (nullable), name, email, phone, subject, message, type, status
- `NewsletterSubscriber` – email + active flag

**Key frontend pages**

- `Home` – hero, search, featured properties, why‑choose‑us, top agents, testimonials slider, latest blog posts, CTA
- `About` – company story, mission, values, team highlights, testimonials
- `Services` – buying, selling, renting, property management, investment consulting
- `Properties` – grid listing with filters and sorting; uses reusable `property-card` component
- `Property Detail` – full info, agent panel, related properties
- `Agents` – grid of agents
- `Agent Detail` – agent bio + their active listings
- `Blog` – posts with search, category list, and recent posts sidebar
- `Blog Detail` – full article, featured image, related posts
- `Contact` – contact form with server‑side validation and flash messages

---

## 4. Installation & Local Setup

### 4.1 Prerequisites

- **PHP** 8.2+ with common Laravel extensions (BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML)
- **Composer**
- **Node.js** 18+ and **npm**
- **Database**: SQLite (default) or MySQL/PostgreSQL

### 4.2 Clone & install dependencies

```bash
git clone <your-repo-url> E-STATE
cd E-STATE

composer install
npm install
```

### 4.3 Environment configuration

```bash
cp .env.example .env
php artisan key:generate
```

**Using SQLite (default in `.env.example`):**

```bash
mkdir -p database
type NUL > database/database.sqlite  # Windows PowerShell
```

Or switch `.env` to MySQL/PostgreSQL and update `DB_*` values.

### 4.4 Run migrations

```bash
php artisan migrate
```

This creates all core tables:

- `users`, `password_reset_tokens`, `sessions`
- `agents`, `properties`, `blogs`, `testimonials`, `contacts`
- `newsletter_subscribers`

### 4.5 Seed demo data (for portfolio screenshots)

```bash
php artisan db:seed --class=AgentSeeder
php artisan db:seed --class=PropertySeeder
php artisan db:seed --class=BlogSeeder
php artisan db:seed --class=TestimonialSeeder
```

This will create:

- 4 demo agents
- 8 realistic properties across multiple cities and types
- 5 blog posts in different categories
- 5 client testimonials

> Note: `DatabaseSeeder` also creates a default user `test@example.com`. If you run `php artisan db:seed` without specifying a class more than once on SQLite, you may hit the unique constraint on `users.email`. Use the specific seeders above to avoid duplication.

### 4.6 Build frontend assets

```bash
npm run build
```

For development with hot reloading:

```bash
npm run dev
```

### 4.7 Start the application

```bash
php artisan serve
```

Visit: `http://localhost:8000`

---

## 5. Routing & Endpoints

**Public web routes (`routes/web.php`):**

- **Home & static pages**
  - `GET /` → `HomeController@index`
  - `GET /about` → `HomeController@about`
  - `GET /services` → `HomeController@services`

- **Properties**
  - `GET /properties` → `PropertyController@index` (filters & sorting)
  - `GET /properties/type/{type}` → `PropertyController@getByType` (JSON)
  - `GET /properties/{slug}` → `PropertyController@show`

- **Agents**
  - `GET /agents` → `AgentController@index`
  - `GET /agents/{slug}` → `AgentController@show`

- **Blog**
  - `GET /blog` → `BlogController@index`
  - `GET /blog/category/{category}` → `BlogController@category`
  - `GET /blog/{slug}` → `BlogController@show`

- **Contact**
  - `GET /contact` → `ContactController@index`
  - `POST /contact` → `ContactController@store`

- **AJAX / mini‑API (frontend)**
  - `POST /api/frontend/property/wishlist/{property}` → toggle property wishlist (session)
  - `POST /api/frontend/property/contact/{property}` → submit property inquiry
  - `POST /api/frontend/contact/property-inquiry` → generic property inquiry endpoint
  - `GET /api/frontend/search/suggestions` → property search suggestions (JSON)
  - `POST /api/frontend/newsletter/subscribe` → newsletter subscription

- **SEO**
  - `GET /sitemap.xml` → simple XML sitemap view
  - `GET /robots.txt` → static robots rules

---

## 6. How “Portfolio‑Ready” It Is

The project is now structured and implemented so you can confidently add it to your portfolio:

- **End‑to‑end flow**
  - Realistic sample data for properties, agents, blog posts, testimonials
  - Fully wired listing and detail pages
  - Working filters and sorting on the properties page
  - Contact and inquiry flows that persist to the database
  - Basic wishlist behavior that can easily be upgraded to a persistent user wishlist later

- **Code quality**
  - Separate models for each domain concept with proper relationships
  - Request validation for key forms (contact, property inquiry, property store request)
  - Clean route definitions with consistent naming
  - Reusable Blade components (`property-card`, `agent-card`, `testimonial`, `navbar`, `footer`)

- **Design & UX**
  - Modern layout with Bootstrap 5 + Tailwind 4 utility layers
  - Responsive design, hero section, statistics, and CTA sections
  - Animated testimonials slider and subtle hover states
  - Sensible fallbacks and placeholders for missing images (SVG placeholders)

To push it even further for a senior‑level portfolio, you can optionally add:

- A secured **admin panel** with Breeze authentication, role‑based access via Spatie Permission, and CRUD for properties/agents/blogs
- Image upload & management for property and agent avatars (backed by `storage:link`)
- More advanced search (e.g. full‑text or Algolia/Meilisearch)
- API versioning and external API documentation (Swagger/OpenAPI)

---

## 7. How to Present This Project in Your Portfolio

When you showcase this project, you can highlight:

- **“Full‑stack real estate platform built with Laravel 12, Blade, Tailwind, Bootstrap, and Vite.”**
- **“Implements realistic domain models (Property, Agent, Blog, Testimonials, Contacts, Newsletter).”**
- **“Includes filters, search suggestions, wishlist, and inquiry flows to simulate a production‑ready experience.”**
- **“SEO‑friendly structure with sitemap, robots.txt, and optimized meta tags.”**

Consider adding:

- Screenshots of the home page, property listing, property detail, agents, blog, and contact pages
- A short Loom or YouTube walkthrough where you navigate the site and explain the architecture at a high level

---

## 8. License

This project is based on the Laravel skeleton and is licensed under the **MIT License**.

# E-STATE (FindState)

**Real Estate Property Listing & Management Web Application**

A Laravel-based real estate platform where users can browse properties for sale/rent, view agent profiles, read blog posts, and submit contact inquiries. Built with Laravel 12, Tailwind CSS, and Bootstrap for a modern, responsive UI.

---

## Project Purpose (پروجیکٹ کا مقصد)

یہ پروجیکٹ **ریئل اسٹیٹ (پراپرٹی لسٹنگ)** ویب سائٹ کے لیے ہے۔ اس کا مقصد:

- **صارفین:** پراپرٹیز براؤز کرنا، فلٹر/سرچ، ایجنٹس دیکھنا، بلاگ پڑھنا، اور رابطہ فارم بھیجنا
- **ایجنٹس/ایڈمن:** پراپرٹیز، بلاگ، اور ایجنٹس کا انتظام (ادارہ) کرنا (جیسے کہ مستقبل میں ایڈمن پینل مکمل ہونے پر)

یہ ایک **پورٹ فولیو/سیلنگ پروجیکٹ** کے طور پر استعمال ہو سکتا ہے جو آپ کے Laravel، PHP، اور فرنٹ اینڈ اسکلز کو دکھاتا ہے۔

---

## Tech Stack (استعمال ہونے والے اسٹیک)

| Layer | Technology |
|--------|------------|
| **Backend** | PHP 8.2+, Laravel 12 |
| **Frontend** | Blade templates, Bootstrap 5, Tailwind CSS 4, jQuery |
| **Build** | Vite 6, Laravel Vite Plugin |
| **Database** | SQLite (default), MySQL/PostgreSQL supported |
| **Auth & Permissions** | Laravel Breeze (ready), Spatie Laravel Permission |
| **HTTP Client** | Axios |
| **Testing** | PHPUnit, Laravel Pail |
| **Dev Tools** | Laravel Pint, Faker, Sail (optional) |

---

## Current Status: Incomplete (حالت: ادھورا)

پروجیکٹ **ادھورا** ہے۔ مندرجہ ذیل چیزیں **بنائی نہیں گئیں** یا **نامکمل** ہیں:

### موجود اور کام کرنے والا
- Laravel 12 سیٹ اپ، routing، frontend controllers (Home, Property, Agent, Blog, Contact)
- فرنٹ اینڈ صفحات: Home, About, Services
- فرنٹ اینڈ کمپوننٹس: navbar, footer, property-card, agent-card, testimonial
- Layout: `layouts/app.blade.php` (اب ٹھیک کر دیا گیا)
- SEO/utility routes: sitemap, robots.txt
- API routes (wishlist, contact agent, search suggestions, newsletter) — لیکن ان کے controller methods ابھی لکھے نہیں گئے

### جو ابھی نہیں ہے / غائب
1. **Models:** صرف `User` ہے۔ `Property`, `Agent`, `Blog`, `Testimonial`, `Contact` **models نہیں بنے**
2. **Migrations:** صرف users, cache, jobs۔ properties, agents, blogs, testimonials, contacts کی **migrations نہیں**
3. **Views:** یہ صفحات **نہیں بنے:**  
   `properties` (listing), `property-single`, `agents`, `agent-single`, `blog`, `blog-single`, `contact`
4. **Admin Panel:**  
   - Admin routes (login/dashboard) **نہیں جوڑے گئے**  
   - Admin controllers (Dashboard, Property, Agent, Blog) **خالی** ہیں  
   - Admin views صرف header/footer layout ہیں
5. **API methods:**  
   `toggleWishlist`, `contactAgent`, `searchSuggestions`, `newsletterSubscribe` routes پر ہیں لیکن **controllers میں ان کے methods نہیں**
6. **Form Request:** `StorePropertyRequest` میں rules خالی ہیں
7. **Assets:** `public/assets/images/` (hero-bg, placeholders, favicon) اور `uploads/` ڈائریکٹریز دستی بنانی/ڈالنی ہوں گی

اس لیے ابھی **ہوم پیج چلانے پر بھی Property/Agent/Blog/Testimonial models نہ ہونے کی وجہ سے error آئے گا** جب تک آپ یہ models اور migrations نہیں بنا لیتے۔

---

## Installation (انسٹالیشن)

### ضروریات
- **PHP** ≥ 8.2 (extensions: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML)
- **Composer**
- **Node.js** (v18+ recommended) اور **npm**
- **SQLite** (یا MySQL/PostgreSQL)

### قدم بہ قدم

1. **ریپو کلون کریں اور ڈائریکٹری میں جائیں**
   ```bash
   git clone <repo-url> E-STATE
   cd E-STATE
   ```

2. **PHP dependencies**
   ```bash
   composer install
   ```

3. **Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   SQLite استعمال کریں تو:
   ```bash
   touch database/database.sqlite
   ```
   یا `.env` میں MySQL/PostgreSQL credentials ڈالیں۔

4. **ڈیٹا بیس مائگریشن**
   ```bash
   php artisan migrate
   ```
   **نوٹ:** جب تک `properties`, `agents`, `blogs`, `testimonials`, `contacts` کی migrations نہیں بنائیں گے، صرف `users`, `cache`, `jobs` tables بنیں گی۔ ہوم پیج چلانے کے لیے ان tables اور models کا اضافہ ضروری ہے۔

5. **Spatie Permission (پہلی بار)**
   ```bash
   php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
   php artisan migrate
   ```

6. **Node dependencies اور فرنٹ اینڈ بیلڈ**
   ```bash
   npm install
   npm run build
   ```
   ڈیولپمنٹ میں ہاتھ سے چلانے کے لیے:
   ```bash
   npm run dev
   ```

7. **ایپ چلائیں**
   ```bash
   php artisan serve
   ```
   براؤزر میں: `http://localhost:8000`

   یا Composer script (سرور + queue + logs + Vite):
   ```bash
   composer dev
   ```

### جو اور انسٹال کرنا چاہیے (اختیاری لیکن مفید)

- **Laravel Breeze** (اگر login/register UI چاہیے):  
  `composer require laravel/breeze --dev` پہلے سے ہے؛  
  `php artisan breeze:install blade` (یا react/vue) چلا کر auth scaffolding لے سکتے ہیں۔
- **Image placeholders / اپلوڈز:**  
  `public/assets/images/` میں `hero-bg.jpg`, `property-placeholder.jpg`, `blog-placeholder.jpg`, `default-avatar.jpg`, `favicon.ico`, `og-default.jpg` رکھیں تاکہ تصاویر ٹوٹی نہ دکھیں。
- **Storage link:**  
  `php artisan storage:link` اگر اپلوڈز `storage/app/public` استعمال کریں گے۔

---

## Project Structure (اہم فائلیں)

```
E-STATE/
├── app/
│   ├── Http/Controllers/
│   │   ├── Frontend/     # Home, Property, Agent, Blog, Contact
│   │   └── Admin/        # Dashboard, Property, Agent, Blog (خالی)
│   ├── Models/           # صرف User (Property, Agent, Blog, Testimonial, Contact غائب)
│   └── Http/Requests/    # StorePropertyRequest (خالی rules)
├── database/
│   ├── migrations/       # users, cache, jobs (باقی tables نہیں)
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── layouts/app.blade.php
│   │   ├── frontend/pages/   # home, about, services (باقی pages نہیں)
│   │   └── frontend/components/
│   ├── css/app.css       # Tailwind
│   └── js/app.js
├── routes/web.php        # سب frontend routes + API routes
├── vite.config.js
├── composer.json
└── package.json
```

---

## Portfolio ke liye Professional Banana (پورٹ فولیو کے لیے کیا اضافے کریں)

ان چیزوں کو مکمل/اضافہ کرنے سے پروجیکٹ **پورٹ فولیو کے لیے زیادہ پیشہ ور** لگے گا:

1. **Models + Migrations + Seeders**
   - `Property`, `Agent`, `Blog`, `Testimonial`, `Contact` models اور migrations
   - Factories/Seeders سے sample data (کم از کم 10–20 properties, 4–5 agents, 5–10 blog posts, testimonials)

2. **غائب Frontend Pages**
   - Properties listing (`properties.index`), property single, agents list, agent single
   - Blog listing اور blog single
   - Contact page (form + thank you / validation messages)

3. **Admin Panel (کم از کم بنیادی)**
   - Breeze سے login/register، پھر admin routes `middleware('auth')` سے محفوظ
   - Dashboard: simple stats (total properties, agents, contacts)
   - CRUD: Properties (create/edit/delete, image upload), Agents, Blog posts
   - Spatie Permission: admin vs agent roles

4. **API / AJAX**
   - `toggleWishlist` (اگر wishlist table بنائیں), `contactAgent`, `searchSuggestions`, `newsletterSubscribe` کو controllers میں implement کریں
   - Optional: REST/API version for properties (صرف read) تاکہ “API بھی بنایا” دکھے

5. **UX & Polish**
   - Property search/filters (قیمت، بیڈروم، شہر) — logic تو controller میں ہے، UI کو filters سے جوڑیں
   - Image upload (properties, agents, blog) + thumbnails یا resize
   - Pagination اور “no results” messages
   - Contact form پر success/error فلاش اور optional email (Mail)

6. **SEO & Performance**
   - ہر property/blog page پر unique meta title, description
   - Sitemap میں dynamic URLs (properties, blog posts)
   - Optional: caching (property listing), image lazy loading (پہلے سے کچھ views میں ہے)

7. **Testing**
   - Feature tests: home page 200, property list 200, contact form submit
   - Optional: Unit tests for Property/Agent model scopes

8. **Documentation**
   - README میں “How to run” اور “What’s implemented” (یہ README اس کا آغاز ہے)
   - Optional: `.env.example` میں ضروری keys کی مختصر وضاحت

انہیں ترتیب سے مکمل کرنے سے **E-STATE** ایک مضبوط، دکھانے کے قابل **پورٹ فولیو پراجیکٹ** بن جائے گا۔

---

## License

MIT (جیسا کہ Laravel skeleton).
