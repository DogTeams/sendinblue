## SendinBlue ##
 
### Installation ###
 
Add Scafold to your composer.json file to require Scafold :
```
    require : {
        "laravel/framework": "5.1.*",
        "dogteam/sendinblue": "dev-master"
    }
```
 
Update Composer :
```
    composer update
```
 
The next required step is to add the service provider to config/app.php :
```
    'Dogteam\Sendinblue\SendInBlueServiceProvider',
```
 
### Publish ###
 
The last required step is to publish views and assets in your application with :
```
    php artisan vendor:publish
```
 
Congratulations, you have successfully installed SendInBlue !