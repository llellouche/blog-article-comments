<?php

namespace App\Service;

use App\Entity\Comment;
use App\Repository\ArticleCommentRepository;
use App\Repository\CommentAnswerRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;

class CommentService
{
    private CommentRepository $commentRepository;
    private CommentAnswerRepository $commentAnswerRepository;
    private ArticleCommentRepository $articleCommentRepository;

    private EntityManagerInterface $entityManager;
    public function __construct(CommentRepository $commentRepository,
                                ArticleCommentRepository $articleCommentRepository,
                                CommentAnswerRepository $commentAnswerRepository,
                                EntityManagerInterface $entityManager)
    {
        $this->commentRepository        = $commentRepository;
        $this->articleCommentRepository = $articleCommentRepository;
        $this->commentAnswerRepository  = $commentAnswerRepository;
        $this->entityManager            = $entityManager;
    }

    public function getArticleComments(int $articleId): array
    {
        return $this->articleCommentRepository->findBy(['article' => $articleId], ['createDate' => 'DESC']);
    }

    // Find ArticleComment and Answer
    public function getComment(int $commentId): Comment
    {
        return $this->commentRepository->find($commentId);
    }

    public function getCommentAnswers(int $commentId): array
    {
        return $this->commentAnswerRepository->findBy(['parentComment' => $commentId]);
    }

    public function save(Comment $comment): Comment
    {
        $this->entityManager->persist($comment);
        $this->entityManager->flush($comment);

        return $comment;
    }
}