# Rejagone Service API

REST API backend untuk sistem booking barbershop menggunakan Laravel dan MySQL.

## Features

- Master Data Service
  - CRUD Services
  - CRUD Barbers

- Booking Service
  - View schedules
  - Create booking
  - View booking detail
  - Delete booking

- Payment Service
  - Create payment
  - Validate payment
  - Update booking status

---

# Tech Stack

- Laravel 13
- PHP 8.3+
- MySQL 8+
- Composer 2+
- Git & GitHub

---

# Clone Repository

```bash
git clone https://github.com/USERNAME/rejagone-service-api.git
```

Masuk ke folder project:

```bash
cd rejagone-service-api
```

---

# Install Dependencies

```bash
composer install
```

---

# Setup Environment

Copy file environment:

## Windows CMD

```bash
copy .env.example .env
```

## Git Bash

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

---

# Setup Database

Buat database MySQL baru:

```text
rejagone_service_api
```

Lalu edit file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rejagone_service_api
DB_USERNAME=root
DB_PASSWORD=
```

---

# Run Migration

```bash
php artisan migrate
```

---

# Run Server

```bash
php artisan serve
```

Server akan berjalan di:

```text
http://127.0.0.1:8000
```

---

# Git Collaboration Rules

## Jangan langsung commit ke main

Gunakan branch masing-masing:

```bash
git checkout -b feature/nama-fitur
```

Contoh:

```bash
git checkout -b feature/booking-api
```

---

# Pull Latest Changes

Sebelum mulai ngoding:

```bash
git pull origin main
```

---

# Push Branch

```bash
git add .
git commit -m "Add booking API"
git push origin feature/booking-api
```

---

# API Endpoints

## Services

| Method | Endpoint | Description |
|---|---|---|
| GET | /api/services | Get all services |
| POST | /api/services | Create service |
| PUT | /api/services/{id} | Update service |
| DELETE | /api/services/{id} | Delete service |

---

## Barbers

| Method | Endpoint | Description |
|---|---|---|
| GET | /api/barbers | Get all barbers |
| POST | /api/barbers | Create barber |
| PUT | /api/barbers/{id} | Update barber |
| DELETE | /api/barbers/{id} | Delete barber |

---

## Bookings

| Method | Endpoint | Description |
|---|---|---|
| GET | /api/bookings | Get all bookings |
| POST | /api/bookings | Create booking |
| GET | /api/bookings/{id} | Booking detail |
| DELETE | /api/bookings/{id} | Delete booking |

---

## Payments

| Method | Endpoint | Description |
|---|---|---|
| GET | /api/payments | Get payments |
| POST | /api/payments | Create payment |

---

# Booking Status Flow

```text
need_payment -> paid -> completed
```

---

# Contributors

- Fahmi
- Team Members