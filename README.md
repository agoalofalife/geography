
[EN](https://github.com/agoalofalife/geography/blob/master/README.md) | [RU](https://github.com/agoalofalife/geography/blob/master/README_RU.md)

**The geography of the regions**

[![Build Status](https://travis-ci.org/agoalofalife/geography.svg?branch=master)](https://travis-ci.org/agoalofalife/geography)  [![License](https://poser.pugx.org/agoalofalife/geography/license)](https://packagist.org/packages/agoalofalife/geography)  [![Twitter](https://img.shields.io/twitter/url/https/github.com/agoalofalife/geography.svg?style=social&style=plastic)](https://twitter.com/intent/tweet?text=Wow:&url=%5Bobject%20Object%5D)  [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/agoalofalife/geography/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/agoalofalife/geography/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/agoalofalife/geography/badges/build.png?b=master)](https://scrutinizer-ci.com/g/agoalofalife/geography/build-status/master)

**What is it?**

This package solves the problem with the hierarchy of countries, regions, settlements in your database.
A few commands in the console, you deploy all the necessary the country , regardless of country and language.

**The installation of the package**

For installation, you must run the command from composer

    
    composer require agoalofalife/geography

    
**Data migration**

Run the command :

   ``` 
   vendor/bin/geography install
   ```
    
Following the instructions step by step, continue to enter information.

 1. Database selection
 
```
======================================
Please choose your database type :
  [ 0 ] mysql
  [ 1 ] postgres
```

 2. Choice your host
 
 ```
Enter host for database , please : localhost
```

 2. The name of the database:
 ```
 Enter database name,  please : test
 ```
  3. The user in the database:
 ```
 Enter database username,  please : root
```
 4. The password in the database (not shown):
 ```
 Enter database password,  please : 
```
 5. To select the language:
```
Please select your native language :
  [0] ru
  [1] en
  [2] ua
  [3] be
  [4] es
  [5] fi
  [6] de
  [7] it
 > 
```
 5. Choose the country you want to migrate, for example I need a few countries (Australia and Brazil), respectively, I would need to enter : **AU,BR**

 ```
the list of countries you can see here 3166-1 alpha-2
you can specify multiple countries separated by commas
example EN, RU
Enter  the country you wish to migrate,  please : 
```
After some time, depending on the volume of information you will see in my database three tables : 
 - Country
 - Regions
 - Сities
 
```
 You have just selected: AU,BR 
 3/3 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%
```
Congratulations to all successful!

**Integration with Laravel**

Since the environment Laravel uses for its tables Seeder and Migration, we can freely copy it to your project Laravel!
  
 ```
 vendor/bin/geography migrate:laravel  
 ```
 After you get your files in a folder database and config.
 
To configure your language and countries you want to migrate, you must change the configuration file in config/geography.php :

 ```
 return [
     //     Your native language
     //     0 — Russian,
     //     1 — Ukrainian,
     //     2 — Belarusian,
     //     3 — English,
     //     4 — Spanish,
     //     5 — Finnish,
     //     6 — German,
     //     7 — Italian.
     'locale'   => 0,

     // Country you wish to migrate
     // standard 3166-1 alpha-2
     // example RU,AU
    'country'  => 'RU',
    
     'nameTable' => [
         'country' => 'country',
         'regions' => 'regions',
         'cities'  => 'cities'
     ],
     'access_token' => ''
];
 ```
Next, you need to perform :

 ```
 composer dump
 php artisan migrate
 
 php artisan db:seed
 или для seeder :
 php artisan db:seed --class=CountryTableSeeder
 php artisan db:seed --class=RegionsTableSeeder
 php artisan db:seed --class=CitiesTableSeeder
 ```
 
After you can easily remove the package and what not to worry!


[![yes](https://media.giphy.com/media/2RGhmKXcl0ViM/giphy.gif)
