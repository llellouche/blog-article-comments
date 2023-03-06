<?php

namespace App\Service;

use App\Entity\CommentsRates;
use App\Repository\CommentsRatesRepository;
use Doctrine\ORM\EntityManagerInterface;

class CommentsRatesService
{
    private EntityManagerInterface $entityManager;
    public function __construct(CommentsRatesRepository $commentsRatesRepository,
                                EntityManagerInterface $entityManager)
    {
        $this->commentsRatesRepository = $commentsRatesRepository;
        $this->entityManager           = $entityManager;
    }

    public function getCommentRate(int $commentId, int $userId): ?CommentsRates
    {
        return $this->commentsRatesRepository->findOneBy(
            [
                'comment' => $commentId,
                'user'    => $userId
            ]);
    }

    public function getCalculatedCommentRate(int $commentId): ?float
    {
        return $this->commentsRatesRepository->getCalculatedCommentRate($commentId);
    }

    public function save(CommentsRates $commentsRates): CommentsRates
    {
        $this->entityManager->persist($commentsRates);
        $this->entityManager->flush($commentsRates);

        return $commentsRates;
    }
}