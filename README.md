# Laravel URL Shortener

A custom Laravel-based URL shortener application to create, manage, and track shortened URLs effortlessly. This project allows users to generate short, shareable links and provides analytics for tracking usage.

---

## Features

- **Custom URL Shortening**: Generate unique short URLs for your links.
- **Analytics Dashboard**: Track click counts and user engagement.
- **Expiration Options**: Set expiration dates for shortened URLs.
- **Responsive Design**: Works seamlessly on both desktop and mobile devices.
- **Secure**: CSRF protection, user authentication and management.

---

## Requirements

Before starting, ensure you have the following installed on your system:

- PHP >= 8.1
- Composer
- Laravel >= 10
- MySQL or SQLite
- Node.js & npm (for front-end assets)

---

## Installation

Follow these steps to set up the application:

1. **Clone the Repository**

   ```bash
   git clone https://github.com/fiatsi-etse/laravel-url-shorter.git
   cd laravel-url-shortener
   ```

2. **Install Dependencies**

   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Environment Configuration**

   Copy the `.env.example` file and update the database credentials:

   ```bash
   cp .env.example .env
   ```

   Then generate the application key:

   ```bash
   php artisan key:generate
   ```

4. **Migrate the Database**

   Run migrations to set up the necessary tables:

   ```bash
   php artisan migrate
   ```

5. **Run the Application**

   Start the development server:

   ```bash
   php artisan serve
   ```

   Access the app at `http://localhost:8000`.

---

## Usage

1. **Shorten a URL**
   - Log in to the app (`http://localhost:8000/admin/login`).
   - Optionally, set a custom alias or expiration date.
   - Click the "Shorten" button to generate your short URL.

2. **View Analytics**
   - Monitor clicks and other statistics via the analytics dashboard.

3. **Manage URLs**
   - View and manage all your shortened URLs from your profile.

4. **Manage Users**
   - View and manage all your users and your profile.

---

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a feature branch (`git checkout -b feature-name`).
3. Commit your changes (`git commit -m 'Add new feature'`).
4. Push to the branch (`git push origin feature-name`).
5. Create a pull request.

---

## License

This project is open-source and available under the [MIT License](LICENSE).

---