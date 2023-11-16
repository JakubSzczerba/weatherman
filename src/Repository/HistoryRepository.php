<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Repository;

use App\Entity\History;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<History>
 *
 * @method History|null find($id, $lockMode = null, $lockVersion = null)
 * @method History|null findOneBy(array $criteria, array $orderBy = null)
 * @method History[]    findAll()
 * @method History[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, History::class);
    }

    public function getHistory(): Query
    {
        $qb = $this->createQueryBuilder('h');

        $qb->orderBy('h.createdAt', 'ASC');

        return $qb->getQuery();
    }

    public function getStatistics(): array
    {
        $qb = $this->createQueryBuilder('h');

        $qb->select(
            'MIN(h.temperature) as minTemperature',
            'MAX(h.temperature) as maxTemperature',
            'AVG(h.temperature) as avgTemperature',
            'COUNT(h.id) as totalSearches',
            'MAX(h.city) as mostSearchedCity'
        );

        return $qb->getQuery()->getArrayResult();
    }
}
