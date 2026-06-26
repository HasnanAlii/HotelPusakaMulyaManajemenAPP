# Hotel Pusaka Mulya Management App

Hotel Pusaka Mulya Management App is a Laravel-based hotel operations system designed to help hotel staff manage rooms, reservations, customers, employees, maintenance, gallery content, and financial reporting from one web application.

The application includes a public-facing hotel page with room reservation flow and an authenticated back-office dashboard for daily hotel administration.

## Features

- Public hotel landing page and gallery content.
- Customer registration and online room booking.
- Reservation verification, rejection, check-in, and checkout workflows.
- Single-room and multiple-room check-in support.
- Room management with availability status, category, bed type, facilities, and pricing.
- Room import support using Excel files.
- Customer data management, including inactive customer cleanup.
- Employee management with attendance and incentive handling.
- Maintenance tracking for damaged rooms and repair cost estimation.
- Expense and income recording.
- Finance dashboard with daily and monthly filters.
- PDF financial report generation.
- Fuzzy-based room recommendation and configurable fuzzy settings.
- Authentication, profile management, role-based access, and permissions.

## Tech Stack

- **Backend:** PHP 8.2+, Laravel 12
- **Frontend:** Blade, Tailwind CSS, Alpine.js, Vite
- **Database:** MySQL
- **Authentication:** Laravel Breeze
- **Authorization:** Spatie Laravel Permission
- **PDF Reports:** barryvdh/laravel-dompdf
- **Excel Import:** maatwebsite/excel
- **Testing:** Pest / Laravel Test Suite

## Main Modules

| Module | Description |
| --- | --- |
| Rooms | Manage hotel rooms, status, pricing, facilities, categories, and Excel imports. |
| Reservations | Handle bookings, check-ins, multi-room check-ins, verification, rejection, and old reservation cleanup. |
| Customers | Store guest identity, phone, vehicle number, and customer records. |
| Employees | Manage employee data, attendance, and incentive payments. |
| Maintenance | Track room damage, repair status, related customer/employee, estimated cost, and repair details. |
| Expenses | Record operational expenses and maintenance-related costs. |
| Finances | Track income and expenses, calculate balances, filter reports, and export PDF reports. |
| Gallery | Manage public gallery images and captions. |
| Fuzzy Recommendation | Recommend rooms based on configurable price, facilities, comfort, and guest-count criteria. |
| Auth & Roles | Login, registration, profile management, admin role, receptionist role, and permissions. |

## Requirements

Make sure your local machine has:

- PHP 8.2 or newer
- Composer
- Node.js and npm
- MySQL or MariaDB
- PHP extensions commonly required by Laravel, including `openssl`, `pdo`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `fileinfo`, `gd`, and `zip`

## Installation

Clone the repository and enter the project directory:

```bash
git clone <repository-url>
cd HotelPusakaMulyaManajemenAPP
```

Install PHP dependencies:

```bash
composer install
```

Install JavaScript dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Create a MySQL database, then update the database section in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hotel_pusaka_mulya
DB_USERNAME=root
DB_PASSWORD=
```

Run database migrations and seed the initial data:

```bash
php artisan migrate --seed
```

Create the public storage symlink for uploaded files such as transfer proof images:

```bash
php artisan storage:link
```

Build frontend assets for development:

```bash
npm run dev
```

In another terminal, start the Laravel development server:

```bash
php artisan serve
```

Open the application in your browser:

```text
http://127.0.0.1:8000
```

## Optional Development Command

The project includes a Composer development script that can run the Laravel server, queue listener, log viewer, and Vite development server together:

```bash
composer run dev
```

Use this command when you want a complete local development environment in one process.

## Default Seeded Accounts

After running `php artisan migrate --seed`, the application creates these users:

| Role | Email | Password |
| --- | --- | --- |
| Admin | `admin@gmail.com` | `password` |
| Receptionist | `kasir@gmail.com` | `password` |

The admin user has full permissions. The receptionist user is configured for reservation-related access.

## Common Workflows

### Public Reservation Flow

1. A guest opens the public hotel page.
2. The guest selects a room and fills in reservation/customer information.
3. The reservation is saved with booking status.
4. Staff verifies or rejects the booking from the authenticated dashboard.
5. Verified bookings are converted into active check-ins and recorded in finance.

### Direct Check-In Flow

1. Staff logs in to the dashboard.
2. Staff opens the room list and selects an available room.
3. Staff chooses a customer and check-in/check-out date.
4. The room status changes to occupied.
5. A finance record is automatically created based on room price and stay duration.

### Finance Reporting Flow

1. Income is created automatically from verified reservations or manually from the finance page.
2. Expenses are recorded from the expense and maintenance workflows.
3. Staff filters finance data daily or monthly.
4. Staff exports a PDF report from the finance page.

## Project Structure

```text
app/
  Http/Controllers/     Application controllers for hotel modules
  Models/               Eloquent models
  Imports/              Excel import classes
database/
  migrations/           Database schema definitions
  seeders/              Initial sample data and default users
public/
  assets/               Public images and hotel assets
resources/
  css/                  Tailwind application styles
  js/                   Vite and Alpine entry points
  views/                Blade templates
routes/
  web.php               Web routes and module route definitions
  auth.php              Authentication routes
tests/
  Feature/              Feature tests
  Unit/                 Unit tests
```

## Useful Commands

Run tests:

```bash
php artisan test
```

Clear cached configuration:

```bash
php artisan optimize:clear
```

Run migrations from scratch with seeders:

```bash
php artisan migrate:fresh --seed
```

Build frontend assets for production:

```bash
npm run build
```

## Environment Notes

- `SESSION_DRIVER=database`, `CACHE_STORE=database`, and `QUEUE_CONNECTION=database` are configured in `.env.example`, so the related Laravel tables must exist. They are included in the migrations.
- Uploaded reservation transfer proofs are stored on the `public` disk. Run `php artisan storage:link` before using upload previews in the browser.
- PDF report generation depends on DOMPDF. If PDF export fails, confirm the package is installed and the required PHP extensions are enabled.
- Excel room import depends on the `zip` PHP extension and the `maatwebsite/excel` package.

## License

This project is built with Laravel and follows the license terms defined by the repository owner.
