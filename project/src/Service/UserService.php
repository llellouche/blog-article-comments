<?php

namespace App\Service;

use App\Entity\Comment;
use App\Entity\User;
use App\Repository\ArticleCommentRepository;
use App\Repository\CommentAnswerRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    private UserRepository $userRepository;
    private EntityManagerInterface $entityManager;
    public function __construct(UserRepository $userRepository,
                                EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->entityManager  = $entityManager;
    }

    public function finByEmail(string $email): ?User
    {
        return $this->userRepository->findOneByEmail($email);
    }
}