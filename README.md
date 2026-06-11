<p align="center">
  <img src="https://img.shields.io/badge/license-MIT-blue.svg" alt="License">
  <img src="https://img.shields.io/badge/Laravel-13.x-red.svg" alt="Laravel">
  <img src="https://img.shields.io/badge/Livewire-3.x-pink.svg" alt="Livewire">
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-06B6D4.svg" alt="TailwindCSS">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4.svg" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1.svg" alt="MySQL">
  <img src="https://img.shields.io/badge/Docker-ready-2496ED.svg" alt="Docker">
</p>

# Open Invoice Manager

Free, open-source, self-hosted invoice and quote management application for freelancers and small businesses. Built with Laravel.

**Repository:** [github.com/mchtylmz/open-invoice-manager](https://github.com/mchtylmz/open-invoice-manager)

**Author:** [LinkedIn](https://www.linkedin.com/in/mmucahityilmazz/)

## Features

- Customer management (CRUD)
- Product/service catalog
- Quote creation with PDF export
- Invoice creation with PDF export
- Tax/VAT settings
- Multi-currency support
- Payment status tracking
- Company profile settings
- Dashboard with statistics
- Search and filtering
- Docker support
- Demo data seeder

## Tech Stack

- **Laravel** (latest stable)
- **Livewire**
- **TailwindCSS**
- **MySQL / MariaDB**
- **Redis**
- **DomPDF**

## Installation

### Docker (Recommended)

```bash
docker-compose up -d
docker-compose exec app php artisan migrate --seed
```

Access at http://localhost:8080

### Manual Installation

```bash
cp .env.example .env
# Edit .env with your database credentials
composer install
npm install && npm run build
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

### Demo Credentials

- **Email:** admin@example.com
- **Password:** password

## Screenshots

| Dashboard | Customers |
|:---------:|:---------:|
| ![Dashboard](docs/screenshots/dashboard.svg) | ![Customers](docs/screenshots/customers.svg) |

| Invoices | Invoice Detail |
|:--------:|:--------------:|
| ![Invoices](docs/screenshots/invoices.svg) | ![Invoice Detail](docs/screenshots/invoice-detail.svg) |

| Invoice PDF | Settings |
|:-----------:|:--------:|
| ![Invoice PDF](docs/screenshots/invoice-pdf.svg) | ![Settings](docs/screenshots/settings.svg) |

## PDF Export

Invoices and quotes can be exported as PDF from their detail pages. The export uses DomPDF and produces print-friendly layouts.

## License

MIT
