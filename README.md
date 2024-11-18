# Laravel Livewire Volt Starterkit

This is a Laravel project built using default authentication and basic scaffolding. It serves as a starting point for creating a web application and allows you to add features as needed.

## Features

- Laravel framework setup with default authentication.
- Pre-installed authentication system (login, registration, password reset).
- Basic UI components for dashboard and user management.
- Livewire Volt to make SPA (Single Page Application)
- Modular structure for easy feature addition and customization.

## Prerequisites

Before getting started, ensure you have the following installed:

- PHP >= 8.1
- Composer
- Node.js and npm
- MySQL or any supported database

## Installation

1. **Downloadable archive path**

   ```url
   https://github.com/atulmahankal/Laravel-Livewire-Volt-Starterkit/archive/refs/heads/master.zip
   ```

2. **Install PHP dependencies**

    ```bash
    composer install
    ```

    (For production, use `composer install --no-dev`.)

3. **Install Node.js dependencies**

    ```bash
    npm install
    ```

    (For production, use `npm install --production`.)

4. **Update .env**

    ```.env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. **Run the development server**

    ```bash
    composer run dev
    ```

    **or**

    a. *Run Frontend development server*

    ```bash
    npm run dev
    ```

    b. *Run the backend development server*

    ```bash
    php artisan serve
    ```

    Visit [http://localhost:8000](http://localhost:8000) in your browser.

6. **Run on production server**

    ```bash
    npm run build
    ```

## Usage

- Authentication: Use the built-in login and registration forms to manage users.
- UI Extensions: Customize or extend the provided templates for your application needs.
- Adding Features: Add routes, controllers, and views as required for your application.

## Future Enhancements

- [x] **Basic Authentication**  
    Implementation of Registration, Login, Profile Update, Change Password

- [x] **Admin Dashboard**  

- [x] **User Roles and Permissions**  

- [x] **API Integration**  

- [x] **Theme Customization**  

- [x] **Notifications System**  

- [x] **Multi-Language Support**  

- [ ] **Authenticate Client source for Api**  

- [ ] **Store environment configuration in database**  

- [ ] **Error handling for web & api**  

- [ ] **Auth using username instead of e-mail**  

- [ ] **Auth using magiclink**  

- [ ] **Socialite Integration**  

- [ ] **Two Factor Authentication**  

- [ ] **Browser Sessions**  

- [ ] **API Sessions**  

- [ ] **Multiple localizations**  

- [ ] **Google Analytics**  

- [ ] **Login history**  

- [ ] **Log Viewer**  

- [ ] **PWA**  

- [ ] **Device authorization**  
