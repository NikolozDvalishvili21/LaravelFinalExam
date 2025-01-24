# ATHLETE INJURY PROJECT

Athlete has many Injuries.
Injury belongs to an Athlete and has many Treatments.
Treatment belongs to an Injury.
Rating can be assigned to any model.
================================================================
php artisan make:seeder YourSeederName - სიდერის შექმნა
php artisan db:seed - სიდერების გაშვებისთვის
================================================================
php artisan make:migration create_tablename_table - მიგრაციის შექმნა
php artisan migrate - მიგრაციის გაშვება
===============================================================
php artisan make:controller YourControllerName - კონტროლერის შექმნა
===============================================================
php artisan make:model ModelName - მოდელის შექმნა
===============================================================
{type}/{id}/ratings -> /injuries/2/ratings
