<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\DTO;

use App\Entity\History;

class WeatherDTO
{
    private History $history;

    public function __construct(History $history)
    {
        $this->history = $history;
    }

    public function getTemperature(): string
    {
        return $this->history->getTemperature(). '°C';
    }

    public function getCloudiness(): string
    {
        return $this->history->getCloudiness(). '%';
    }

    public function getWind(): string
    {
        return $this->history->getWind();
    }

    public function getDescription(): string
    {
        return $this->history->getDescription();
    }

    public function getLongitude(): string
    {
        return $this->history->getLongitude();
    }

    public function getLatitude(): string
    {
        return $this->history->getLatitude();
    }

    public function getCity(): string
    {
        return $this->history->getCity();
    }
}