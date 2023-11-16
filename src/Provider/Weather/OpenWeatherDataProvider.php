<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Provider\Weather;

class OpenWeatherDataProvider
{
    public function getWeather(array $parameters): array
    {
        $lat = $parameters['lat'];
        $lng = $parameters['lng'];
        $apiKey = $_ENV['OPEN_WEATHER_MAP_API_KEY'];

        $response = file_get_contents(
            "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lng}&appid={$apiKey}&units=metric"
        );

        return json_decode($response, true);
    }
}