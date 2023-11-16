<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Controller;

use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class WeatherController extends AbstractController
{
    private WeatherService $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    #[Route('/', name: 'saveData', methods: ['POST'])]
    public function saveData(Request $request): JsonResponse
    {
        $parameters = json_decode($request->getContent(), true);

        try {
            $history = $this->weatherService->saveWeatherData($parameters);

            return new JsonResponse(['success' => true, 'history' => $this->weatherService->getWeather($history)]);
        } catch (\Exception $e) {

            return new JsonResponse(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}