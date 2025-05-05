# Reservation System API

## 📖 Overview

This is a Reservation System API built with Laravel. It allows users to register, log in, and book services. Admins can manage services and reservations through a secure dashboard. The API is protected using Laravel Sanctum for authentication, and the documentation is available via Swagger at:
[http://localhost:8000/api/documentation](http://localhost:8000/api/documentation)

Key features include:
- User registration and login with token-based authentication
- Service listing and reservation management
- Admin dashboard access with credentials
- Full OpenAPI (Swagger) documentation for all endpoints

---

## ⚙️ Setting Up the Application

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/reservation-system.git
   cd reservation-system
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure the environment**
   - Copy `.env.example` to `.env`
   - Set up database and other credentials
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Run migrations and seeders**
   ```bash
   php artisan migrate --seed
   ```

5. **Start the server**
   ```bash
   php artisan serve
   ```

## Running the Application

- Visit the app at: `http://localhost:8000`
- Access Swagger docs: `http://localhost:8000/api/documentation`

- Admin dashboard login:

  - **Email**: `admin@test.com`
  - **Password**: `password`

## License
This project is open-sourced under the MIT license. See the LICENSE file for more information.

