<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Controller;

use App\Repository\HistoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HistoryController extends AbstractController
{
    private HistoryRepository $historyRepository;

    public function __construct(HistoryRepository $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    #[Route('/history', name: 'searchHistory')]
    public function searchHistory(Request $request, PaginatorInterface $paginator): Response
    {
        $history = $paginator->paginate(
            $this->historyRepository->getHistory(),
            $request->query->getInt('page', 1),
            10
        );

        $statistics = $this->historyRepository->getStatistics();

        return $this->render('history/list.html.twig', [
            'history' => $history,
            'statistics' => $statistics
        ]);
    }
}