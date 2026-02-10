# Laravel Hotels Map Application

An interactive web application that displays nearby hotels on a map using geolocation and external APIs.

---

## Features

- User Registration & Login (Laravel Breeze)
- Interactive map showing nearby hotels
- Browser-based geolocation permission
- Nearby hotels calculation using Haversine formula
- Filter hotels by city and star rating
- Search hotels by name
- External hotel data fetched from Geoapify Places API
- Automatic syncing and caching in local database

---

## Tech Stack

- Laravel 12
- Blade Templates
- Vanilla JavaScript
- Leaflet JS
- SQLite / MySQL
- Geoapify Places API

---

## Installation & Setup

### 1️⃣ Clone Repository

```bash
git clone https://github.com/Mohannad7Ali/LaravelHotels.git
cd map-auth-project
```

### 2️⃣ Install PHP Dependencies

```bash
composer install
```

### 3️⃣ Install Node Dependencies & Build Assets

```bash
npm install
npm run dev
```

### 4️⃣ Configure Environment

Copy .env.example:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Configure database in .env:

```bash
DB_CONNECTION=mysql
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=
```

Add your Geoapify API key:

```bash
GEOAPIFY_KEY=your_geoapify_api_key_here
```

### 5️⃣ Run Migrations & Seed Database

```bash
php artisan migrate --seed
```

### 6️⃣ Start Laravel Server

```bash
php artisan serve
```

### 7️⃣ Open Application

Open in browser:

```bash
http://127.0.0.1:8000
```

Register / Login
Access the interactive map at:

```bash
http://127.0.0.1:8000/map
```

## Architecture

- MVC architecture with Service Layer
- Lightweight controllers focused on request handling
- Business logic implemented inside `HotelService`
- Form Requests used for input validation
- Integration between external APIs and local database caching
- Blade templates combined with Vanilla JavaScript for UI
- Client-side filtering and searching for better performance

---

## How Geoapify Integration Works

1. User opens the map page
2. Browser requests geolocation permission
3. User location coordinates are obtained
4. `HotelService` calls the Geoapify Places API
5. Nearby hotels are fetched within the specified radius
6. Retrieved data is cached in the database for 5 minutes
7. Hotels are displayed on the Leaflet map using markers
8. Users can filter and search results in real time
