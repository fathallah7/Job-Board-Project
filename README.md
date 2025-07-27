<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Job Board Project

This is a job board platform built with Laravel. It consists of two main applications:

- **job-app**: The user-facing site for job seekers to browse and apply for jobs.
- **job-backoffice**: The admin dashboard for companies and administrators to manage jobs, companies, and applications.
- **job-shared**: Shared code and models between both apps.

## Features

- Browse job vacancies and companies
- Apply for jobs and manage your applications
- Admin dashboard for managing companies, jobs, categories, and users
- Archive and restore companies and job applications

## Getting Started

1. Clone the repository.
2. Install dependencies for each app:
   ```sh
   cd job-app && composer install && npm install
   cd ../job-backoffice && composer install && npm install
   ```
3. Copy `.env.example` to `.env` and set up your environment variables.
4. Run migrations:
   ```sh
   php artisan migrate
   ```
5. Start the development servers:
   ```sh
   php artisan serve
   npm run dev
   ```

## Tech Stack

- Laravel (PHP)
- Tailwind CSS
- Alpine.js

## License

This project is open-sourced under the [MIT license](https://opensource.org/licenses/MIT)