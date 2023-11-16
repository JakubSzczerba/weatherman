<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Service;

use App\DTO\WeatherDTO;
use App\Entity\History;
use App\Provider\Weather\OpenWeatherDataProvider;
use App\Transformator\HistoryTransformator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class WeatherService
{
    private EntityManagerInterface $em;

    private OpenWeatherDataProvider $openWeatherDataProvider;

    private HistoryTransformator $historyTransformator;

    public function __construct(EntityManagerInterface $em, OpenWeatherDataProvider $openWeatherDataProvider, HistoryTransformator $historyTransformator)
    {
        $this->em = $em;
        $this->openWeatherDataProvider = $openWeatherDataProvider;
        $this->historyTransformator = $historyTransformator;
    }

    public function saveWeatherData(array $parameters): History
    {
        try {
            $data = $this->openWeatherDataProvider->getWeather($parameters);
        } catch (\Exception $e) {
            throw new \Exception('Failed to fetch weather data.');
        }
        $history = $this->historyTransformator->createHistory($data);

        $this->em->persist($history);
        $this->em->flush();

        return $history;
    }

    public function getWeather(History $history): array
    {
        $weatherDto = new WeatherDTO($history);

        return [
            'temperature' => $weatherDto->getTemperature(),
            'cloudiness' => $weatherDto->getCloudiness(),
            'wind' => $weatherDto->getWind(),
            'description' => $weatherDto->getDescription(),
            'longitude' => $weatherDto->getLongitude(),
            'latitude' => $weatherDto->getLatitude(),
            'city' => $weatherDto->getCity()
        ];
    }
}