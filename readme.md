## Installation
- Clone this repository
- Copy `.env.example` to `.env`, customize based on your local environment
- `cd <foldername>`
- `composer install`
- `php artisan siparti:install`

### Login
During installation (when `php artisan siparti:install` executed), you will prompted with super user (a.k.a root) credentials.
Use those value to login into system. Login page can be accessed in `/auth/login`.

### URL
- `/` frontend
- `/admin` admin panel
- `/my` user setting
