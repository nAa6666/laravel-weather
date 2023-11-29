## Laravel v10 | Weather API

[Link](https://openweathermap.org/) (Weather API)

## Setup

```
composer install
```

## Test
```
php artisan sync:weather 
php artisan sync:weather --city=London 
php artisan sync:weather --city=Lviv --country=UA
```

[app/Console/Commands/WeatherApi.php](https://github.com/nAa6666/laravel-weather/blob/main/app/Console/Commands/WeatherApi.php)

Error city or country
```
php artisan sync:weather --city=Lviv2
Client error: `GET http://api.openweathermap.org/data/2.5/weather?q=Lviv2%2C%20UA&appid=a2c2a155ae248399e9c8dba968869393` resulted in a `404 Not Found` response:
{"cod":"404","message":"city not found"}
```

```
php artisan sync:weather --city=Lviv
+------------+---------+
| Name       | Value   |
+------------+---------+
| lon        | 24.0232 |
| lat        | 49.8383 |
| temp       | -8.42   |
| feels_like | -13.33  |
| temp_min   | -8.42   |
| temp_max   | -8.42   |
| pressure   | 1013    |
| humidity   | 91      |
| sea_level  | 1013    |
| grnd_level | 976     |
+------------+---------+

php artisan sync:weather --city=Warsaw --country=PL
+------------+------------------+
| Name       | Value            |
+------------+------------------+
| lon        | 21.0118          |
| lat        | 52.2298          |
| temp       | -4.03            |
| feels_like | -8.4299999999999 |
| temp_min   | -6.3             |
| temp_max   | -1.87            |
| pressure   | 1006             |
| humidity   | 81               |
+------------+------------------+
```
