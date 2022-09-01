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

## About Web Chat Application

Technmologies used for building this project: 
1. HTML
2. CSS
3. Bootstrap
4. Javascript
5. Jquery
6. SQL
7. AJAX
8. PHP
9. Laravel

Features of project:

1. There are two roles one is Admin and other is Agent. Admin has full access to the application.
1. On logging in User is not required to choose its role, their role will be automatically       checked from database and will be redirected to their respective panel.
2. Forgot Password - OTP verification is enabled
3. All Forms are validated from server side.
4. Only Admin can add new Agent
5. On adding a new agent a reset password will be sent to email Id.
6. When agent login for the first time he will be redirected to reset password and not to agent panel. Only after setting a new password he can be rdirected tom agent panel.
7. Admin can see the list of Registered Agents
8. Only Admin can edit and update Agent details
9. Admin can delete the registered Agents
10. Agent will be able to see list of other agents to chat with
11. Chat box will be displayed only after clicking on agent name with whom other agent wants to chat with.
12. Agent cannot access the admin panel but Admin can access the Agent Panel
13. Delete, Backup and Restore chat option.
14. Logout Functionality