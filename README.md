## Features
- Login Page
    [![login.png](https://i.postimg.cc/vmCY7mwC/login.png)](https://postimg.cc/67Lxtt3h)
- User Management
    [![user-management.png](https://i.postimg.cc/sDfrhWZv/user-management.png)](https://postimg.cc/LhWwdnDp)
- Role Management
    [![role-management.png](https://i.postimg.cc/tCvLnMjM/role-management.png)](https://postimg.cc/w7JWSF3X)
- Permission Management
    [![permission-management.png](https://i.postimg.cc/gJK7zMs4/permission-management.png)](https://postimg.cc/YGhR8zJm)
- Dynamic website settings
    [![website-setting.png](https://i.postimg.cc/MTzsF7wB/website-setting.png)](https://postimg.cc/zLPSLRVD)
- View installed module
    [![module-view.png](https://i.postimg.cc/JzJP764J/module-view.png)](https://postimg.cc/ZWbrVLNK)
- File manager
    [![file-manager.png](https://i.postimg.cc/mDdSpK8x/file-manager.png)](https://postimg.cc/FdLc7WMG)
- File picker
    [![file-picker.png](https://i.postimg.cc/Fz7VMGBY/file-picker.png)](https://postimg.cc/n9fm7KZx)

## Packages
- [Admin LTE 3 Template](https://github.com/ColorlibHQ/AdminLTE)
- Laravel UI (Bootstrap)
- Laravel Auth
- [Google recaptcha](https://laravel-recaptcha-docs.biscolab.com/docs/intro)
- [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar)
- [Spatie](https://spatie.be/docs/laravel-permission/v5/introduction)
- [Sweet Alert](https://github.com/realrashid/sweet-alert)
- [File Manager](https://github.com/alexusmai/laravel-file-manager)
- [Laravel Module](https://nwidart.com/laravel-modules/v6/introduction)
- [Laravel Module Generator](https://github.com/dcblogdev/laravel-module-generator)

## Requirements
- php 8
- mysql
- composer

## How To Install
### Clone repository
``` bash
git clone https://github.com/erikwibowo/Laravel-9-RBAC-Starter-with-Admin-LTE-3.git
```
### Change directory to directory project
``` bash
cd .\Laravel-9-RBAC-Starter-with-Admin-LTE-3\
```
### Intsall packages
``` bash
composer install
```
### Copy environment example file
``` bash
cp .env.example .env
```
### Create database 'admin_lte3'
### Change some configuration in .env file from root project
``` bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=admin_lte3
DB_USERNAME=root
DB_PASSWORD=
```
### Config google recapthca key in .env
- Go to [google recaptcha v2 admin console](https://www.google.com/recaptcha/admin)
- If you run in localhost add this domains <br>
    [![domains.jpg](https://i.postimg.cc/VNjLmqjV/278022947-5419401621416772-3068878710146094302-n.jpg)](https://postimg.cc/1g3ZKN7G)
``` bash
RECAPTCHA_SITE_KEY=YOUR_API_SITE_KEY
RECAPTCHA_SECRET_KEY=YOUR_API_SECRET_KEY
```
### Generate laravel key
```bash
php artisan key:generate
```
### Create storage link
``` bash
php artisan storage:link
```
### Database migration and seed data
``` bash
php artisan migrate:fresh --seed
```
### Run in development server
``` bash
php artisan serve
```
### Login with
``` bash
email : superadmin@superadmin.com
password : superadmin
```

## Modules
### build a new module
``` bash
php artisan module:build
type the module name (plural). example : posts, categories, sliders etc.
```
### Enable module
``` bash
php artisan module:enable {module name}
```
### Disable module
``` bash
php artisan module:disable {module name}
```
### All module files will be generated in root/Modules/{Modulename}
### To automatically update permission, go to permission page and click the reload button
### Change module config
``` bash
Update the module config in root/Modules/{module name}/module.json
"menus": [
    {
        "icon": "fas fa-image",
        "name": "{ModuleName}",
        "route": "route.name",
        "permission": "read {modulename}"
    }
],
"permissions": ["{module name}"]
```
### If you need add menu in created module
``` bash
Update the module config in root/Modules/{Modulename}/module.json
"menus": [
    {
        "icon": "fas fa-image",
        "name": "{Module Name}",
        "route": "route.name",
        "permission": "read {modulename}"
    },
    {
        "icon": "fas fa-images",
        "name": "{Module Name}",
        "route": "route.name",
        "permission": "read {modulename}"
    }
],
"permissions": ["{modulename}", "{modulename}"]
```
### Then reload the permission in Permission > Reload Permission

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
