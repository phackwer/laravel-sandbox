# Laravel Sandbox

Use:

Wherever you put the application, fix the .env file to point to the SQLite database.
In this case I placed it at:

/var/www/html/xpreso

For studying pourposes

Access the below routes for accessing register 1 of each type:

http://127.0.0.1/xpreso/public/index.php/currency/1
http://127.0.0.1/xpreso/public/index.php/event/1
http://127.0.0.1/xpreso/public/index.php/exchangerate/1
http://127.0.0.1/xpreso/public/index.php/partner/1

And access this for a non restfull report data service

http://127.0.0.1/xpreso/public/index.php/payments

Changes made so far:

0 - Used migrations for database creation and sowing (artisan migrate, artisan seed)
1 - app\HTTP\routes.php - added auto register of controller routes
2 - Create the RestApiController with JSON only output to add RESTFul automatic
    routes to all controllers that inherit from here and also automatically use a
    BusinessServiceProvider, Repository and Model which are named similarly
3 - Create an App\Model layer separating BusinessServiceProviders, Model Entities
    and Repositories on a better, making it easir to find business rules
4 - Started the Angular frontend on separated project.