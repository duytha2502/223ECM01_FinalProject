# How to use
Clone repo

`git clone https://github.com/duytha2502/HKDN_Project.git`

`Save .env.example as .env and put your database credentials`


Install the composer dependencies

`composer install`


Set application key

`php artisan key:generate`   

And Migrate with

`php artisan migrate --seed` or `php artisan migrate:fresh --seed`

 `php artisan storage:link`

 Install the composer socialite
`composer require laravel/socialite`

Login Credentials for admin panel

 admin@webmall.com | password : password
 seller1@webmall.com | password : 123
 seller2@webmall.com | password : 123
