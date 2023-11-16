<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Tests\Controller;

use PHPUnit\Framework\TestCase;
use App\Controller\WeatherController;
use App\Service\WeatherService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class WeatherControllerTest extends TestCase
{
    public function testSaveData()
    {
        $mockWeatherService = $this->createMock(WeatherService::class);
        $controller = new WeatherController($mockWeatherService);

        $request = Request::create('/', 'POST', [], [], [], [], '{"lat": 52.0, "lng": 13.0}');

        $mockWeatherService->expects($this->once())
            ->method('saveWeatherData')
            ->with(['lat' => 52.0, 'lng' => 13.0])
            ->willReturn($this->createMock(\App\Entity\History::class));

        $response = $controller->saveData($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }
}