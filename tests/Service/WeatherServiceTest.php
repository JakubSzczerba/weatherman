<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\WeatherService;
use App\Provider\Weather\OpenWeatherDataProvider;
use App\Transformator\HistoryTransformator;
use App\Entity\History;

class WeatherServiceTest extends TestCase
{
    public function testSaveWeatherData()
    {
        $mockEm = $this->createMock(\Doctrine\ORM\EntityManagerInterface::class);
        $mockDataProvider = $this->createMock(OpenWeatherDataProvider::class);
        $mockTransformator = $this->createMock(HistoryTransformator::class);

        $mockDataProvider->expects($this->once())
            ->method('getWeather')
            ->willReturn(['sample' => 'data']);

        $mockTransformator->expects($this->once())
            ->method('createHistory')
            ->with(['sample' => 'data'])
            ->willReturn($this->createMock(History::class));

        $service = new WeatherService($mockEm, $mockDataProvider, $mockTransformator);
        $result = $service->saveWeatherData(['lat' => 52.0, 'lng' => 13.0]);


        $this->assertInstanceOf(History::class, $result);
    }
}