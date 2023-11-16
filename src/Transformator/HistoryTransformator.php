<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Transformator;

use App\Entity\History;

class HistoryTransformator
{
    public function createHistory(array $data): History
    {
        $history = new History();
        $history
            ->setTemperature($data['main']['temp'])
            ->setCloudiness($data['clouds']['all'])
            ->setWind($data['wind']['speed'] . ' m/s ' . $data['wind']['deg'])
            ->setDescription($data['weather'][0]['description'])
            ->setLatitude((string)$data['coord']['lat'])
            ->setLongitude((string)$data['coord']['lon'])
            ->setCity($data['name'])
            ->setCreatedAt(new \DateTimeImmutable());

        return $history;
    }
}