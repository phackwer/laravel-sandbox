# Laravel Sandbox

Use:

Wherever you put the application, fix the .env file to point to the SQLite database.
In this case I placed it at:

/var/www/html/xpreso

For studying pourposes

Access the below routes for accessing register 1 of each type:

- http://127.0.0.1/xpreso/public/index.php/currency/1
- http://127.0.0.1/xpreso/public/index.php/event/1
- http://127.0.0.1/xpreso/public/index.php/exchangerate/1
- http://127.0.0.1/xpreso/public/index.php/partner/1

And access this for a non restfull report data service

- http://127.0.0.1/xpreso/public/index.php/payments

Exchange rates were based on this crazy source:

- https://www.gov.uk/government/publications/hmrc-exchange-rates-for-2016-monthly

Changes made so far:

- Used migrations for database creation and sowing (artisan migrate, artisan seed)
- app\HTTP\routes.php - added auto register of controller routes
- Create the RestApiController with JSON only output to add RESTFul automatic
    routes to all controllers that inherit from here and also automatically use a
    BusinessServiceProvider, Repository and Model which are named similarly
- Create an App\Model layer separating BusinessServiceProviders, Model Entities
    and Repositories on a better, making it easir to find business rules
- Output report data as a JSON object. Conversion can be easily made for any format

@TODOS
- Get the Model and Rule validations layers all set up
- Use the Respect validation library from Henrique Moody (Yo, bro!)
- Create a vendor for the abstract classes
- Create a module structure with auto registers for services and routes
- Get annotations working on Laravel