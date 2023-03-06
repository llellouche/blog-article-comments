<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\CommentsRates;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CommentsRatesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentsRates::class);
    }

    public function getCalculatedCommentRate(int $commentId): float
    {
        return $this->createQueryBuilder('cr')
            ->select('AVG(cr.rate)')
            ->where('cr.comment = :commentId')
            ->setParameter('commentId', $commentId)
            ->getQuery()
            ->getSingleScalarResult();
    }
}