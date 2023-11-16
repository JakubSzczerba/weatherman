# Weatherman
> Application for searching weather

## Technologies
* PHP - version 8.1.25
* Symfony - version 5.4.31
* PostgreSQL - version 13.2-1
* [Google Api](https://github.com/googleapis/google-api-php-client)
* [Open Weather Map Api Current](https://openweathermap.org/current)

## Local Setup
```
docker compose up -d
```
```
docker compose exec php bin/console doctrine:migrations:migrate
```
```
docker compose exec php npm run build
```
## Tests
```
docker compose exec php php bin/phpunit
```

## Contact
* [GitHub](https://github.com/JakubSzczerba)
* [LinkedIn](https://www.linkedin.com/in/jakub-szczerba-3492751b4/)