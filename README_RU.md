
**География регионов**

[![Build Status](https://travis-ci.org/agoalofalife/geography.svg?branch=master)](https://travis-ci.org/agoalofalife/geography)[![License](https://poser.pugx.org/agoalofalife/geography/license)](https://packagist.org/packages/agoalofalife/geography)[![Twitter](https://img.shields.io/twitter/url/https/github.com/agoalofalife/geography.svg?style=social&style=plastic)](https://twitter.com/intent/tweet?text=Wow:&url=%5Bobject%20Object%5D)[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/agoalofalife/geography/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/agoalofalife/geography/?branch=master)[![Build Status](https://scrutinizer-ci.com/g/agoalofalife/geography/badges/build.png?b=master)](https://scrutinizer-ci.com/g/agoalofalife/geography/build-status/master)

**Что это такое?**
Этот пакет решает проблему с иерархией стран, регионов, населенных пунктов в вашей базе данных.
За несколько команд в консоли, вы развернете все необходимые страны , вне зависимости от страны и языка.

**Установка пакета**

Для установки необходимо выполнить команду из composer

    ```
    composer require agoalofalife/geography
    ```
    
**Миграции данных**

Выполните команду   :

   ``` 
   vendor/bin/geography install
   ```
    
Следуя инструкциям шаг за шагом продолжайте вводить информацию.

 1. Выбор базы данных
 
```
======================================
Please choose your database type :
  [ 0 ] mysql
  [ 1 ] postgres
```

 2. Выбор вашего хоста
 
 ```
Enter host for database , please : localhost
```

 2. Название базы данных:
 ```
 Enter database name,  please : test
 ```
  3. Пользователь в базе данных:
 ```
 Enter database username,  please : root
```
 4. Пароль в базе данных (не отображается):
 ```
 Enter database password,  please : 
```
 5. Выбрать язык:
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
 5. Выбрать страны которые вы хотите мигрировать, напрмимер мне нужно несколько стран (Австралия и Бразилия) 
   соответственно мне необходимо будет ввести : **AU,BR**
 ```
the list of countries you can see here 3166-1 alpha-2
you can specify multiple countries separated by commas
example EN, RU
Enter  the country you wish to migrate,  please : 
```
Через некоторое время в зависимости от обьема информации, вы увидите у себя в базе три таблицы : 
 - Страны
 - Регионы
 - Районы
 
```
 You have just selected: AU,BR 
 3/3 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%
```
Поздравляю все успешно смигрированно!

**Интеграция с Laravel**
 Так как среда Laravel использует для своих таблиц Seeder и Migration, мы можем свободно скопировать это в свой проект Laravel!
  
 ```
 vendor/bin/geography migrate:laravel  
 ```
 После команды вы уведите ваши файлы  в папке database, config.
 Для настройки вашего языка и стран которых вы хотите мигрировать, надо изменить конфигурационный файл в config/geography:
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
     ]
];
 ```
Далее вам необходимо выполнить:
 ```
 composer dump
 php artisan migrate
 
 php artisan db:seed
 или для seeder :
 php artisan db:seed --class=CountryTableSeeder
 php artisan db:seed --class=RegionsTableSeeder
 php artisan db:seed --class=CitiesTableSeeder
 ```
