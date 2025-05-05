# Reservation System API

## 📖 Overview

This project is a service reservation system built with Laravel using the MVC pattern and API.
It lets users sign up, log in, and book services like coaching or repair.
Users can also manage their reservations and cancel them if the reservation time hasn’t passed yet.
Admins have a secure dashboard to manage services and see all reservations.
The API is protected using Laravel Sanctum, and everything is documented with Swagger.
You can explore the API at:
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
   git clone https://github.com/ahmedham/reservation-system.git
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

- User dashboard login:

  - **Email**: `user@test.com`
  - **Password**: `password`

## 📌 Future Improvements

- **Email and SMS Notifications**  
  This helps users remember their bookings and reduces missed appointments. It makes the system easier and more helpful for real people to use.


## License
This project is open-sourced under the MIT license. See the LICENSE file for more information.

