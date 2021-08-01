## Importer project

This importer project was made with 
laravel 8 framework and Tailwind Css

at the moment have 2 routes working
urlproject/public/upload
where you can:
1. the clear database before upload
2. Import the old inventory (input column name key)
3. Import the new Inventory (input column name key)
4. link to show results 

urlproject/public/compare 
   
In this view you can view the results
1. Without stock product
2. New products
3. Products Updates

In this moment, this view only show data without any format
    
   
Note: if deploy in localhost with laravel serve command
remove public from url
## heroku deploy Config vars
APP_DEBUG true

APP_KEY base64:JfEuydxXTRQUkV6FfrV3LCP72bfXInurDgaVm+BRZzI=

APP_NAME Salim Stock Compare

DATABASE_URL url provided by Heroku

## Change settings in .env file

DB_CONNECTION=pgsql

DB_HOST=host provided by heroku

DB_PORT=5432

DB_DATABASE=database name provided by heroku

DB_USERNAME=username provided by heroku

DB_PASSWORD=password provided by heroku

Execute the migration command into heroku cli.



